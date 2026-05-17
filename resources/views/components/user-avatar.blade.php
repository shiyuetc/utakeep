@props([
    'user',
    'size' => 'md',
    'hover' => false,
])

@php
    $sizeClasses = match ($size) {
        'xs' => 'w-8 h-8 text-xs',
        'sm' => 'w-9 h-9 text-sm',
        'md' => 'w-11 h-11 text-sm',
        'lg' => 'w-12 h-12 text-lg',
        'xl' => 'w-14 h-14 text-lg',
    };

    $hoverClasses = match ($hover) {
        'self' => 'hover:bg-primary hover:text-primary-light transition',
        true => 'group-hover:bg-primary group-hover:text-primary-light transition',
        default => '',
    };
@endphp

<div {{ $attributes->class([
    'rounded-full flex items-center justify-center font-medium flex-shrink-0 bg-primary-light text-primary',
    $sizeClasses,
    $hoverClasses,
]) }}>
    {{ strtoupper(substr($user->screen_name, 0, 2)) }}
</div>
