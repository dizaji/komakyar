@extends('layouts.staff')

@section('content')
    <div id="users-app">
        <group-show id="{{ $group->id }}"></group-show>
    </div>
@endsection