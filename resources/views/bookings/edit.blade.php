@extends('layouts.app')

@section('content')
    <div>
        <h2>Edit Booking</h2>
        <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label for="title">Meeting Title:</label>
                <input type="text" name="title" id="title" value="{{ old('title', $booking->title) }}" required>
                @error('title')
                <div>{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="employee_id">Organizer:</label>
                <select name="employee_id" id="employee_id" required>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}" {{ old('employee_id', $booking->employee_id) == $employee->id ? 'selected' : '' }}>
                            {{ $employee->name }}
                        </option>
                    @endforeach
                </select>
                @error('employee_id')
                <div>{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="start_time">Start Time:</label>
                <input type="datetime-local" name="start_time" id="start_time" value="{{ old('start_time', $booking->start_time) }}" required>
                @error('start_time')
                <div>{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="end_time">End Time:</label>
                <input type="datetime-local" name="end_time" id="end_time" value="{{ old('end_time', $booking->end_time) }}" required>
                @error('end_time')
                <div>{{ $message }}</div>
                @enderror
            </div>
            <button type="submit">Update Booking</button>
        </form>
    </div>
@endsection
