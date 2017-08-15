@extends('layouts.staff')

@section('content')
    <div id="users-app">
        <student-edit id="{{ $student->id }}"></student-edit>
    </div>
@endsection