@extends('layouts.app')
@section('content')
<div class="bg-white border border-gray-200 rounded-sm overflow-hidden">
    <div class="px-4 py-2 border-b border-gray-200">
        <h2 class="text-sm text-gray-900">曲検索</h2>
    </div>
    <livewire:song.search-form />
</div>
@endsection
