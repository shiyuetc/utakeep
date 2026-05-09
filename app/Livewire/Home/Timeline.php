<?php

namespace App\Livewire\Home;

use App\Models\Activity;
use App\Models\Status;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Timeline extends Component
{
    public function render(): View
    {
        $activities = Activity::with(['user', 'song'])
            ->latest()
            ->limit(30)
            ->get();

        $statuses = Status::where('user_id', Auth::id())
            ->whereIn('song_id', $activities->pluck('song_id')->unique())
            ->pluck('state', 'song_id')
            ->toArray();

        return view('livewire.home.timeline', [
            'activities' => $activities,
            'statuses' => $statuses,
        ]);
    }
}
