@extends('layouts.app')
@section('page-title', $user->name . '（@' . $user->screen_name . '）さん')
@section('content')
<livewire:features.user.profile :user="$user" />
<livewire:features.user.follow-list
    :user="$user"
    :type="'followers'"
    :key="'follow-list-'.$user->id.'-followers'"
/>
@endsection
