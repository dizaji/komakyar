@extends('layouts.staff')

@section('content')
    <div id="users-app">
        <student-show id="{{ $student->id }}"></student-show>
    </div>
@endsection