@extends('layouts.staff')

@section('content')
    <div id="users-app">

        <teacher-show id="{{ $teacher->id }}"></teacher-show>
    </div>
@endsection