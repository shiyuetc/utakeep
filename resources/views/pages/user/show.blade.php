@extends('layouts.app')
@section('page-title', $user->name)
@section('content')
<livewire:features.user.profile :user="$user" />
@endsection
