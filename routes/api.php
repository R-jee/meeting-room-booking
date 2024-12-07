<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Booking;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/bookings', function () {
    // Retrieve all bookings with the organizer and participants' details
    $bookings = Booking::with(['employee', 'employees'])->get();

    return $bookings->map(function ($booking) {
        // Calculate the event duration in minutes
        $startTime = \Carbon\Carbon::parse($booking->start_time);
        $endTime = \Carbon\Carbon::parse($booking->end_time);

        // Duration in hours and minutes
        $durationInMinutes = $startTime->diffInMinutes($endTime);
        $durationHours = floor($durationInMinutes / 60); // Hours
        $durationMinutes = $durationInMinutes % 60; // Minutes

        // Combine the duration in a readable format
        $duration = sprintf('%02d hours & %02d minutes', $durationHours, $durationMinutes);

        // Create badges for participants, with the email on hover
        $participantsBadges = $booking->employees->pluck('name', 'email')->map(function ($name, $email) {
            return '<span class="badge text-bg-dark" title="' . e($email) . '">' . e($name) . '</span>';
        });

        return [
            'title' => $booking->title ?? 'N/A',
            'start' => $startTime->toIso8601String(), // Format the start time in ISO 8601
            'end' => $endTime->toIso8601String(), // Format the end time in ISO 8601
            'description' => $booking->description ?? "", // Include the event description
            'organizer' => $booking->employee->name . ' (' . $booking->employee->email . ') ', // The name of the organizer (employee)
            'participants' => $participantsBadges->implode(' '), // List of participant badges
            'totalDuration' => $duration, // Combined duration (e.g. '04 hours & 22 minutes')
        ];
    });
});

