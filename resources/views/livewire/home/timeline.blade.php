<div class="bg-white border border-gray-200 rounded-sm overflow-hidden">
    <div class="px-4 py-2 border-b border-gray-200">
        <h2 class="text-sm text-gray-900">タイムライン</h2>
    </div>
    @if ($activities->isNotEmpty())
        <div class="divide-y divide-gray-200">
            @foreach ($activities as $activity)
                <div class="p-4">
                    <div class="flex items-center gap-2.5 mb-2">
                        <div class="w-8 h-8 rounded-full bg-primary-light text-primary flex items-center justify-center text-xs font-medium flex-shrink-0">
                            {{ strtoupper(substr($activity->user->screen_name, 0, 2)) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="text-xs font-medium text-gray-900 truncate">{{ $activity->user->name }}</div>
                            <div class="text-xs text-gray-400 truncate"><span>@</span>{{ $activity->user->screen_name }}</div>
                        </div>
                        <div class="text-xs text-gray-400 flex-shrink-0">{{ $this->timeLabel($activity->created_at) }}</div>
                    </div>
                    <p class="text-sm text-gray-700 mb-2">ステータスを{{ $this->stateLabel($activity->new_state) }}に変更しました</p>
                    <div class="bg-gray-50 border border-gray-200 rounded-sm">
                        <livewire:song.item
                            :song="$activity->song"
                            :state="$statuses[$activity->song_id] ?? 0"
                            :key="'timeline-'.$activity->id.'-'.$activity->song_id.'-'.($statuses[$activity->song_id] ?? 0)"
                        />
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="p-8 text-center">
            <p class="text-sm text-gray-600">まだ履歴がありません。</p>
        </div>
    @endif
</div>
