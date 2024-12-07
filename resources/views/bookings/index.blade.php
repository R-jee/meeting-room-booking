@extends('layouts.app')

@section('content')
    <div>
        <h2>Meeting Room Bookings</h2>
        <a href="{{ route('bookings.create') }}">Book Meeting Room</a>
        <table>
            <thead>
            <tr>
                <th>Title</th>
                <th>Organizer</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($bookings as $booking)
                <tr>
                    <td>{{ $booking->title }}</td>
                    <td>{{ $booking->employee->name }}</td>
                    <td>{{ $booking->start_time }}</td>
                    <td>{{ $booking->end_time }}</td>
                    <td>
                        <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit">Cancel</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
