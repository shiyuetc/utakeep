<header class="sticky top-0 z-50 bg-white border-b border-gray-200">
    <div class="max-w-5xl mx-auto px-8 h-14 flex items-center justify-between">
        <div class="text-lg font-medium tracking-tight text-gray-900">
            <a href="{{ route('home') }}">Uta<span class="text-primary">keep</span></a>
        </div>
        <div class="flex items-center gap-2">
            @auth
                <form action="{{ route('songs') }}" method="GET" class="hidden sm:flex items-center">
                    <label for="header-song-search" class="sr-only">曲検索</label>
                    <div class="relative">
                        <i class="ti ti-search absolute left-2.5 top-1/2 -translate-y-1/2 text-sm text-gray-400" aria-hidden="true"></i>
                        <input
                            id="header-song-search"
                            type="search"
                            name="q"
                            value=""
                            placeholder="曲を検索"
                            class="w-44 lg:w-56 h-9 pl-8 pr-3 text-sm border border-gray-200 bg-gray-50 text-gray-900 rounded-sm outline-none focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/10 transition"
                            autocomplete="off"
                        >
                    </div>
                </form>
                <div class="relative group">
                    <button type="button" class="rounded-full outline-none focus-visible:ring-2 focus-visible:ring-primary/20">
                        <x-user-avatar :user="auth()->user()" size="sm" hover="self" />
                    </button>
                    <div class="hidden group-focus-within:block absolute -right-4 mt-2 w-48 bg-white border border-gray-200 rounded-sm shadow-sm overflow-hidden">
                        <a href="{{ route('users.show', auth()->user()) }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-900 transition">
                            <i class="ti ti-user text-base" aria-hidden="true"></i>
                            <span>マイページ</span>
                        </a>
                        <a href="{{ route('settings') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-900 transition">
                            <i class="ti ti-settings text-base" aria-hidden="true"></i>
                            <span>設定</span>
                        </a>
                        <form method="POST" action="/logout" class="border-t border-gray-200">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-2 px-4 py-2.5 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-900 transition cursor-pointer">
                                <i class="ti ti-logout text-base" aria-hidden="true"></i>
                                <span>ログアウト</span>
                            </button>
                        </form>
                    </div>
                </div>
            @else
                @if (Request::is('/'))
                    <a href="{{ route('login') }}" class="px-4 py-1.5 text-sm text-gray-700 hover:bg-gray-50 transition">ログイン</a>
                    <a href="{{ route('register') }}" class="px-4 py-1.5 text-sm bg-primary rounded-sm text-primary-light hover:bg-primary-hover transition">新規登録</a>
                @endif
            @endauth
        </div>
    </div>
</header>
