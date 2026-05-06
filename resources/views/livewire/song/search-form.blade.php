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

                        <select wire:change="updateState({{ $song['id'] }}, $event.target.value)">
                            <option value="0" {{ ($statuses[$song['id']] ?? 0) === 0 ? 'selected' : '' }}>未設定</option>
                            <option value="1" {{ ($statuses[$song['id']] ?? 0) === 1 ? 'selected' : '' }}>気になる</option>
                            <option value="2" {{ ($statuses[$song['id']] ?? 0) === 2 ? 'selected' : '' }}>練習中</option>
                            <option value="3" {{ ($statuses[$song['id']] ?? 0) === 3 ? 'selected' : '' }}>習得済み</option>
                        </select>
                    </li>
                @endforeach
            </ul>
        @else
            <p>曲が見つかりませんでした。</p>
        @endif
    @endif
</div>