<div class="bg-white border border-gray-200 rounded-sm overflow-hidden">
    <div class="px-4 py-2 border-b border-gray-200">
        <h2 class="flex items-center gap-2 text-sm text-gray-900">
            <i class="ti ti-history text-base text-primary" aria-hidden="true"></i>みんなの記録
        </h2>
    </div>
    @if ($activities->isNotEmpty())
        <div class="divide-y divide-gray-200">
            @foreach ($activities as $activity)
                <livewire:activity.item
                    :activity="$activity"
                    :state="$statuses[$activity->song_id] ?? 0"
                    :key="'timeline-activity-'.$activity->id.'-'.$activity->song_id.'-'.($statuses[$activity->song_id] ?? 0)"
                />
            @endforeach
        </div>
    @else
        <div class="p-8 text-center">
            <p class="text-sm text-gray-600">まだ履歴がありません。</p>
        </div>
    @endif
</div>
