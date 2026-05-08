<div>
    <form wire:submit="search" class="flex gap-2 mb-4">
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
    @if ($searched)
        @if (count($songs) > 0)
            <p class="text-xs text-gray-600 mb-3">{{ count($songs) }}件ヒットしました</p>
            <div class="flex flex-col gap-2">
                @foreach ($songs as $song)
                <div class="flex items-center gap-3 bg-gray-50 border border-gray-200 rounded-sm px-4 py-3">
                    <div class="w-11 h-11 border border-gray-200 rounded-sm bg-gray-100 flex items-center justify-center flex-shrink-0 overflow-hidden">
                        @if ($song['image_url'])
                            <img src="{{ $song['image_url'] }}" alt="{{ $song['title'] }}" class="w-full h-full object-cover">
                        @else
                            <i class="ti ti-music text-gray-300 text-lg" aria-hidden="true"></i>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="text-sm font-medium text-gray-900 truncate">{{ $song['title'] }}</div>
                        <div class="text-xs text-gray-600 truncate mt-0.5">{{ $song['artist_name'] }}</div>
                    </div>
                    <livewire:song.state-selector
                        :songId="$song['id']"
                        :state="$statuses[$song['id']] ?? 0"
                        :key="'search-'.$song['id']"
                    />
                </div>
                @endforeach
            </div>
        @else
            <p class="text-sm text-gray-400 text-center py-8">曲が見つかりませんでした。</p>
        @endif
    @endif
</div>