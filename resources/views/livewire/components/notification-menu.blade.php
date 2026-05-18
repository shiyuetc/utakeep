<div class="relative group">
    <button
        type="button"
        class="relative flex h-9 w-9 items-center justify-center rounded-full text-gray-500 transition hover:bg-gray-50 hover:text-gray-900 focus:bg-gray-50 outline-none focus-visible:ring-2 focus-visible:ring-primary/20 cursor-pointer"
        aria-label="通知"
    >
        <i class="ti ti-bell text-xl" aria-hidden="true"></i>
        @if ($unreadCount > 0)
            <span class="absolute right-0.5 top-0.5 min-w-4 h-4 rounded-full bg-rose-500 px-1 text-[10px] leading-4 text-white text-center font-medium">
                {{ $unreadCount > 9 ? '9+' : $unreadCount }}
            </span>
        @endif
    </button>

    <div class="hidden group-focus-within:block absolute -right-10 mt-2 w-80 max-w-[calc(100vw-2rem)] bg-white border border-gray-200 rounded-sm shadow-sm overflow-hidden">
        <div class="flex items-center justify-between px-4 py-3 border-b border-gray-200">
            <div class="text-sm font-medium text-gray-900">通知</div>
            @if ($unreadCount > 0)
                <button
                    type="button"
                    wire:click="markAllAsRead"
                    class="text-xs text-gray-500 hover:text-primary transition cursor-pointer"
                >
                    すべて既読
                </button>
            @endif
        </div>

        @if ($notifications->isNotEmpty())
            <div class="max-h-96 overflow-y-auto divide-y divide-gray-200">
                @foreach ($notifications as $notification)
                    <a
                        href="{{ $this->notificationUrl($notification) }}"
                        wire:click.prevent="openNotification({{ $notification->id }})"
                        class="flex gap-3 pl-4 pr-2 py-3 transition hover:bg-gray-50 {{ $notification->read_at ? 'bg-white' : 'bg-primary-light/40' }}"
                    >
                        <x-user-avatar :user="$notification->actor" size="xs" />
                        <div class="min-w-0 flex-1">
                            <div class="flex items-start gap-2">
                                <p class="min-w-0 flex-1 text-sm text-gray-900 leading-snug">{{ $this->message($notification) }}</p>
                                <p class="flex-shrink-0 text-xs text-gray-400">{{ $this->timeLabel($notification) }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="px-4 py-8 text-center text-sm text-gray-400">
                通知はありません。
            </div>
        @endif
    </div>
</div>
