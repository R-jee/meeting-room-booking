@extends('layouts.app')

@section('content')
    <h2>Add New Employee</h2>
    <form action="{{ route('employees.store') }}" method="POST" class="mt-3">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="department" class="form-label">Department</label>
            <input type="text" id="department" name="department" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Employee</button>
    </form>
@endsection
