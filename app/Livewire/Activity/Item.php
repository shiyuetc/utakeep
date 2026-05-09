<?php

namespace App\Livewire\Activity;

use App\Models\Activity;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Item extends Component
{
    public Activity $activity;
    public int $state = 0;

    public function mount(Activity $activity, int $state = 0): void
    {
        $this->activity = $activity;
        $this->state = $state;
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

    public function stateBadgeClass(int $state): string
    {
        return match ($state) {
            1 => 'border-amber-200 bg-amber-50 text-amber-700',
            2 => 'border-blue-200 bg-blue-50 text-blue-700',
            3 => 'border-green-200 bg-green-50 text-green-700',
            default => 'border-gray-200 bg-gray-50 text-gray-600',
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
        return view('livewire.activity.item');
    }
}
