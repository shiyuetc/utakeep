<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.partials.head')
        @livewireStyles
    </head>
    <body class="bg-gray-50 text-gray-900 antialiased min-h-screen flex flex-col">
        @include('layouts.partials.header')
        <main class="flex-1">
            <div class="max-w-5xl mx-auto px-4 py-6 flex gap-4">
                <aside class="w-64 flex-shrink-0">
                    @include('layouts.partials.sidebar')
                </aside>
                <section class="flex-1 min-w-0">
                    @yield('content')
                </section>
            </div>
        </main>
        @include('layouts.partials.footer')
        @livewireScripts
    </body>
</html>