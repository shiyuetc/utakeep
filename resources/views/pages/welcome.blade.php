@extends('layouts.app')
@section('header-nav')
<div class="flex gap-2">
    <a href="/login" class="px-4 py-1.5 text-sm text-gray-700 hover:bg-gray-50 transition">ログイン</a>
    <a href="/register" class="px-4 py-1.5 text-sm bg-primary text-primary-light hover:bg-primary-hover transition">新規登録</a>
</div>
@endsection
@section('content')
<section class="bg-white pt-20 pb-16 text-center px-6">
    <span class="inline-block mb-5 text-xs font-medium tracking-wide text-primary bg-primary-light px-3 py-1 rounded-md">
        カラオケ持ち歌管理アプリ
    </span>
    <h1 class="text-4xl font-medium text-gray-900 leading-snug mb-4">
        あなたの持ち歌を<br>
        <em class="not-italic text-primary">記録して、共有しましょう</em>
    </h1>
    <p class="text-base text-gray-500 leading-relaxed max-w-md mx-auto mb-8">
        気になる曲や練習中の曲、歌えるようになった曲も。<br>Utakeepで持ち歌を管理して、フォロワーと共有しましょう。
    </p>
    <div class="flex gap-3 justify-center">
        <a href="{{ route('register') }}" class="px-6 py-2.5 text-sm bg-primary text-primary-light hover:bg-primary-hover transition font-medium">無料で始める</a>
        <a href="{{ route('login') }}" class="px-6 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition">ログイン</a>
    </div>
</section>
@endsection
