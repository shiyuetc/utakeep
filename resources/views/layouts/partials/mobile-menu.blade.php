<nav class="fixed bottom-0 left-0 right-0 z-40 md:hidden border-t border-gray-200 bg-white">
    <div class="grid grid-cols-2">
        <a href="/" class="flex flex-col items-center justify-center gap-0.5 py-2.5 text-xs transition
                  {{ request()->routeIs('home') ? 'text-primary font-medium' : 'text-gray-400' }}">
            <i class="ti ti-home text-xl" aria-hidden="true"></i>
            <span>ホーム</span>
        </a>
        <a href="/songs" class="flex flex-col items-center justify-center gap-0.5 py-2.5 text-xs transition
                  {{ request()->routeIs('songs') ? 'text-primary font-medium' : 'text-gray-400' }}">
            <i class="ti ti-search text-xl" aria-hidden="true"></i>
            <span>曲を検索</span>
        </a>
    </div>
</nav>
