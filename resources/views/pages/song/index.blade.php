@extends('layouts.app')
@section('content')
<div class="bg-white border border-gray-200 rounded-lg shadow-sm p-4">
    <h2 class="text-sm font-medium text-gray-900 mb-4">曲を検索</h2>
    <livewire:song.search-form />
</div>
@endsection
