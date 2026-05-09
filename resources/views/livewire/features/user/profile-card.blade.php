<a href="{{ route('users.show', $user) }}" class="bg-white border border-gray-200 rounded-sm p-4 block hover:bg-gray-50 transition">
    <div class="flex items-center gap-3">
        <div class="w-12 h-12 rounded-full bg-purple-100 text-primary flex items-center justify-center text-lg font-medium flex-shrink-0">
            {{ strtoupper(substr($user->screen_name, 0, 2)) }}
        </div>
        <div class="min-w-0">
            <div class="text-sm font-medium text-gray-900 truncate">{{ $user->name }}</div>
            <div class="text-xs text-gray-400 mt-0.5"><span>@</span>{{ $user->screen_name }}</div>
        </div>
    </div>
</a>