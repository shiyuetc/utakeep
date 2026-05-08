<?php

namespace App\Livewire\User;

use App\Models\Status;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Profile extends Component
{
    public User $user;
    public int $activeState = 1;

    public function mount(User $user): void
    {
        $this->user = $user;
    }

    public function setActiveState(int $state): void
    {
        if (! in_array($state, [1, 2, 3], true)) {
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
            1 => '気になる',
            2 => '練習中',
            3 => '習得済み',
            default => '未設定',
        };
    }

    public function render(): View
    {
        $counts = [
            1 => $this->user->status1_count,
            2 => $this->user->status2_count,
            3 => $this->user->status3_count,
        ];

        $statuses = Status::query()
            ->with('song')
            ->where('user_id', $this->user->id)
            ->where('state', $this->activeState)
            ->latest()
            ->get();

        $viewerStatuses = Status::query()
            ->where('user_id', Auth::id())
            ->whereIn('song_id', $statuses->pluck('song_id'))
            ->pluck('state', 'song_id')
            ->toArray();

        return view('livewire.user.profile', [
            'counts' => $counts,
            'statuses' => $statuses,
            'viewerStatuses' => $viewerStatuses,
        ]);
    }
}
