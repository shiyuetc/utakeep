<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.partials.head')
        @livewireStyles
    </head>
    <body class="bg-gray-50 text-gray-900 antialiased min-h-screen flex flex-col">
        @include('layouts.partials.header')
        <main class="flex-1">
            <div class="max-w-5xl mx-auto p-2 pb-24 flex gap-2">
                <aside class="hidden md:block w-64 flex-shrink-0">
                    @include('layouts.partials.sidebar')
                </aside>
                <section class="w-full flex-1 min-w-0">
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
