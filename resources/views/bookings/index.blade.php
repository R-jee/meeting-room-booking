@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Bookings</h2>

        <!-- Display success message if booking was updated or created successfully -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('bookings.create') }}" class="btn btn-success">Add New Booking</a>
        </div>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Title</th>
                <th>Organizer</th>
                <th>Participants</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($bookings as $booking)
                <tr>
                    <td>{{ $booking->title }}</td>
                    <td>{{ $booking->employee->name }}</td>
                    <td>
                        @foreach ($booking->employees as $employee)
                            <span class="badge bg-primary">{{ $employee->name }}</span>
                        @endforeach
                    </td>
                    <td>{{ \Carbon\Carbon::parse($booking->start_time)->format('d M Y, H:i') }}</td>
                    <td>{{ \Carbon\Carbon::parse($booking->end_time)->format('d M Y, H:i') }}</td>
                    <td>
{{--                        <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-info btn-sm">View</a>--}}
                        <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <!-- Pagination links (if applicable) -->
        {{ $bookings->links('pagination::bootstrap-5') }}
    </div>
@endsection
