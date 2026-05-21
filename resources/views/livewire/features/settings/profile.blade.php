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
            <label class="block text-xs font-medium text-gray-600 mb-1">自己紹介</label>
            <textarea
                wire:model="description"
                rows="4"
                maxlength="255"
                class="w-full px-3 py-2 text-sm border border-gray-200 rounded-sm bg-white text-gray-900 outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition resize-y"
            ></textarea>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="h-9 px-4 bg-primary text-primary-light text-sm font-medium hover:bg-primary-hover rounded-sm transition cursor-pointer">
                保存
            </button>
        </div>
    </form>
</x-ui.section>
