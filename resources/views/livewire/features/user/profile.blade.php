<div class="bg-white border border-gray-200 rounded-sm overflow-hidden">
    <div class="p-4">
        <div class="flex items-start gap-3">
            <x-user-avatar :user="$user" size="xl" />
            <div class="min-w-0 flex-1">
                <h1 class="text-base font-medium text-gray-900 truncate hover:underline underline-offset-2">{{ $user->name }}</h1>
                <div class="flex items-center gap-2 min-w-0">
                    <div class="text-sm text-gray-400 truncate"><span>@</span>{{ $user->screen_name }}</div>
                    @if (! $isOwnProfile && $isFollowedByViewer)
                        <span class="flex-shrink-0 text-[11px] text-gray-500 bg-gray-100 px-1.5 py-0.5 rounded-sm">フォローされています</span>
                    @endif
                </div>
                <div class="flex items-center gap-3 mt-2 text-xs text-gray-500">
                    <a
                        href="{{ route('users.show.following', ['user' => $user->screen_name]) }}"
                        class="text-left hover:underline cursor-pointer {{ $activeRouteName === 'users.show.following' ? 'text-primary underline' : '' }}"
                    >
                        <span class="font-medium text-gray-900">{{ $followingCount }}</span>
                        <span>フォロー</span>
                    </a>
                    <a
                        href="{{ route('users.show.followers', ['user' => $user->screen_name]) }}"
                        class="text-left hover:underline cursor-pointer {{ $activeRouteName === 'users.show.followers' ? 'text-primary underline' : '' }}"
                    >
                        <span class="font-medium text-gray-900">{{ $followersCount }}</span>
                        <span>フォロワー</span>
                    </a>
                </div>
            </div>
            @unless ($isOwnProfile)
                <button
                    type="button"
                    wire:click="toggleFollow"
                    wire:loading.attr="disabled"
                    class="h-8 px-3 text-xs font-medium rounded-sm transition cursor-pointer disabled:cursor-not-allowed disabled:opacity-60 {{ $isFollowing ? 'border border-gray-200 text-gray-700 hover:bg-gray-50' : 'bg-primary text-primary-light hover:bg-primary-hover' }}"
                >
                    {{ $isFollowing ? 'フォロー中' : 'フォロー' }}
                </button>
            @endunless
        </div>
        @if (filled($user->description))
            <p class="mt-3 text-sm text-gray-700 whitespace-pre-line break-words">{{ $user->description }}</p>
        @endif
    </div>
    <div class="grid grid-cols-4 border-t border-gray-200 divide-x divide-gray-200">
        <a
            href="{{ route('users.show', ['user' => $user->screen_name]) }}"
            class="px-3 py-2 text-center transition cursor-pointer {{ $activeRouteName === 'users.show' ? 'bg-primary-light text-primary' : 'text-gray-500 hover:bg-gray-50' }}"
        >
            <div class="text-xs">記録</div>
            <div class="text-sm font-medium mt-0.5">{{ $statusCounts[0] ?? 0 }}</div>
        </a>
        <a
            href="{{ route('users.show.status', ['user' => $user->screen_name, 'status' => 1]) }}"
            class="px-3 py-2 text-center transition cursor-pointer {{ $activeStatus === 1 ? 'bg-primary-light text-primary' : 'text-gray-500 hover:bg-gray-50' }}"
        >
            <div class="text-xs">気になる</div>
            <div class="text-sm font-medium mt-0.5">{{ $statusCounts[1] ?? 0 }}</div>
        </a>
        <a
            href="{{ route('users.show.status', ['user' => $user->screen_name, 'status' => 2]) }}"
            class="px-3 py-2 text-center transition cursor-pointer {{ $activeStatus === 2 ? 'bg-primary-light text-primary' : 'text-gray-500 hover:bg-gray-50' }}"
        >
            <div class="text-xs">練習中</div>
            <div class="text-sm font-medium mt-0.5">{{ $statusCounts[2] ?? 0 }}</div>
        </a>
        <a
            href="{{ route('users.show.status', ['user' => $user->screen_name, 'status' => 3]) }}"
            class="px-3 py-2 text-center transition cursor-pointer {{ $activeStatus === 3 ? 'bg-primary-light text-primary' : 'text-gray-500 hover:bg-gray-50' }}"
        >
            <div class="text-xs">習得済み</div>
            <div class="text-sm font-medium mt-0.5">{{ $statusCounts[3] ?? 0 }}</div>
        </a>
    </div>
</div>