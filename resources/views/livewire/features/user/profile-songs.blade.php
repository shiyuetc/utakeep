<x-section title="{{ $this->stateLabel($state) }}" icon="ti-music">
    @if ($statuses->isNotEmpty())
        <div class="divide-y divide-gray-200">
            @foreach ($statuses as $status)
                <livewire:components.song.item
                    :song="$status->song"
                    :state="$viewerStatuses[$status->song_id] ?? 0"
                    :key="'user-'.$user->id.'-'.$state.'-'.$status->song_id.'-'.($viewerStatuses[$status->song_id] ?? 0)"
                />
            @endforeach
        </div>
    @else
        <div class="p-8 text-center">
            <p class="text-sm text-gray-600">まだ{{ $this->stateLabel($state) }}曲はありません。</p>
        </div>
    @endif
</x-section>
