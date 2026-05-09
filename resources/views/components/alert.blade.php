@props([
    'type' => 'success',
    'close' => null,
])

@php
$classes = match ($type) {
    'error' => [
        'box' => 'border-red-200 bg-red-50 text-red-700',
        'icon' => 'ti-alert-circle',
        'button' => 'hover:bg-red-100',
    ],
    default => [
        'box' => 'border-green-200 bg-green-50 text-green-700',
        'icon' => 'ti-circle-check',
        'button' => 'hover:bg-green-100',
    ],
};
@endphp

<div {{ $attributes->merge(['class' => "flex items-center gap-2 border px-3 py-2 text-sm rounded-sm {$classes['box']}"]) }}>
    <i class="ti {{ $classes['icon'] }} text-base flex-shrink-0" aria-hidden="true"></i>
    <span class="flex-1">{{ $slot }}</span>

    @if ($close)
        <button type="button" wire:click="{{ $close }}" class="flex items-center justify-center w-6 h-6 rounded-sm transition cursor-pointer {{ $classes['button'] }}" aria-label="閉じる">
            <i class="ti ti-x text-base" aria-hidden="true"></i>
        </button>
    @endif
</div>
