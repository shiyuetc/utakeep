<x-section title="{{ $this->title() }}" icon="ti-users">
    @if ($users->isNotEmpty())
        <div class="divide-y divide-gray-200">
            @foreach ($users as $user)
                <a href="{{ route('users.show', $user) }}" class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 transition">
                    <div class="w-11 h-11 rounded-full bg-primary-light text-primary flex items-center justify-center text-sm font-medium flex-shrink-0">
                        {{ strtoupper(substr($user->screen_name, 0, 2)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="text-sm font-medium text-gray-900 truncate">{{ $user->name }}</div>
                        <div class="text-xs text-gray-400 truncate"><span>@</span>{{ $user->screen_name }}</div>
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
        <p class="text-sm text-gray-400 text-center py-8">{{ $this->emptyMessage() }}</p>
    @endif
</x-section>
