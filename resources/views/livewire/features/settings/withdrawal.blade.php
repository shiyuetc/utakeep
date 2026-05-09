<div class="bg-white border border-red-200 rounded-sm overflow-hidden">
    <div class="px-4 py-2.5 border-b border-red-200">
        <h2 class="flex items-center gap-2 text-sm text-red-700">
            <i class="ti ti-user-x text-base" aria-hidden="true"></i>
            <span>アカウント削除</span>
        </h2>
    </div>

    <form wire:submit="deleteAccount" class="p-4 space-y-4">
        @if ($submitted)
            @error('deletePassword')
                <x-alert type="error">{{ $message }}</x-alert>
            @enderror
        @endif

        <p class="text-xs text-gray-500">削除すると、プロフィール、登録ステータス、記録がすべて削除されます。この操作は取り消せません。</p>

        <div>
            <label class="block text-xs font-medium text-gray-600 mb-1">パスワード</label>
            <input
                type="password"
                wire:model="deletePassword"
                autocomplete="current-password"
                class="w-full h-9 px-3 text-sm border border-gray-200 rounded-sm bg-white text-gray-900 outline-none focus:border-red-400 focus:ring-2 focus:ring-red-100 transition"
                required
            >
        </div>

        <button type="submit" class="h-9 px-4 bg-red-600 text-white text-sm font-medium hover:bg-red-700 rounded-sm transition cursor-pointer">
            アカウントを削除
        </button>
    </form>

    @script
        <script>
            $wire.on('confirm-account-deletion', () => {
                if (confirm('本当にアカウントを削除しますか？')) {
                    $wire.deleteConfirmed();
                }
            });
        </script>
    @endscript
</div>
