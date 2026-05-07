<div class="flex flex-col gap-3">
    <div class="bg-white border border-gray-200 shadow-md p-5">
    <div class="flex items-center gap-3">
        <div class="w-12 h-12 rounded-full bg-purple-100 text-primary flex items-center justify-center text-lg font-medium flex-shrink-0">
            {{ strtoupper(substr(auth()->user()->screen_name, 0, 2)) }}
        </div>
        <div class="min-w-0">
            <div class="text-sm font-medium text-gray-900 truncate">{{ auth()->user()->name }}</div>
            <div class="text-xs text-gray-400 mt-0.5"><span>@</span>{{ auth()->user()->screen_name }}</div>
        </div>
    </div>
</div>
    <div class="bg-white border border-gray-200 shadow-md overflow-hidden">
        <a href="/" class="flex items-center gap-2.5 px-4 py-2.5 text-sm border-b border-gray-200 transition
                  {{ request()->routeIs('home') ? 'text-primary bg-primary-light font-medium' : 'text-gray-500 hover:bg-gray-50' }}">
            <i class="ti ti-home text-base" aria-hidden="true"></i>ホーム
        </a>
        <a href="/songs" class="flex items-center gap-2.5 px-4 py-2.5 text-sm border-b border-gray-200 transition
                  {{ request()->routeIs('songs') ? 'text-primary bg-primary-light font-medium' : 'text-gray-500 hover:bg-gray-50' }}">
            <i class="ti ti-search text-base" aria-hidden="true"></i>曲を検索
        </a>
    </div>
</div>