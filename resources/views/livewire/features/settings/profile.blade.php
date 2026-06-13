<x-ui.section title="プロフィール" icon="ti-settings">
    <form wire:submit="updateProfile" class="p-4 space-y-4">
        @if ($submitted && $errors->any())
            <x-ui.alert type="error">{{ $errors->first() }}</x-ui.alert>
        @elseif ($saved)
            <x-ui.alert type="success">変更を保存しました。</x-ui.alert>
        @endif

        <div>
            <label class="block text-xs font-medium text-gray-600 mb-1">※ユーザーIDは変更できません。</label>
            <input
                type="text"
                value="{{ $screenName }}"
                class="w-full h-9 px-3 text-sm border border-gray-200 rounded-sm bg-gray-50 text-gray-400 outline-none"
                disabled
            >
        </div>

        <div>
            <label class="block text-xs font-medium text-gray-600 mb-1">ユーザー名</label>
            <input
                type="text"
                wire:model="name"
                class="w-full h-9 px-3 text-sm border border-gray-200 rounded-sm bg-white text-gray-900 outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition"
                required
                maxlength="20"
            >
        </div>

        <div>
            <label class="block text-xs font-medium text-gray-600 mb-1">一言コメント</label>
            <input
                type="text"
                wire:model="description"
                maxlength="255"
                class="w-full h-9 px-3 text-sm border border-gray-200 rounded-sm bg-white text-gray-900 outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition"
            >
        </div>

        <label class="flex items-start gap-3 rounded-sm border border-gray-200 bg-white p-3 cursor-pointer">
            <input
                type="checkbox"
                wire:model="isPrivate"
                class="mt-0.5 h-4 w-4 rounded-sm border-gray-300 text-primary focus:ring-primary"
            >
            <span class="min-w-0">
                <span class="block text-sm font-medium text-gray-900">非公開設定にする</span>
                <span class="block text-xs text-gray-500 mt-0.5">他ユーザーに記録と登録している曲を表示しません。</span>
            </span>
        </label>

        <div>
            <label class="block text-xs font-medium text-gray-600 mb-1">言語</label>
            <select
                wire:model="locale"
                class="w-full h-9 px-3 text-sm border border-gray-200 rounded-sm bg-white text-gray-900 outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition"
            >
                <option value="ja">日本語</option>
                <option value="en">English</option>
            </select>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="h-9 px-4 bg-primary text-primary-light text-sm font-medium hover:bg-primary-hover rounded-sm transition cursor-pointer">
                保存
            </button>
        </div>
    </form>
</x-ui.section>
