<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Employee;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function __construct()
    {
        // Only allow logged-in users for booking management, but allow guest for creating a booking
        $this->middleware(['auth', 'role:admin'])->except(['index', 'publicCalendar', 'create', 'store']);
    }

    public function index()
    {
        // Retrieve bookings with employees (organizer and participants) with pagination
        $bookings = Booking::with('employee', 'employees')->paginate(5);
        return view('bookings.index', compact('bookings'));
    }

    public function show($id)
    {
        $booking = Booking::with('employee', 'employees')->findOrFail($id);
        return view('bookings.show', compact('booking'));
    }

    public function publicCalendar()
    {
        $bookings = Booking::with('employee')->get();

        $events = $bookings->map(function ($booking) {
            return [
                'title' => $booking->title . ' (' . $booking->employee->name . ')',
                'start' => $booking->start_time,
                'end'   => $booking->end_time,
            ];
        });

        return view('calendar', [
            'events' => $events->toJson(),
        ]);
    }



    //    public function publicCalendar()
    //    {
    //        $bookings = Booking::with('employee')->get();
    //        return view('calendar', compact('bookings'));
    //    }

    public function create()
    {
        $employees = Employee::all();
        return view('bookings.create', compact('employees'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'employee_id' => 'nullable|exists:employees,id', // Optional for guests
            'guest_name' => 'nullable|string|max:255', // For guest name
            'guest_email' => 'nullable|email|max:255', // For guest email
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'participants' => 'nullable|array',
            'participants.*' => 'exists:employees,id',
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
            'employee_id' => $request->employee_id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        // Attach the participants to the booking
        if ($request->has('participants')) {
            $booking->employees()->attach($request->participants);
        }

        return redirect()->route('bookings.index')->with('success', 'Booking created successfully.');
    }


    public function edit($id)
    {
        $booking = Booking::with('employees')->findOrFail($id);
        $employees = Employee::all();
        return view('bookings.edit', compact('booking', 'employees'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'employee_id' => 'required|exists:employees,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'participants' => 'nullable|array',
            'participants.*' => 'exists:employees,id',
        ]);

        // Check for conflicting bookings
        $conflict = Booking::where('id', '!=', $id)
            ->where('start_time', '<', $request->end_time)
            ->where('end_time', '>', $request->start_time)
            ->exists();

        if ($conflict) {
            return back()->withErrors(['conflict' => 'The meeting room is already booked for this time.'])->withInput();
        }

        // Update the booking
        $booking = Booking::findOrFail($id);
        $booking->update([
            'title' => $request->title,
            'employee_id' => $request->employee_id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        // Sync the participants (this will remove old and add new ones)
        if ($request->has('participants')) {
            $booking->employees()->sync($request->participants);
        }

        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully.');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully.');
    }
}
