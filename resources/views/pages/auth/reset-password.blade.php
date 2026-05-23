@extends('layouts.guest')
@section('page-title', 'パスワード再設定')
@section('content')
<div class="flex justify-center py-8">
    <div class="w-full max-w-md bg-white border border-gray-200 rounded-sm p-8">
        <div class="text-center text-xl font-medium mb-6">
            Uta<span class="text-primary">keep</span>
        </div>
        <h1 class="text-base font-medium text-gray-900 text-center mb-6">- パスワード再設定 -</h1>

        <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <input type="hidden" name="email" value="{{ old('email', $request->email) }}">

            @error('email')
                <x-ui.alert type="error">{{ $message }}</x-ui.alert>
            @enderror

            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">新しいパスワード</label>
                <input
                    type="password"
                    name="password"
                    autocomplete="new-password"
                    class="w-full h-9 px-3 text-sm border border-gray-200 rounded-sm bg-white text-gray-900 outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition"
                    required
                    minlength="8"
                    autofocus>
                @error('password')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">新しいパスワード確認</label>
                <input
                    type="password"
                    name="password_confirmation"
                    autocomplete="new-password"
                    class="w-full h-9 px-3 text-sm border border-gray-200 rounded-sm bg-white text-gray-900 outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition"
                    required
                    minlength="8">
                @error('password_confirmation')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full h-9 mt-2 bg-primary text-primary-light text-sm font-medium hover:bg-primary-hover rounded-sm transition cursor-pointer">パスワードを再設定</button>
        </form>

        <div class="mt-5 text-center text-sm">
            <a href="{{ route('login') }}" class="text-primary hover:underline">ログインに戻る</a>
        </div>
    </div>
</div>
@endsection
