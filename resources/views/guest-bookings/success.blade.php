@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Booking Successful</h2>
        <p>Your booking has been successfully created.</p>
        <a href="{{ route('calendar') }}" class="btn btn-primary">View Booking</a>
        <a href="{{ route('guest-bookings.create') }}" class="btn btn-primary">Create Another Booking</a>
    </div>
@endsection
