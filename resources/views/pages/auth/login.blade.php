@extends('layouts.app')
@section('content')
<div>
    <h1>ログイン画面</h1>
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li style="color:red">{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <form method="POST" action="/login">
        @csrf
        <div>
            <label>ユーザーID</label>
            <input type="text" name="screen_name" value="{{ old('screen_name') }}" required>
        </div>
        <div>
            <label>パスワード</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit">ログイン</button>
    </form>
    <a href="/register">新規登録</a>
</div>
@endsection
