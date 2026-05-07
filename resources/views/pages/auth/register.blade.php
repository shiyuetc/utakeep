@extends('layouts.guest')
@section('content')
<div class="flex justify-center py-8">
    <div class="w-full max-w-md bg-white border border-gray-200 rounded-lg shadow-md p-8">
        <div class="text-center text-xl font-medium mb-6">
            Uta<span class="text-primary">keep</span>
        </div>
        <h1 class="text-base font-medium text-gray-900 text-center mb-6">- 新規登録 -</h1>
        <form method="POST" action="/register" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">ユーザーID</label>
                <input
                    type="text"
                    name="screen_name"
                    placeholder="英数字・アンダースコアのみ、15文字以内"
                    value="{{ old('screen_name') }}"
                    class="w-full h-9 px-3 text-sm border border-gray-200 rounded-md bg-white text-gray-900 outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition"
                    required
                    maxlength="15">
                @error('screen_name')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">ユーザー名</label>
                <input
                    type="text"
                    name="name"
                    placeholder="20文字以内"
                    value="{{ old('name') }}"
                    class="w-full h-9 px-3 text-sm border border-gray-200 rounded-md bg-white text-gray-900 outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition"
                    required
                    maxlength="20">
                @error('name')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">メールアドレス</label>
                <input
                    type="email"
                    name="email"
                    placeholder="sample@example.com"
                    value="{{ old('email') }}"
                    class="w-full h-9 px-3 text-sm border border-gray-200 rounded-md bg-white text-gray-900 outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition"
                    required>
                @error('email')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">パスワード</label>
                <input
                    type="password"
                    name="password"
                    placeholder="8文字以上"
                    class="w-full h-9 px-3 text-sm border border-gray-200 rounded-md bg-white text-gray-900 outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition"
                    required
                    minlength="8">
                @error('password')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">パスワード（確認）</label>
                <input
                    type="password"
                    name="password_confirmation"
                    class="w-full h-9 px-3 text-sm border border-gray-200 rounded-md bg-white text-gray-900 outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition"
                    required
                    minlength="8">
                @error('password_confirmation')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="w-full h-9 mt-2 bg-primary text-primary-light text-sm font-medium hover:bg-primary-hover rounded-md transition cursor-pointer">新規登録</button>
        </form>
        <div class="mt-5 text-center text-sm text-gray-600">
            または
        </div>
        <div class="mt-3 text-center text-sm">
            すでにアカウントをお持ちの方は <a href="/login" class="text-primary hover:underline">ログイン</a>
        </div>
    </div>
</div>
@endsection
