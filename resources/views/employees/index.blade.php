@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h2>Employees</h2>
        <a href="{{ route('employees.create') }}" class="btn btn-success">Add Employee</a>
    </div>
    <table class="table mt-3">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Department</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($employees as $employee)
            <tr>
                <td>{{ $employee->name }}</td>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->department }}</td>
                <td>
                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <!-- Custom Black and White Pagination -->
    <div class="d-flex justify-content-center mt-4">
        <nav>
            {{ $employees->links('vendor.pagination.custom-pagination') }}
        </nav>
    </div>
@endsection
