<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.partials.head')
        @livewireStyles
    </head>
    <body class="bg-gray-50 text-gray-900 antialiased min-h-screen flex flex-col">
        @include('layouts.partials.header')
        <main class="flex-1">
            @yield('content')
        </main>
        @include('layouts.partials.footer')
        @livewireScripts
    </body>
</html>