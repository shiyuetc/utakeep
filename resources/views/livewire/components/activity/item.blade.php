<div class="p-4">
    <div class="flex items-center gap-2.5 mb-2">
        <a href="{{ route('users.show', $activity->user) }}" class="flex items-center gap-2.5 min-w-0 flex-1 group">
            <div class="w-8 h-8 rounded-full bg-primary-light text-primary flex items-center justify-center text-xs font-medium flex-shrink-0 group-hover:bg-primary group-hover:text-primary-light transition">
                {{ strtoupper(substr($activity->user->screen_name, 0, 2)) }}
            </div>
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
