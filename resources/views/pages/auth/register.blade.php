@extends('layouts.app')
@section('content')
<div>
    <h1>新規登録画面</h1>
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li style="color:red">{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <form method="POST" action="/register">
        @csrf
        <div>
            <label>ユーザーID</label>
            <input type="text" name="screen_name" value="{{ old('screen_name') }}" required>
        </div>
        <div>
            <label>ユーザー名</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
        </div>
        <div>
            <label>メールアドレス</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div>
            <label>パスワード</label>
            <input type="password" name="password" required>
        </div>
        <div>
            <label>パスワード（確認）</label>
            <input type="password" name="password_confirmation" required>
        </div>
        <button type="submit">登録</button>
    </form>
    <a href="/login">ログインはこちら</a>
</div>
@endsection
