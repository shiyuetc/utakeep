<div class="flex flex-col gap-2">
    <livewire:features.user.profile-card :user="Auth::user()" />
    <div class="bg-white border border-gray-200 rounded-sm overflow-hidden">
        <a href="/" class="flex items-center gap-2 px-4 py-2.5 text-sm border-b border-gray-200 transition
                  {{ request()->routeIs('home') ? 'text-primary bg-primary-light font-medium' : 'text-gray-500 hover:bg-gray-50' }}">
            <i class="ti ti-home text-base" aria-hidden="true"></i>ホーム
        </a>
        <a href="/songs" class="flex items-center gap-2 px-4 py-2.5 text-sm border-b border-gray-200 transition
                  {{ request()->routeIs('songs') ? 'text-primary bg-primary-light font-medium' : 'text-gray-500 hover:bg-gray-50' }}">
            <i class="ti ti-search text-base" aria-hidden="true"></i>曲を検索
        </a>
        <a href="{{ route('users.index') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm transition
                  {{ request()->routeIs('users.index') ? 'text-primary bg-primary-light font-medium' : 'text-gray-500 hover:bg-gray-50' }}">
            <i class="ti ti-users text-base" aria-hidden="true"></i>ユーザー検索
        </a>
    </div>
</div>
