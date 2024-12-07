@extends('layouts.app')

@section('content')
    <div>
        <h2>Book Meeting Room</h2>
        <form action="{{ route('bookings.store') }}" method="POST">
            @csrf
            <div>
                <label for="title">Meeting Title:</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required>
                @error('title')
                <div>{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="employee_id">Organizer:</label>
                <select name="employee_id" id="employee_id" required>
                    <option value="">Select Organizer</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
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
                <input type="datetime-local" name="start_time" id="start_time" value="{{ old('start_time') }}" required>
                @error('start_time')
                <div>{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="end_time">End Time:</label>
                <input type="datetime-local" name="end_time" id="end_time" value="{{ old('end_time') }}" required>
                @error('end_time')
                <div>{{ $message }}</div>
                @enderror
            </div>
            <button type="submit">Book</button>
        </form>
    </div>
@endsection
