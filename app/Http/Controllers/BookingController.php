<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Employee;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:manage bookings')->except(['index']);
    }

    public function index()
    {
        $bookings = Booking::with('employee')->get();
        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('bookings.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'employee_id' => 'required|exists:employees,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        // Check for conflicting bookings
        $conflict = Booking::where('start_time', '<', $request->end_time)
            ->where('end_time', '>', $request->start_time)
            ->exists();

        if ($conflict) {
            return back()->withErrors('The meeting room is already booked for this time.');
        }

        Booking::create($request->all());
        return redirect()->route('bookings.index')->with('success', 'Booking created successfully.');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully.');
    }
}

