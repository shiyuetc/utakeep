<?php

namespace App\Livewire\Components\Activity;

use App\Models\Activity;
use App\Models\UserNotification;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Item extends Component
{
    public Activity $activity;

    public int $state = 0;

    public bool $isLiked = false;

    public int $likesCount = 0;

    public function mount(Activity $activity, int $state = 0): void
    {
        $this->activity = $activity;
        $this->state = $state;
        $this->likesCount = $activity->likes_count;

        $isLikedByViewer = $activity->getAttribute('is_liked_by_viewer');
        $this->isLiked = $isLikedByViewer === null
            ? $activity->likedBy()->whereKey(Auth::id())->exists()
            : (bool) $isLikedByViewer;
    }

    public function toggleLike(): void
    {
        $userId = Auth::id();

        if ($userId === null) {
            return;
        }

        DB::transaction(function () use ($userId): void {
            $activity = Activity::whereKey($this->activity->id)
                ->lockForUpdate()
                ->firstOrFail();

            $alreadyLiked = $activity->likedBy()
                ->whereKey($userId)
                ->exists();

            if ($alreadyLiked) {
                $activity->likedBy()->detach($userId);
                $activity->likes_count = max(0, $activity->likes_count - 1);
                $this->isLiked = false;

                UserNotification::query()
                    ->where('user_id', $activity->user_id)
                    ->where('actor_id', $userId)
                    ->where('type', UserNotification::TYPE_ACTIVITY_LIKED)
                    ->where('activity_id', $activity->id)
                    ->delete();
            } else {
                $activity->likedBy()->attach($userId);
                $activity->likes_count++;
                $this->isLiked = true;

                if ($activity->user_id !== $userId) {
                    UserNotification::create([
                        'user_id' => $activity->user_id,
                        'actor_id' => $userId,
                        'type' => UserNotification::TYPE_ACTIVITY_LIKED,
                        'activity_id' => $activity->id,
                    ]);
                }
            }

            $activity->save();

            $this->likesCount = $activity->likes_count;
            $this->activity = $activity->load(['user', 'song']);
        });
    }

    public function stateLabel(int $state): string
    {
        return match ($state) {
            1 => '気になる',
            2 => '練習中',
            3 => '習得済み',
            default => '未設定',
        };
    }

    public function stateBadgeClass(int $state): string
    {
        return match ($state) {
            1 => 'border-amber-200 bg-amber-50 text-amber-700',
            2 => 'border-blue-200 bg-blue-50 text-blue-700',
            3 => 'border-green-200 bg-green-50 text-green-700',
            default => 'border-gray-200 bg-gray-50 text-gray-600',
        };
    }

    public function timeLabel($createdAt): string
    {
        $diffInSeconds = (int) $createdAt->diffInSeconds(now(), true);

        if ($diffInSeconds < 60) {
            return 'たった今';
        }

        $diffInMinutes = (int) $createdAt->diffInMinutes(now(), true);
        if ($diffInMinutes < 60) {
            return "{$diffInMinutes}分前";
        }

        $diffInHours = (int) $createdAt->diffInHours(now(), true);
        if ($diffInHours < 24) {
            return "{$diffInHours}時間前";
        }

        $diffInDays = (int) $createdAt->diffInDays(now(), true);
        if ($diffInDays < 7) {
            return "{$diffInDays}日前";
        }

        return $createdAt->format('Y/m/d');
    }

    public function render(): View
    {
        return view('livewire.components.activity.item');
    }
}
