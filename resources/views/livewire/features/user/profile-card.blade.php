<div class="flex flex-col gap-2">
    <div class="bg-white border border-gray-200 rounded-sm overflow-hidden">
        <a href="{{ route('users.show', ['user' => $user->screen_name]) }}" class="p-4 block border-b border-gray-200 hover:bg-gray-50 transition">
            <div class="flex items-center gap-3">
                <x-atoms.avatar :user="$user" size="lg" />
                <div class="min-w-0">
                    <div class="text-sm font-medium text-gray-900 truncate hover:underline underline-offset-2">{{ $user->name }}</div>
                    <div class="text-xs text-gray-400 mt-0.5"><span>@</span>{{ $user->screen_name }}</div>
                </div>
            </div>
        </a>

        <a href="{{ route('users.show', ['user' => $user->screen_name]) }}" class="flex items-center gap-2 px-4 py-2.5 text-sm border-b border-gray-200 transition {{ $isOwnProfileRoute && $activeRouteName === 'users.show' ? 'text-primary bg-primary-light font-medium' : 'text-gray-500 hover:bg-gray-50' }}">
            <i class="ti ti-history text-base" aria-hidden="true"></i>
            <span class="min-w-0 flex-1">記録</span>
            <span class="text-xs font-medium">{{ $user->activity_count }}</span>
        </a>
        <a href="{{ route('users.show.status', ['user' => $user->screen_name, 'status' => 1]) }}" class="flex items-center gap-2 px-4 py-2.5 text-sm border-b border-gray-200 transition {{ $isOwnProfileRoute && $activeStatus === 1 ? 'text-primary bg-primary-light font-medium' : 'text-gray-500 hover:bg-gray-50' }}">
            <i class="ti ti-music text-base" aria-hidden="true"></i>
            <span class="min-w-0 flex-1">気になる</span>
            <span class="text-xs font-medium">{{ $user->status1_count }}</span>
        </a>
        <a href="{{ route('users.show.status', ['user' => $user->screen_name, 'status' => 2]) }}" class="flex items-center gap-2 px-4 py-2.5 text-sm border-b border-gray-200 transition {{ $isOwnProfileRoute && $activeStatus === 2 ? 'text-primary bg-primary-light font-medium' : 'text-gray-500 hover:bg-gray-50' }}">
            <i class="ti ti-music text-base" aria-hidden="true"></i>
            <span class="min-w-0 flex-1">練習中</span>
            <span class="text-xs font-medium">{{ $user->status2_count }}</span>
        </a>
        <a href="{{ route('users.show.status', ['user' => $user->screen_name, 'status' => 3]) }}" class="flex items-center gap-2 px-4 py-2.5 text-sm transition {{ $isOwnProfileRoute && $activeStatus === 3 ? 'text-primary bg-primary-light font-medium' : 'text-gray-500 hover:bg-gray-50' }}">
            <i class="ti ti-music text-base" aria-hidden="true"></i>
            <span class="min-w-0 flex-1">習得済み</span>
            <span class="text-xs font-medium">{{ $user->status3_count }}</span>
        </a>
    </div>
</div>
