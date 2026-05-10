<?php

namespace App\Livewire\Features\Activity;

use App\Models\Activity;
use App\Models\Status;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Timeline extends Component
{
    private const PER_PAGE = 50;

    public array $activityIds = [];

    public ?int $userId = null;

    public ?int $cursorId = null;

    public bool $hasMore = false;

    public function mount(?User $user = null): void
    {
        $this->userId = $user?->id;

        $this->loadActivity();
    }

    public function loadMore(): void
    {
        if (! $this->hasMore) {
            return;
        }

        $this->loadActivity();
    }

    public function render(): View
    {
        $activitiesById = Activity::with(['user', 'song'])
            ->whereIn('id', $this->activityIds)
            ->get()
            ->keyBy('id');

        $activities = collect($this->activityIds)
            ->map(fn (int $activityId) => $activitiesById->get($activityId))
            ->filter();

        $statuses = Status::where('user_id', Auth::id())
            ->whereIn('song_id', $activities->pluck('song_id')->unique())
            ->pluck('state', 'song_id')
            ->toArray();

        return view('livewire.features.activity.timeline', [
            'activities' => $activities,
            'hasMore' => $this->hasMore,
            'statuses' => $statuses,
            'title' => $this->userId ? '記録' : 'みんなの記録',
        ]);
    }

    private function loadActivity(): void
    {
        $query = Activity::query()->latest('id');

        if ($this->userId) {
            $query->where('user_id', $this->userId);
        }

        if ($this->cursorId !== null) {
            $query->where('id', '<', $this->cursorId);
        }

        $nextActivityIds = $query
            ->limit(self::PER_PAGE + 1)
            ->pluck('id');

        $this->hasMore = $nextActivityIds->count() > self::PER_PAGE;

        $this->activityIds = array_values(array_unique([
            ...$this->activityIds,
            ...$nextActivityIds->take(self::PER_PAGE)->all(),
        ]));

        $this->cursorId = $this->activityIds === []
            ? null
            : min($this->activityIds);
    }
}
