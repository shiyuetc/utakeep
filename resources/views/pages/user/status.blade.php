@extends('layouts.app')
@section('page-title', $user->name . '（@' . $user->screen_name . '）さん')
@section('content')
<livewire:features.user.profile :user="$user" />
<livewire:features.user.profile-songs
    :user="$user"
    :state="$status"
    :key="'profile-songs-'.$user->id.'-'.$status"
/>
@endsection
