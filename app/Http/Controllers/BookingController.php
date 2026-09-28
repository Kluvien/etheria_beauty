<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Schedule;
use App\Models\Service;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create()
    {
        return view('booking', [
            'services' => Service::where('is_active', true)->orderBy('name')->get(),
            'schedules' => Schedule::where('is_available', true)->whereDoesntHave('booking')->whereDate('available_date', '>=', today())->orderBy('available_date')->orderBy('available_time')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'service_id' => ['required', 'exists:services,id'],
            'schedule_id' => ['required', 'exists:schedules,id'],
            'customer_name' => ['required', 'string', 'max:120'],
            'whatsapp_number' => ['required', 'string', 'max:30'],
            'note' => ['nullable', 'string', 'max:1000'],
        ]);

        $schedule = Schedule::whereKey($data['schedule_id'])->where('is_available', true)->firstOrFail();
        if ($schedule->booking()->exists()) {
            return back()->withErrors(['schedule_id' => 'That time has just been booked. Please choose another slot.'])->withInput();
        }

        try {
            $booking = Booking::create($data);
        } catch (UniqueConstraintViolationException) {
            return back()->withErrors(['schedule_id' => 'That time has just been booked. Please choose another slot.'])->withInput();
        }

        return redirect()->route('booking.confirmation', $booking);
    }

    public function confirmation(Booking $booking)
    {
        return view('booking-confirmation', compact('booking'));
    }
}