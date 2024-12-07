@extends('layouts.app')

@section('content')
    <h2>Meeting Room Calendar</h2>
    <ul>
        @foreach ($bookings as $booking)
            <li>
                <strong>{{ $booking->title }}</strong> organized by {{ $booking->employee->name }}
                <br>
                {{ $booking->start_time }} - {{ $booking->end_time }}
            </li>
        @endforeach
    </ul>
@endsection
