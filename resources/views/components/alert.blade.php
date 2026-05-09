@props([
    'type' => 'default',
    'closeable' => true,
])

@php
$classes = match ($type) {
    'info' => [
        'box' => 'border-blue-200 bg-blue-50 text-blue-700',
        'icon' => 'ti-info-circle',
        'button' => 'hover:bg-blue-100',
    ],
    'success' => [
        'box' => 'border-green-200 bg-green-50 text-green-700',
        'icon' => 'ti-circle-check',
        'button' => 'hover:bg-green-100',
    ],
    'error' => [
        'box' => 'border-red-200 bg-red-50 text-red-700',
        'icon' => 'ti-alert-circle',
        'button' => 'hover:bg-red-100',
    ],
    default => [
        'box' => 'border-gray-200 bg-gray-50 text-gray-700',
        'icon' => 'ti-bell',
        'button' => 'hover:bg-gray-100',
    ],
};
@endphp

<div data-alert {{ $attributes->merge(['class' => "flex items-center gap-2 border px-3 py-2 text-sm rounded-sm {$classes['box']}"]) }}>
    <i class="ti {{ $classes['icon'] }} text-base flex-shrink-0" aria-hidden="true"></i>
    <span class="flex-1">{{ $slot }}</span>

    @if ($closeable)
        <button type="button" onclick="this.closest('[data-alert]').hidden = true" class="flex items-center justify-center w-4 h-4 rounded-sm transition cursor-pointer {{ $classes['button'] }}" aria-label="閉じる">
            <i class="ti ti-x text-base" aria-hidden="true"></i>
        </button>
    @else
        <div class="w-4 h-4 flex-shrink-0"></div>
    @endif
</div>
