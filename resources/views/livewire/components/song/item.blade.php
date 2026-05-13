@php
$colorClass = match($state ?? 0) {
    1 => 'border-amber-200 bg-amber-50 text-amber-700',
    2 => 'border-blue-200 bg-blue-50 text-blue-700',
    3 => 'border-green-200 bg-green-50 text-green-700',
    default => 'border-gray-200 bg-white text-gray-700',
};
@endphp

<div class="flex items-center gap-2.5 px-3 py-2.5">
    <div class="relative w-11 h-11 rounded bg-gray-200 flex items-center justify-center flex-shrink-0 overflow-hidden">
        @if ($song->image_url)
            <img src="{{ $song->image_url }}" alt="{{ $song->title }}" class="w-full h-full object-cover">
        @else
            <i class="ti ti-music text-gray-300 text-lg" aria-hidden="true"></i>
        @endif

        @if ($song->audio_url)
            <div wire:ignore class="mediPlayer absolute inset-0 flex items-center justify-center bg-black/20 transition hover:bg-black/30 cursor-pointer">
                <audio src="{{ $song->audio_url }}" data-size="40"></audio>
            </div>
        @endif
    </div>
    <div class="flex-1 min-w-0">
        <div class="text-sm font-medium text-gray-900 truncate">{{ $song->title }}</div>
        <a
            href="{{ route('songs', ['q' => 'artist_id:'.$song->artist_id]) }}"
            class="block text-xs text-gray-600 truncate mt-0.5 hover:text-primary hover:underline"
        >
            {{ $song->artist_name }}
        </a>
    </div>
    <select
        wire:change="updateState($event.target.value)"
        class="flex-shrink-0 h-8 px-2 text-xs border rounded-sm outline-none focus:border-primary transition cursor-pointer w-24 {{ $colorClass }}"
    >
        <option value="0" {{ ($state ?? 0) == 0 ? 'selected' : '' }}>未設定</option>
        <option value="1" {{ ($state ?? 0) == 1 ? 'selected' : '' }}>気になる</option>
        <option value="2" {{ ($state ?? 0) == 2 ? 'selected' : '' }}>練習中</option>
        <option value="3" {{ ($state ?? 0) == 3 ? 'selected' : '' }}>習得済み</option>
    </select>
</div>
