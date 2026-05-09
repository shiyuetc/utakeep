<?php

namespace App\Livewire\Features\User;

use App\Models\Activity;
use App\Models\Status;
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
        $counts = [
            0 => $this->user->activity_count,
            1 => $this->user->status1_count,
            2 => $this->user->status2_count,
            3 => $this->user->status3_count,
        ];

        $activities = collect();
        $statuses = collect();
        $songIds = collect();

        if ($this->activeState === 0) {
            $activities = Activity::query()
                ->with(['user', 'song'])
                ->where('user_id', $this->user->id)
                ->latest()
                ->limit(30)
                ->get();

            $songIds = $activities->pluck('song_id');
        } else {
            $statuses = Status::query()
                ->with('song')
                ->where('user_id', $this->user->id)
                ->where('state', $this->activeState)
                ->latest()
                ->get();

            $songIds = $statuses->pluck('song_id');
        }

        $viewerStatuses = Status::query()
            ->where('user_id', Auth::id())
            ->whereIn('song_id', $songIds)
            ->pluck('state', 'song_id')
            ->toArray();

        return view('livewire.features.user.profile', [
            'activities' => $activities,
            'counts' => $counts,
            'statuses' => $statuses,
            'viewerStatuses' => $viewerStatuses,
        ]);
    }
}
