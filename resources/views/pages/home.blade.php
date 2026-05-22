@extends('layouts.app')
@section('page-title', 'ホーム')
@section('content')
@if (! auth()->user()->hasVerifiedEmail())
    <x-ui.alert type="default">メールアドレスが未認証です。登録時に送信されたメールから認証を完了してください。</x-ui.alert>
@endif
<livewire:features.activity.timeline />
@endsection
