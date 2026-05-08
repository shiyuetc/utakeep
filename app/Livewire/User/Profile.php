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
        $counts = Status::query()
            ->where('user_id', $this->user->id)
            ->whereIn('state', [1, 2, 3])
            ->selectRaw('state, count(*) as total')
            ->groupBy('state')
            ->pluck('total', 'state')
            ->all();

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
