@extends('layouts.app')
@section('page-title', $user->name)
@section('content')
<livewire:user.profile :user="$user" />
@endsection
