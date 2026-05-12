<?php

namespace App\Livewire\Features\User;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Profile extends Component
{
    public User $user;

    public int $activeState = 0;

    public function mount(User $user): void
    {
        $this->user = $user;
    }

    public function setActiveState(int $state): void
    {
        if (! in_array($state, [0, 1, 2, 3], true)) {
            return;
        }

        $this->activeState = $state;
    }

    public function toggleFollow(): void
    {
        $viewer = Auth::user();

        if (! $viewer || $viewer->is($this->user)) {
            return;
        }

        if ($viewer->isFollowing($this->user)) {
            $viewer->following()->detach($this->user->id);
        } else {
            $viewer->following()->syncWithoutDetaching([$this->user->id]);
        }
    }

    #[On('status-updated')]
    public function refreshStatuses(): void
    {
        $this->user->refresh();
    }

    public function stateLabel(int $state): string
    {
        return match ($state) {
            0 => '記録',
            1 => '気になる',
            2 => '練習中',
            3 => '習得済み',
            default => '未設定',
        };
    }

    public function render(): View
    {
        $viewer = Auth::user();

        $counts = [
            0 => $this->user->activity_count,
            1 => $this->user->status1_count,
            2 => $this->user->status2_count,
            3 => $this->user->status3_count,
        ];

        return view('livewire.features.user.profile', [
            'counts' => $counts,
            'followersCount' => $this->user->followers()->count(),
            'followingCount' => $this->user->following()->count(),
            'isFollowedByViewer' => $viewer ? $this->user->isFollowing($viewer) : false,
            'isFollowing' => $viewer?->isFollowing($this->user) ?? false,
            'isOwnProfile' => $viewer?->is($this->user) ?? false,
        ]);
    }
}
