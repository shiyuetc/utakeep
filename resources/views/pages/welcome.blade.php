@extends('layouts.app')
@section('header-nav')
<div class="flex gap-2">
    <a href="{{ route('login') }}" class="px-4 py-1.5 text-sm text-gray-700 hover:bg-gray-50 transition">ログイン</a>
    <a href="{{ route('register') }}" class="px-4 py-1.5 text-sm bg-primary text-primary-light hover:bg-primary-hover transition">新規登録</a>
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
<section class="bg-gray-50 border-t border-gray-100 py-14 px-6">
    <p class="text-center text-sm font-medium text-gray-500 mb-8">主な機能</p>
    <div class="max-w-4xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach ([
            ['icon' => '♪', 'title' => '持ち歌を管理', 'desc' => '練習中・習得済みなどステータスで曲を整理できます。'],
            ['icon' => '🔍', 'title' => '曲を検索', 'desc' => 'iTunes連携で膨大な楽曲データベースから曲を探せます。'],
            ['icon' => '👥', 'title' => 'フォローして共有', 'desc' => '友達をフォローしてタイムラインで持ち歌を共有しよう。'],
            ['icon' => '♡', 'title' => 'いいねで応援', 'desc' => '新曲を習得したフォロワーにいいねして盛り上げよう。'],
        ] as $feature)
        <div class="bg-white border border-gray-100 rounded-xl p-5">
            <div class="text-2xl mb-3">{{ $feature['icon'] }}</div>
            <h3 class="text-sm font-medium text-gray-900 mb-1.5">{{ $feature['title'] }}</h3>
            <p class="text-xs text-gray-500 leading-relaxed">{{ $feature['desc'] }}</p>
        </div>
        @endforeach
    </div>
</section>
@endsection
