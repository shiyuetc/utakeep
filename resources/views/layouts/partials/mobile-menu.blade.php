<nav class="fixed bottom-0 left-0 right-0 z-40 md:hidden border-t border-gray-200 bg-white">
    <div class="grid grid-cols-3">
        <a href="/" class="flex flex-col items-center justify-center gap-0.5 py-2.5 text-xs transition
                  {{ request()->routeIs('home') ? 'text-primary font-medium' : 'text-gray-400' }}">
            <i class="ti ti-home text-xl" aria-hidden="true"></i>
            <span>{{ __('navigation.home') }}</span>
        </a>
        <a href="/songs" class="flex flex-col items-center justify-center gap-0.5 py-2.5 text-xs transition
                  {{ request()->routeIs('songs') ? 'text-primary font-medium' : 'text-gray-400' }}">
            <i class="ti ti-search text-xl" aria-hidden="true"></i>
            <span>{{ __('navigation.search_songs') }}</span>
        </a>
        <a href="{{ route('users.index') }}" class="flex flex-col items-center justify-center gap-0.5 py-2.5 text-xs transition
                  {{ request()->routeIs('users.index') ? 'text-primary font-medium' : 'text-gray-400' }}">
            <i class="ti ti-users text-xl" aria-hidden="true"></i>
            <span>{{ __('navigation.search_users') }}</span>
        </a>
    </div>
</nav>
