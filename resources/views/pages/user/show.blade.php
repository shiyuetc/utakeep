@extends('layouts.app')
@section('page-title', $user->name . '（@' . $user->screen_name . '）さん')
@section('content')
<livewire:features.user.profile :user="$user" />
@endsection
