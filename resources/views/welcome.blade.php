@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>Welcome to the Meeting Room Booking System</h1>
        <p class="lead">Easily manage and book meeting rooms for your organization.</p>
        <a href="{{ route('calendar') }}" class="btn btn-primary">View Shared Calendar</a>
    </div>
@endsection
