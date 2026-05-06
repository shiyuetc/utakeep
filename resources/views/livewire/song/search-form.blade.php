<div>
    <form wire:submit="search">
        <input
            type="text"
            wire:model="term"
            placeholder="曲名・アーティスト名で検索"
        >
        <button type="submit">検索</button>
    </form>

    @if ($searched)
        @if (count($songs) > 0)
            <ul>
                @foreach ($songs as $song)
                    <li>
                        {{ $song['title'] }} / {{ $song['artist_name'] }}
                    </li>
                @endforeach
            </ul>
        @else
            <p>曲が見つかりませんでした。</p>
        @endif
    @endif
</div>