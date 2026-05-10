<?php

namespace App\Livewire\Features\User;

use App\Models\Status;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class ProfileSongs extends Component
{
    public User $user;

    public int $state;

    public function mount(User $user, int $state): void
    {
        $this->user = $user;
        $this->state = $state;
    }

    #[On('status-updated')]
    public function refreshSongs(): void
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
        $statuses = Status::query()
            ->with('song')
            ->where('user_id', $this->user->id)
            ->where('state', $this->state)
            ->latest()
            ->get();

        $viewerStatuses = Status::query()
            ->where('user_id', Auth::id())
            ->whereIn('song_id', $statuses->pluck('song_id'))
            ->pluck('state', 'song_id')
            ->toArray();

        return view('livewire.features.user.profile-songs', [
            'statuses' => $statuses,
            'viewerStatuses' => $viewerStatuses,
        ]);
    }
}
