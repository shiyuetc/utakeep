<div class="flex flex-col gap-2">
    <div class="bg-white border border-gray-200 rounded-sm overflow-hidden">
        <div class="p-4">
            <div class="flex items-center gap-3">
                <div class="w-14 h-14 rounded-full bg-primary-light text-primary flex items-center justify-center text-lg font-medium flex-shrink-0">
                    {{ strtoupper(substr($user->screen_name, 0, 2)) }}
                </div>
                <div class="min-w-0">
                    <h1 class="text-base font-medium text-gray-900 truncate">{{ $user->name }}</h1>
                    <div class="text-sm text-gray-400 truncate"><span>@</span>{{ $user->screen_name }}</div>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-4 border-t border-gray-200 divide-x divide-gray-200">
            @foreach ([0, 1, 2, 3] as $state)
                <button
                    type="button"
                    wire:click="setActiveState({{ $state }})"
                    class="px-3 py-2 text-center transition cursor-pointer {{ $activeState === $state ? 'bg-primary-light text-primary' : 'text-gray-500 hover:bg-gray-50' }}"
                >
                    <div class="text-xs">{{ $this->stateLabel($state) }}</div>
                    <div class="text-sm font-medium mt-0.5">{{ $counts[$state] ?? 0 }}</div>
                </button>
            @endforeach
        </div>
    </div>
    
    <x-section title="{{ $this->stateLabel($activeState) }}">
        @if ($activeState === 0 && $activities->isNotEmpty())
            <div class="divide-y divide-gray-200">
                @foreach ($activities as $activity)
                    <livewire:activity.item
                        :activity="$activity"
                        :state="$viewerStatuses[$activity->song_id] ?? 0"
                        :key="'user-activity-'.$user->id.'-'.$activity->id.'-'.$activity->song_id.'-'.($viewerStatuses[$activity->song_id] ?? 0)"
                    />
                @endforeach
            </div>
        @elseif ($activeState > 0 && $statuses->isNotEmpty())
            <div class="divide-y divide-gray-200">
                @foreach ($statuses as $status)
                    <livewire:song.item
                        :song="$status->song"
                        :state="$viewerStatuses[$status->song_id] ?? 0"
                        :key="'user-'.$user->id.'-'.$activeState.'-'.$status->song_id.'-'.($viewerStatuses[$status->song_id] ?? 0)"
                    />
                @endforeach
            </div>
        @else
            <div class="p-8 text-center">
                <p class="text-sm text-gray-600">まだ{{ $activeState === 0 ? '記録' : $this->stateLabel($activeState).'曲' }}はありません。</p>
            </div>
        @endif
    </x-section>
</div>
