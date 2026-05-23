@extends('layouts.guest')
@section('page-title', 'パスワード再発行')
@section('content')
<div class="flex justify-center py-8">
    <div class="w-full max-w-md bg-white border border-gray-200 rounded-sm p-8">
        <div class="text-center text-xl font-medium mb-6">
            Uta<span class="text-primary">keep</span>
        </div>
        <h1 class="text-base font-medium text-gray-900 text-center mb-6">- パスワード再発行 -</h1>

        <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
            @csrf

            @if (session('status'))
                <x-ui.alert type="success">{{ session('status') }}</x-ui.alert>
            @endif

            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">メールアドレス</label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="sample@example.com"
                    autocomplete="email"
                    class="w-full h-9 px-3 text-sm border border-gray-200 rounded-sm bg-white text-gray-900 outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition"
                    required
                    autofocus>
                @error('email')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full h-9 mt-2 bg-primary text-primary-light text-sm font-medium hover:bg-primary-hover rounded-sm transition cursor-pointer">再発行メールを送信</button>
        </form>

        <div class="mt-5 text-center text-sm">
            <a href="{{ route('login') }}" class="text-primary hover:underline">ログインに戻る</a>
        </div>
    </div>
</div>
@endsection
