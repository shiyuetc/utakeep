<x-section title="パスワード変更" icon="ti-lock">
    <form wire:submit="updatePassword" class="p-4 space-y-4">
        @if ($submitted && $errors->any())
            <x-alert type="error">{{ $errors->first() }}</x-alert>
        @elseif ($saved)
            <x-alert type="success">変更を保存しました。</x-alert>
        @endif

        <div>
            <label class="block text-xs font-medium text-gray-600 mb-1">現在のパスワード</label>
            <input
                type="password"
                wire:model="current_password"
                autocomplete="current-password"
                class="w-full h-9 px-3 text-sm border border-gray-200 rounded-sm bg-white text-gray-900 outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition"
                required
            >
        </div>

        <div>
            <label class="block text-xs font-medium text-gray-600 mb-1">新しいパスワード</label>
            <input
                type="password"
                wire:model="password"
                autocomplete="new-password"
                class="w-full h-9 px-3 text-sm border border-gray-200 rounded-sm bg-white text-gray-900 outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition"
                required
            >
        </div>

        <div>
            <label class="block text-xs font-medium text-gray-600 mb-1">新しいパスワード確認</label>
            <input
                type="password"
                wire:model="password_confirmation"
                autocomplete="new-password"
                class="w-full h-9 px-3 text-sm border border-gray-200 rounded-sm bg-white text-gray-900 outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition"
                required
            >
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="h-9 px-4 bg-primary text-primary-light text-sm font-medium hover:bg-primary-hover rounded-sm transition cursor-pointer">
                変更
            </button>
        </div>
    </form>
</x-section>
