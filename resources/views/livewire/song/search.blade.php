<div class="bg-white border border-gray-200 rounded-sm overflow-hidden">
    <div class="px-4 py-2 border-b border-gray-200">
        <h2 class="flex items-center gap-2 text-sm text-gray-900">
            <i class="ti ti-search text-base text-primary" aria-hidden="true"></i>曲検索
        </h2>
    </div>

    <div class="p-4">
        <form wire:submit="search" class="flex gap-2">
            <input
                type="text"
                wire:model="term"
                placeholder="曲名・アーティスト名"
                class="flex-1 h-10 px-3 text-sm border border-gray-200 bg-white text-gray-900 rounded-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition"
                required
            >
            <button type="submit" class="h-10 px-5 bg-primary text-primary-light text-sm font-medium hover:bg-primary-hover rounded-sm transition cursor-pointer flex-shrink-0">
                <span wire:loading.remove wire:target="search">検索</span>
                <span wire:loading>検索中...</span>
            </button>
        </form>
    </div>

    @if ($searched)
        @if (count($songs) > 0)
            <p class="text-xs text-gray-600 px-4 pb-2">{{ count($songs) }}件ヒットしました</p>
            <div class="border-t border-gray-200 divide-y divide-gray-200">
                @foreach ($songs as $song)
                    <livewire:song.item
                        :song="$song"
                        :state="$statuses[$song->id] ?? 0"
                        :key="'search-'.$song->id"
                    />
                @endforeach
            </div>
        @else
            <p class="text-sm text-gray-400 text-center py-8">曲が見つかりませんでした。</p>
        @endif
    @endif
</div>
