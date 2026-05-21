@props([
    'datetime',
])

@php
    $diffInSeconds = (int) $datetime->diffInSeconds(now(), true);

    $label = match (true) {
        $diffInSeconds < 60 => 'たった今',
        $datetime->diffInMinutes(now(), true) < 60 => ((int) $datetime->diffInMinutes(now(), true)).'分前',
        $datetime->diffInHours(now(), true) < 24 => ((int) $datetime->diffInHours(now(), true)).'時間前',
        $datetime->diffInDays(now(), true) < 7 => ((int) $datetime->diffInDays(now(), true)).'日前',
        default => $datetime->format('Y/m/d'),
    };
@endphp

<time {{ $attributes->class('text-xs text-gray-400 flex-shrink-0') }} datetime="{{ $datetime->toIso8601String() }}">{{ $label }}</time>
