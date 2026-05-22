<x-ui.section title="メールアドレス変更" icon="ti-mail">
    <form wire:submit="updateEmail" class="p-4 space-y-4">
        @if ($submitted && $errors->any())
            <x-ui.alert type="error">{{ $errors->first() }}</x-ui.alert>
        @elseif ($saved)
            <x-ui.alert type="success">メールアドレスを変更しました。新しいメールアドレスに送信されたメールから認証を完了してください。</x-ui.alert>
        @endif

        <div>
            <label class="block text-xs font-medium text-gray-600 mb-1">現在のメールアドレス</label>
            <input
                type="email"
                value="{{ $currentEmail }}"
                class="w-full h-9 px-3 text-sm border border-gray-200 rounded-sm bg-gray-50 text-gray-400 outline-none"
                disabled
            >
        </div>

        <div>
            <label class="block text-xs font-medium text-gray-600 mb-1">新しいメールアドレス</label>
            <input
                type="email"
                wire:model="email"
                autocomplete="email"
                class="w-full h-9 px-3 text-sm border border-gray-200 rounded-sm bg-white text-gray-900 outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition"
                required
            >
        </div>

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

        <div class="flex items-center gap-3">
            <button type="submit" class="h-9 px-4 bg-primary text-primary-light text-sm font-medium hover:bg-primary-hover rounded-sm transition cursor-pointer">
                変更
            </button>
        </div>
    </form>
</x-ui.section>
