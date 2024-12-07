@extends('layouts.app')

@section('content')
    <div>
        <h2>Edit Employee</h2>
        <form action="{{ route('employees.update', $employee->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" value="{{ old('name', $employee->name) }}" required>
                @error('name')
                <div>{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="{{ old('email', $employee->email) }}" required>
                @error('email')
                <div>{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="department">Department:</label>
                <input type="text" name="department" id="department" value="{{ old('department', $employee->department) }}" required>
                @error('department')
                <div>{{ $message }}</div>
                @enderror
            </div>
            <button type="submit">Update Employee</button>
        </form>
    </div>
@endsection
