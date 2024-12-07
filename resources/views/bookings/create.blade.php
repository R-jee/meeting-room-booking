@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create Booking</h2>

        <!-- Display conflict error message if any -->
        @if ($errors->has('conflict'))
            <div class="alert alert-danger">
                {{ $errors->first('conflict') }}
            </div>
        @endif

        <form action="{{ route('bookings.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Meeting Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}">
                @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="employee_id" class="form-label">Organizer</label>
                <select class="form-select @error('employee_id') is-invalid @enderror" id="employee_id" name="employee_id">
                    <option value="">Select an Employee</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
                    @endforeach
                </select>
                @error('employee_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="participants" class="form-label">Participants</label>
                <select class="form-select @error('participants') is-invalid @enderror" id="participants" name="participants[]" multiple>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}" {{ in_array($employee->id, old('participants', [])) ? 'selected' : '' }}>{{ $employee->name }}</option>
                    @endforeach
                </select>
                @error('participants')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="start_time" class="form-label">Start Time</label>
                <input type="datetime-local" class="form-control @error('start_time') is-invalid @enderror" id="start_time" name="start_time" value="{{ old('start_time') }}">
                @error('start_time')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="end_time" class="form-label">End Time</label>
                <input type="datetime-local" class="form-control @error('end_time') is-invalid @enderror" id="end_time" name="end_time" value="{{ old('end_time') }}">
                @error('end_time')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Create Booking</button>
        </form>
    </div>
@endsection
