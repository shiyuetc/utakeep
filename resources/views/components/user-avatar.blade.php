@props([
    'user',
    'size' => 'md',
])

@php
    $sizeClasses = match ($size) {
        'xs' => 'w-8 h-8 text-xs',
        'sm' => 'w-9 h-9 text-sm',
        'md' => 'w-11 h-11 text-sm',
        'lg' => 'w-12 h-12 text-lg',
        'xl' => 'w-14 h-14 text-lg',
    };

    $colorClasses = [
        'bg-primary-light text-primary',
        'bg-blue-100 text-blue-700',
        'bg-emerald-100 text-emerald-700',
        'bg-amber-100 text-amber-700',
        'bg-rose-100 text-rose-700',
        'bg-cyan-100 text-cyan-700',
        'bg-fuchsia-100 text-fuchsia-700',
        'bg-lime-100 text-lime-700',
    ];

    $firstLetter = strtolower(substr($user->screen_name, 0, 1));
    $colorClasses = $colorClasses[ord($firstLetter ?: 'a') % count($colorClasses)];
@endphp

<div {{ $attributes->class([
    'rounded-full flex items-center justify-center font-medium flex-shrink-0',
    $sizeClasses,
    $colorClasses,
]) }}>
    {{ strtoupper(substr($user->screen_name, 0, 2)) }}
</div>
