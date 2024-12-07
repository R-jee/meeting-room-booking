<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Employee;
use Illuminate\Http\Request;

class GuestBookingController extends Controller
{
    public function create()
    {
        // Fetch all employees for participant selection
        $employees = Employee::all();
        return view('guest-bookings.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'title' => 'required|string|max:255',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'participants' => 'nullable|array',
            'participants.*' => 'exists:employees,id',
        ]);

        // Create a new employee for the guest
        $employee = Employee::create([
            'name' => $request->name,
            'email' => $request->email,
            'department' => $request->department ?? 'None',
        ]);

        // Check for conflicting bookings
        $conflict = Booking::where('start_time', '<', $request->end_time)
            ->where('end_time', '>', $request->start_time)
            ->exists();

        if ($conflict) {
            return back()->withErrors(['conflict' => 'The meeting room is already booked for this time.'])->withInput();
        }

        // Create the booking
        $booking = Booking::create([
            'title' => $request->title,
            'employee_id' => $employee->id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        // Attach participants to the booking
        if ($request->has('participants')) {
            $booking->employees()->attach($request->participants);
        }

        return redirect()->route('guest-bookings.success')->with('success', 'Booking created successfully.');
    }

    public function success()
    {
        return view('guest-bookings.success');
    }
}
