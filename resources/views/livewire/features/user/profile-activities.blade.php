<x-section title="記録">
    @if ($activities->isNotEmpty())
        <div class="divide-y divide-gray-200">
            @foreach ($activities as $activity)
                <livewire:components.activity.item
                    :activity="$activity"
                    :state="$viewerStatuses[$activity->song_id] ?? 0"
                    :key="'user-activity-'.$user->id.'-'.$activity->id.'-'.($viewerStatuses[$activity->song_id] ?? 0)"
                />
            @endforeach
        </div>
    @else
        <div class="p-8 text-center">
            <p class="text-sm text-gray-600">まだ記録はありません。</p>
        </div>
    @endif
</x-section>
