@php
$colorClass = match($state ?? 0) {
    1 => 'border-amber-200 bg-amber-50 text-amber-700',
    2 => 'border-blue-200 bg-blue-50 text-blue-700',
    3 => 'border-green-200 bg-green-50 text-green-700',
    default => 'border-gray-200 bg-white text-gray-700',
};
@endphp

<select
    wire:change="updateState($event.target.value)"
    class="flex-shrink-0 h-8 px-2 text-xs border rounded-lg outline-none focus:border-primary transition cursor-pointer w-24 {{ $colorClass }}"
>
    <option value="0" {{ ($state ?? 0) == 0 ? 'selected' : '' }}>未設定</option>
    <option value="1" {{ ($state ?? 0) == 1 ? 'selected' : '' }}>気になる</option>
    <option value="2" {{ ($state ?? 0) == 2 ? 'selected' : '' }}>練習中</option>
    <option value="3" {{ ($state ?? 0) == 3 ? 'selected' : '' }}>習得済み</option>
</select>