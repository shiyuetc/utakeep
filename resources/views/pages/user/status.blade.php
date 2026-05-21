@extends('layouts.app')
@section('page-title', $user->name . '（@' . $user->screen_name . '）さんの' . match ($status) {
    1 => '気になる曲',
    2 => '練習中の曲',
    3 => '習得済みの曲',
    default => '',
})
@section('content')
<livewire:features.user.profile :user="$user" />
<livewire:features.user.profile-songs
    :user="$user"
    :state="$status"
    :key="'profile-songs-'.$user->id.'-'.$status"
/>
@endsection
