<?php

namespace App\Livewire\Features\User;

use App\Models\Activity;
use App\Models\Status;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class ProfileActivities extends Component
{
    public User $user;

    public function mount(User $user): void
    {
        $this->user = $user;
    }

    #[On('status-updated')]
    public function refreshActivities(): void
    {
        $this->user->refresh();
    }

    public function render(): View
    {
        $activities = Activity::query()
            ->with(['user', 'song'])
            ->where('user_id', $this->user->id)
            ->latest()
            ->limit(30)
            ->get();

        $viewerStatuses = Status::query()
            ->where('user_id', Auth::id())
            ->whereIn('song_id', $activities->pluck('song_id'))
            ->pluck('state', 'song_id')
            ->toArray();

        return view('livewire.features.user.profile-activities', [
            'activities' => $activities,
            'viewerStatuses' => $viewerStatuses,
        ]);
    }
}
