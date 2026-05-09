@props([
    'title',
    'icon' => null,
    'bodyClass' => null,
])

<section {{ $attributes->merge(['class' => 'bg-white mb-2 border border-gray-200 rounded-sm overflow-hidden']) }}>
    <div class="px-4 py-2.5 border-b border-gray-200">
        <h2 class="flex items-center gap-2 text-sm text-gray-900">
            @if ($icon)
                <i class="ti {{ $icon }} text-base text-primary" aria-hidden="true"></i>
            @endif
            {{ $title }}
        </h2>
    </div>

    <div @class([$bodyClass => $bodyClass])>
        {{ $slot }}
    </div>
</section>
