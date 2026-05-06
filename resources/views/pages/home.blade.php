@extends('layouts.app')
@section('content')
<div>
    <h1>ホーム画面</h1>
    <p>ようこそ、{{ auth()->user()->name }} さん！</p>
    <form method="POST" action="/logout">
        @csrf
        <button type="submit">ログアウト</button>
    </form>
</div>
@endsection
