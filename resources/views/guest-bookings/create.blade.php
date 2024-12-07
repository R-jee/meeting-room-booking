@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Guest Booking</h2>
        <form action="{{ route('guest-bookings.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Booking Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Your Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Your Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
            </div>

            <div class="mb-3">
                <label for="start_time" class="form-label">Start Time</label>
                <input type="datetime-local" name="start_time" id="start_time" class="form-control" value="{{ old('start_time') }}" required>
            </div>
            <div class="mb-3">
                <label for="end_time" class="form-label">End Time</label>
                <input type="datetime-local" name="end_time" id="end_time" class="form-control" value="{{ old('end_time') }}" required>
            </div>
            <div class="mb-3">
                <label for="participants" class="form-label">Participants</label>
                <select name="participants[]" id="participants" class="form-control" multiple>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->name }} ({{ $employee->email }})</option>
                    @endforeach
                </select>
                <small class="text-muted">Hold down the Ctrl (Windows) or Command (Mac) button to select multiple participants.</small>
            </div>
            <button type="submit" class="btn btn-primary">Submit Booking</button>
        </form>
    </div>
@endsection
