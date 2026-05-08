@extends('layouts.guest')
@section('content')
<div class="flex justify-center py-8">
    <div class="w-full max-w-md bg-white border border-gray-200 rounded-sm p-8">
        <div class="text-center text-xl font-medium mb-6">
            Uta<span class="text-primary">keep</span>
        </div>
        <h1 class="text-base font-medium text-gray-900 text-center mb-6">- ログイン -</h1>
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">ユーザーID</label>
                <input
                    type="text"
                    name="screen_name"
                    value="{{ old('screen_name') }}"
                    class="w-full h-9 px-3 text-sm border border-gray-200 rounded-sm bg-white text-gray-900 outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition"
                    required
                    maxlength="15">
                @error('screen_name')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">パスワード</label>
                <input
                    type="password"
                    name="password"
                    class="w-full h-9 px-3 text-sm border border-gray-200 rounded-sm bg-white text-gray-900 outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition"
                    required>
                @error('password')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="w-full h-9 mt-2 bg-primary text-primary-light text-sm font-medium hover:bg-primary-hover rounded-sm transition cursor-pointer">ログイン</button>
        </form>
        <div class="mt-5 text-center text-sm text-gray-600">
            または
        </div>
        <div class="mt-3 text-center text-sm">
            アカウントをお持ちでない方は <a href="{{ route('register') }}" class="text-primary hover:underline">新規登録</a>
        </div>
    </div>
</div>
@endsection
