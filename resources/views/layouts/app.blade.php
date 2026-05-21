<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.partials.head')
        @livewireStyles
    </head>
    <body class="bg-gray-50 text-gray-900 antialiased min-h-screen flex flex-col">
        @include('layouts.partials.header')
        <main class="flex-1">
            <div class="max-w-5xl mx-auto p-2 pb-24 flex">
                <aside class="hidden md:block w-64 fixed top-[65px]">
                    @include('layouts.partials.sidebar')
                </aside>
                <section class="w-full md:ml-66 gap-2 flex flex-col">
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
