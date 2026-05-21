<div class="p-4">
    <div class="flex items-center gap-2.5 mb-2">
        <a href="{{ route('users.show', $activity->user) }}" class="flex items-center gap-2.5 min-w-0 flex-1 group">
            <x-atoms.avatar :user="$activity->user" size="xs" />
            <div class="min-w-0">
                <div class="text-xs font-medium text-gray-900 hover:underline underline-offset-2">{{ $activity->user->name }}</div>
                <div class="text-xs text-gray-400"><span>@</span>{{ $activity->user->screen_name }}</div>
            </div>
        </a>
        <div class="text-xs text-gray-400 flex-shrink-0">{{ $this->timeLabel($activity->created_at) }}</div>
    </div>
    <p class="text-sm text-gray-700 mb-2">
        ステータスを
        <x-atoms.state-badge :state="$activity->new_state" />
        に変更しました
    </p>
    <div class="bg-gray-50 border border-gray-200 rounded-sm">
        <livewire:components.song.item
            :song="$activity->song"
            :state="$state"
            :key="'activity-song-'.$activity->id.'-'.$activity->song_id.'-'.$state"
        />
    </div>
    <div class="mt-2 flex items-center">
        <button
            type="button"
            wire:click="toggleLike"
            wire:loading.attr="disabled"
            class="inline-flex items-center justify-center gap-1 rounded-sm text-xs font-medium transition disabled:cursor-not-allowed disabled:opacity-60 cursor-pointer {{ $isLiked ? 'text-rose-600' : 'text-gray-400 hover:text-rose-500' }}"
            aria-label="{{ $isLiked ? 'いいねを解除' : 'いいね' }}"
        >
            <i class="ti {{ $isLiked ? 'ti-heart-filled' : 'ti-heart' }} text-base" aria-hidden="true"></i>
            @if ($likesCount > 0)
                <span>{{ $likesCount }}</span>
            @endif
        </button>
    </div>
</div>
