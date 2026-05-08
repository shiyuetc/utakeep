<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.partials.head')
        @livewireStyles
    </head>
    <body class="bg-gray-50 text-gray-900 antialiased min-h-screen md:h-screen md:overflow-hidden flex flex-col">
        @include('layouts.partials.header')
        <main class="flex-1 md:min-h-0">
            <div class="max-w-5xl mx-auto p-2 pb-24 md:px-2 md:py-0 flex gap-2 md:h-full md:min-h-0 md:overflow-hidden">
                <aside class="hidden md:block w-64 flex-shrink-0 md:py-2">
                    @include('layouts.partials.sidebar')
                </aside>
                <section class="w-full flex-1 min-w-0 md:h-full md:overflow-y-auto md:py-2 md:pr-1">
                    @yield('content')
                </section>
            </div>
        </main>
        @include('layouts.partials.mobile-menu')
        <div class="hidden md:block">
            @include('layouts.partials.footer')
        </div>
        @livewireScripts
    </body>
</html>
