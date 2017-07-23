@extends('layouts.staff')

@section('content')
    <div id="users-app">
        <group-list initial-groups='{!! $groups !!}'></group-list>
    </div>
@endsection