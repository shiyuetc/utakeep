<x-ui.section title="{{ $title }}" icon="ti-history">
    @if ($userId === null)
        <x-slot:actions>
            <div class="inline-flex overflow-hidden rounded-sm border border-gray-200 text-xs">
                <button
                    type="button"
                    wire:click="setScope('following')"
                    class="px-2.5 py-1 transition {{ $scope === 'following' ? 'bg-primary-light text-primary' : 'bg-white text-gray-500 hover:bg-gray-50 cursor-pointer' }}"
                >
                    フォロー中
                </button>
                <button
                    type="button"
                    wire:click="setScope('global')"
                    class="border-l border-gray-200 px-2.5 py-1 transition {{ $scope === 'global' ? 'bg-primary-light text-primary' : 'bg-white text-gray-500 hover:bg-gray-50 cursor-pointer' }}"
                >
                    全体
                </button>
            </div>
        </x-slot:actions>
    @endif

    @if (! $canViewLibrary)
        <div class="p-8 text-center">
            <p class="text-sm text-gray-600">このユーザーの記録は非公開です。</p>
        </div>
    @elseif ($activities->isNotEmpty())
        <div class="divide-y divide-gray-200">
            @foreach ($activities as $activity)
                <livewire:components.activity.item
                    :activity="$activity"
                    :state="$statuses[$activity->song_id] ?? 0"
                    :key="'timeline-activity-'.$activity->id.'-'.$activity->song_id.'-'.($statuses[$activity->song_id] ?? 0)"
                />
            @endforeach
        </div>

        @if ($hasMore)
            <div class="border-t border-gray-200 p-4 text-center">
                <button
                    type="button"
                    wire:click="loadMore"
                    wire:loading.attr="disabled"
                    class="inline-flex items-center justify-center rounded-sm border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-50 disabled:cursor-not-allowed disabled:opacity-60"
                >
                    さらに読み込む
                </button>
            </div>
        @endif
    @else
        <div class="p-8 text-center">
            <p class="text-sm text-gray-600">まだ記録はありません。</p>
        </div>
    @endif
</x-ui.section>
