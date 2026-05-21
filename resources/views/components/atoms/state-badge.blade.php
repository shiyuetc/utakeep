@props([
    'state',
])

@php
    $state = (int) $state;

    $label = match ($state) {
        1 => '気になる',
        2 => '練習中',
        3 => '習得済み',
        default => '未設定',
    };

    $class = match ($state) {
        1 => 'border-amber-200 bg-amber-50 text-amber-700',
        2 => 'border-blue-200 bg-blue-50 text-blue-700',
        3 => 'border-green-200 bg-green-50 text-green-700',
        default => 'border-gray-200 bg-gray-50 text-gray-600',
    };
@endphp

<span {{ $attributes->class([
    'inline-flex items-center px-1 py-0.5 text-xs border rounded-sm',
    $class,
]) }}>
    {{ $label }}
</span>
