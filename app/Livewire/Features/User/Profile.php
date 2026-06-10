<?php

namespace App\Livewire\Features\User;

use App\Models\User;
use App\Models\UserNotification;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Profile extends Component
{
    public User $user;

    public ?string $activeRouteName = null;

    public ?int $activeStatus = null;

    public function mount(User $user): void
    {
        $this->user = $user;
        $this->activeRouteName = request()->route()?->getName();
        $this->activeStatus = $this->activeRouteName === 'users.show.status'
            ? (int) request()->route('status')
            : null;
    }

    public function toggleFollow(): void
    {
        $viewer = Auth::user();

        if (! $viewer) {
            $this->redirectRoute('login', navigate: true);

            return;
        }

        if ($viewer->is($this->user)) {
            return;
        }

        if ($viewer->isFollowing($this->user)) {
            $viewer->following()->detach($this->user->id);

            UserNotification::query()
                ->where('user_id', $this->user->id)
                ->where('actor_id', $viewer->id)
                ->where('type', UserNotification::TYPE_FOLLOWED)
                ->delete();
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
