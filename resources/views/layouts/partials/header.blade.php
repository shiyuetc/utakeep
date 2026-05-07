<header class="sticky top-0 z-50 bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-5xl mx-auto px-8 h-14 flex items-center justify-between">
        <div class="text-lg font-medium tracking-tight text-gray-900">
            <a href="{{ route('home') }}">Uta<span class="text-primary">keep</span></a>
        </div>
        <div class="flex gap-2">
            @auth
                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit" class="px-4 py-1.5 text-sm text-gray-700 cursor-pointer">ログアウト</button>
                </form>
            @else
                @if (Request::is('/'))
                    <a href="{{ route('login') }}" class="px-4 py-1.5 text-sm text-gray-700 hover:bg-gray-50 transition">ログイン</a>
                    <a href="{{ route('register') }}" class="px-4 py-1.5 text-sm bg-primary text-primary-light hover:bg-primary-hover transition">新規登録</a>
                @endif
            @endauth
        </div>
    </div>
</header>
