<x-ui.section title="ユーザー検索" icon="ti-users">
    <div class="p-4">
        <form wire:submit="search" class="flex gap-2">
            <input
                type="text"
                wire:model="term"
                placeholder="ユーザー名・ユーザーID"
                class="flex-1 h-10 px-3 text-sm border border-gray-200 bg-white text-gray-900 rounded-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition"
                required
            >
            <button type="submit" class="h-10 px-5 bg-primary text-primary-light text-sm font-medium hover:bg-primary-hover rounded-sm transition cursor-pointer flex-shrink-0">
                <span wire:loading.remove wire:target="search">検索</span>
                <span wire:loading>検索中...</span>
            </button>
        </form>
    </div>

    @if ($searched)
        @if ($users->isNotEmpty())
            <p class="text-xs text-gray-600 px-4 pb-3">{{ $users->count() }}件ヒットしました</p>
            <div class="border-t border-gray-200 divide-y divide-gray-200">
                @foreach ($users as $user)
                    <a href="{{ route('users.show', $user) }}" class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 transition">
                        <x-atoms.avatar :user="$user" size="md" />
                        <div class="flex-1 min-w-0">
                            <div class="text-sm font-medium text-gray-900 truncate hover:underline underline-offset-2">{{ $user->name }}</div>
                            <div class="flex items-center gap-2 min-w-0">
                                <div class="text-xs text-gray-400 truncate"><span>@</span>{{ $user->screen_name }}</div>
                                @if ($user->is_followed_by_viewer ?? false)
                                    <span class="flex-shrink-0 text-[11px] text-gray-500 bg-gray-100 px-1.5 py-0.5 rounded-sm">フォローされています</span>
                                @endif
                            </div>
                        </div>
                        <div class="hidden sm:grid grid-cols-3 gap-3 text-center text-xs text-gray-500 flex-shrink-0">
                            <div>
                                <div class="font-medium text-gray-900">{{ $user->status1_count }}</div>
                                <div>気になる</div>
                            </div>
                            <div>
                                <div class="font-medium text-gray-900">{{ $user->status2_count }}</div>
                                <div>練習中</div>
                            </div>
                            <div>
                                <div class="font-medium text-gray-900">{{ $user->status3_count }}</div>
                                <div>習得済み</div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <p class="text-sm text-gray-400 text-center py-8">ユーザーが見つかりませんでした。</p>
        @endif
    @endif
</x-ui.section>
