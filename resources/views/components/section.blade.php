@props([
    'title',
    'icon' => null,
    'bodyClass' => null,
])

<section {{ $attributes->merge(['class' => 'bg-white mb-2 border border-gray-200 rounded-sm overflow-hidden']) }}>
    <div class="flex items-center justify-between px-2 border-b border-gray-200">
        <h2 class="flex min-w-0 items-center gap-2 px-2 py-2.5 text-sm text-gray-900">
            @if ($icon)
                <i class="ti {{ $icon }} flex-shrink-0 text-base text-primary" aria-hidden="true"></i>
            @endif
            <span class="truncate">{{ $title }}</span>
        </h2>

        @isset($actions)
            <div class="flex flex-shrink-0 items-center gap-2">
                {{ $actions }}
            </div>
        @endisset
    </div>

    <div @class([$bodyClass => $bodyClass])>
        {{ $slot }}
    </div>
</section>
