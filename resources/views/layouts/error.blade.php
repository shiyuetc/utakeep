<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.partials.head')
    </head>
    <body class="bg-gray-50 text-gray-900 antialiased min-h-screen">
        <main class="min-h-screen flex items-center justify-center px-6 py-12">
            <section class="w-full max-w-md bg-white border border-gray-200 rounded-sm p-8 text-center">
                <a class="inline-block text-xl font-medium mb-6">
                    <x-app-logo />
                </a>

                <p class="text-lg font-medium tracking-wide text-primary mb-3">@yield('code')</p>
                <h1 class="text-md font-medium text-gray-900">@yield('title')</h1>
                <p class="text-sm text-gray-500 leading-relaxed">@yield('message')</p>

                <div class="flex flex-col sm:flex-row justify-center gap-2 mt-8">
                    <a href="{{ route('home') }}" class="h-9 px-4 inline-flex items-center justify-center bg-primary text-primary-light text-sm font-medium hover:bg-primary-hover rounded-sm transition">
                        ホームへ戻る
                    </a>
                    <button type="button" onclick="history.back()" class="h-9 px-4 inline-flex items-center justify-center border border-gray-200 text-sm text-gray-700 hover:bg-gray-50 rounded-sm transition cursor-pointer">
                        前のページへ戻る
                    </button>
                </div>
            </section>
        </main>
    </body>
</html>
