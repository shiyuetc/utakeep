<?php

namespace App\Livewire\Features\Activity;

use App\Models\Activity;
use App\Models\Status;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Url;
use Livewire\Component;

class Timeline extends Component
{
    private const PER_PAGE = 50;

    public array $activityIds = [];

    public ?int $userId = null;

    public ?int $cursorId = null;

    public bool $hasMore = false;

    #[Url(as: 'tl', except: 'following')]
    public string $scope = 'following';

    public function mount(?User $user = null): void
    {
        $this->userId = $user?->id;
        $this->normalizeScope();

        $this->loadActivity();
    }

    public function setScope(string $scope): void
    {
        if ($this->userId !== null || ! in_array($scope, ['following', 'global'], true)) {
            return;
        }

        $this->scope = $scope;
        $this->activityIds = [];
        $this->cursorId = null;

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
            ->withExists([
                'likedBy as is_liked_by_viewer' => fn ($query) => $query->where('users.id', Auth::id()),
            ])
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
        } elseif ($this->scope === 'following') {
            $query->whereIn('user_id', Auth::user()->following()->pluck('users.id')->push(Auth::id()));
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

    private function normalizeScope(): void
    {
        if ($this->userId !== null || ! in_array($this->scope, ['following', 'global'], true)) {
            $this->scope = 'following';
        }
    }
}
