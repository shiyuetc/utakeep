@extends('layouts.app')
@section('page-title', $user->name . '（@' . $user->screen_name . '）さんの記録')
@section('content')
<livewire:features.user.profile :user="$user" />
<livewire:features.activity.timeline
    :user="$user"
    :key="'profile-timeline-'.$user->id"
/>
@endsection
