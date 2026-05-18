<?php

namespace App\Livewire\Features\User;

use App\Models\UserNotification;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class Profile extends Component
{
    public User $user;

    #[Url(as: 'status', except: 0)]
    public int|string $activeState = 0;

    #[Url(as: 'view', except: 'songs')]
    public string $activeSection = 'timeline';

    public function mount(User $user): void
    {
        $this->user = $user;
        $this->normalizeActiveSection();
    }

    public function setActiveState(int $state): void
    {
        if (! in_array($state, [0, 1, 2, 3], true)) {
            return;
        }

        $this->activeState = $state;
        $this->activeSection = $state === 0 ? 'timeline' : 'songs';
    }

    public function setActiveSection(string $section): void
    {
        if (! in_array($section, ['timeline', 'following', 'followers', 'songs'], true)) {
            return;
        }

        $this->activeSection = $section;

        if ($section === 'songs' && $this->activeState === 0) {
            $this->activeState = 1;
        }

        if ($section !== 'songs') {
            $this->activeState = 0;
        }
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
            $changes = $viewer->following()->syncWithoutDetaching([$this->user->id]);

            if (in_array($this->user->id, $changes['attached'] ?? [], false)) {
                UserNotification::create([
                    'user_id' => $this->user->id,
                    'actor_id' => $viewer->id,
                    'type' => UserNotification::TYPE_FOLLOWED,
                ]);
            }
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

    private function normalizeActiveSection(): void
    {
        if (! in_array($this->activeSection, ['timeline', 'following', 'followers', 'songs'], true)) {
            $this->activeSection = 'timeline';
        }

        $activeState = filter_var($this->activeState, FILTER_VALIDATE_INT);
        $this->activeState = in_array($activeState, [0, 1, 2, 3], true) ? $activeState : 0;

        if ($this->activeState > 0) {
            $this->activeSection = 'songs';
            return;
        }

        if ($this->activeSection === 'songs') {
            $this->activeState = 1;
        }
    }

    public function render(): View
    {
        $viewer = Auth::user();

        $statusCounts = [
            0 => $this->user->activity_count,
            1 => $this->user->status1_count,
            2 => $this->user->status2_count,
            3 => $this->user->status3_count,
        ];

        return view('livewire.features.user.profile', [
            'followersCount' => $this->user->followers()->count(),
            'followingCount' => $this->user->following()->count(),
            'statusCounts' => $statusCounts,
            'isFollowedByViewer' => $viewer ? $this->user->isFollowing($viewer) : false,
            'isFollowing' => $viewer?->isFollowing($this->user) ?? false,
            'isOwnProfile' => $viewer?->is($this->user) ?? false,
        ]);
    }
}
