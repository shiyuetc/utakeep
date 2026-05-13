<div class="flex flex-col gap-2">
    <div class="bg-white border border-gray-200 rounded-sm overflow-hidden">
        <div class="p-4">
            <div class="flex items-start gap-3">
                <div class="w-14 h-14 rounded-full bg-primary-light text-primary flex items-center justify-center text-lg font-medium flex-shrink-0">
                    {{ strtoupper(substr($user->screen_name, 0, 2)) }}
                </div>
                <div class="min-w-0 flex-1">
                    <h1 class="text-base font-medium text-gray-900 truncate">{{ $user->name }}</h1>
                    <div class="flex items-center gap-2 min-w-0">
                        <div class="text-sm text-gray-400 truncate"><span>@</span>{{ $user->screen_name }}</div>
                        @if (! $isOwnProfile && $isFollowedByViewer)
                            <span class="flex-shrink-0 text-[11px] text-gray-500 bg-gray-100 px-1.5 py-0.5 rounded-sm">フォローされています</span>
                        @endif
                    </div>
                    <div class="flex items-center gap-3 mt-2 text-xs text-gray-500">
                        <button
                            type="button"
                            wire:click="showFollowList('following')"
                            class="text-left hover:underline cursor-pointer {{ $activeFollowList === 'following' ? 'text-primary underline' : '' }}"
                        >
                            <span class="font-medium text-gray-900">{{ $followingCount }}</span>
                            <span>フォロー</span>
                        </button>
                        <button
                            type="button"
                            wire:click="showFollowList('followers')"
                            class="text-left hover:underline cursor-pointer {{ $activeFollowList === 'followers' ? 'text-primary underline' : '' }}"
                        >
                            <span class="font-medium text-gray-900">{{ $followersCount }}</span>
                            <span>フォロワー</span>
                        </button>
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
            @foreach ([0, 1, 2, 3] as $state)
                <button
                    type="button"
                    wire:click="setActiveState({{ $state }})"
                    class="px-3 py-2 text-center transition cursor-pointer {{ ! $activeFollowList && $activeState === $state ? 'bg-primary-light text-primary' : 'text-gray-500 hover:bg-gray-50' }}"
                >
                    <div class="text-xs">{{ $this->stateLabel($state) }}</div>
                    <div class="text-sm font-medium mt-0.5">{{ $counts[$state] ?? 0 }}</div>
                </button>
            @endforeach
        </div>
    </div>

    @if ($activeFollowList)
        <livewire:features.user.follow-list
            :user="$user"
            :type="$activeFollowList"
            :key="'follow-list-'.$user->id.'-'.$activeFollowList"
        />
    @elseif ($activeState === 0)
        <livewire:features.activity.timeline
            :user="$user"
            :key="'profile-timeline-'.$user->id"
        />
    @else
        <livewire:features.user.profile-songs
            :user="$user"
            :state="$activeState"
            :key="'profile-songs-'.$user->id.'-'.$activeState"
        />
    @endif
</div>
