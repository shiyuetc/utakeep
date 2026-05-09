<x-section title="みんなの記録" icon="ti-history">
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
</x-section>
