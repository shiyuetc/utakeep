<?php

namespace App\Livewire\Home;

use App\Models\Activity;
use App\Models\Status;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Timeline extends Component
{
    public function stateLabel(int $state): string
    {
        return match ($state) {
            1 => '気になる',
            2 => '練習中',
            3 => '習得済み',
            default => '未設定',
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
