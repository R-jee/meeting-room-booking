@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Booking Details</h2>

        <div class="mb-3">
            <strong>Title:</strong> {{ $booking->title }}
        </div>

        <div class="mb-3">
            <strong>Organizer:</strong> {{ $booking->employee->name }}
        </div>

        <div class="mb-3">
            <strong>Participants:</strong>
            @foreach ($booking->employees as $employee)
                <span class="badge bg-primary">{{ $employee->name }}</span>
            @endforeach
        </div>

        <div class="mb-3">
            <strong>Start Time:</strong> {{ \Carbon\Carbon::parse($booking->start_time)->format('d M Y, H:i') }}
        </div>

        <div class="mb-3">
            <strong>End Time:</strong> {{ \Carbon\Carbon::parse($booking->end_time)->format('d M Y, H:i') }}
        </div>

        <a href="{{ route('bookings.index') }}" class="btn btn-secondary">Back to Bookings</a>
    </div>
@endsection
