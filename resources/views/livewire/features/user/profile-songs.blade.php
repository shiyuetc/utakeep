<x-section title="{{ $this->stateLabel($state) }}" icon="ti-music">
    @if ($statuses->count() > 0)
        <div class="divide-y divide-gray-200">
            @foreach ($statuses as $status)
                <livewire:components.song.item
                    :song="$status->song"
                    :state="$viewerStatuses[$status->song_id] ?? 0"
                    :key="'user-'.$user->id.'-'.$state.'-'.$status->song_id.'-'.($viewerStatuses[$status->song_id] ?? 0)"
                />
            @endforeach
        </div>

        @if ($statuses->hasPages())
            <div class="border-t border-gray-200 px-4 py-3">
                {{ $statuses->links(data: ['scrollTo' => false]) }}
            </div>
        @endif
    @else
        <div class="p-8 text-center">
            <p class="text-sm text-gray-600">まだ{{ $this->stateLabel($state) }}曲はありません。</p>
        </div>
    @endif
</x-section>
