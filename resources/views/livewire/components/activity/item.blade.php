<div class="p-4">
    <div class="flex items-center gap-2.5 mb-2">
        <a href="{{ route('users.show', $activity->user) }}" class="flex items-center gap-2.5 min-w-0 flex-1 group">
            <x-user-avatar :user="$activity->user" size="xs" hover />
            <div class="min-w-0">
                <div class="text-xs font-medium text-gray-900">{{ $activity->user->name }}</div>
                <div class="text-xs text-gray-400"><span>@</span>{{ $activity->user->screen_name }}</div>
            </div>
        </a>
        <div class="text-xs text-gray-400 flex-shrink-0">{{ $this->timeLabel($activity->created_at) }}</div>
    </div>
    <p class="text-sm text-gray-700 mb-2">
        ステータスを
        <span class="inline-flex items-center px-1 py-0.5 text-xs border rounded-sm {{ $this->stateBadgeClass($activity->new_state) }}">
            {{ $this->stateLabel($activity->new_state) }}
        </span>
        に変更しました
    </p>
    <div class="bg-gray-50 border border-gray-200 rounded-sm">
        <livewire:components.song.item
            :song="$activity->song"
            :state="$state"
            :key="'activity-song-'.$activity->id.'-'.$activity->song_id.'-'.$state"
        />
    </div>
</div>
