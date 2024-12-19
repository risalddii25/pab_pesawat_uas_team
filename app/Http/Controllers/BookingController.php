<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;
use App\Models\Seat;
use App\Models\Booking;
use App\Models\Payment;

class BookingController extends Controller
{
    public function chooseFlight()
    {
        $flights = Flight::all();
        return view('booking.choose-flight', compact('flights'));
    }

    public function chooseSeat($flightId)
    {
        $flight = Flight::findOrFail($flightId);
        $seats = Seat::where('flight_id', $flightId)->where('is_available', true)->get();
        return view('booking.choose-seat', compact('flight', 'seats'));
    }

    public function bookSeat(Request $request, $seatId)
    {
        $seat = Seat::findOrFail($seatId);

        if (!$seat->is_available) {
            return redirect()->back()->with('error', 'Seat is already booked.');
        }

        $seat->is_available = false;
        $seat->save();

        $booking = Booking::create([
            'user_id' => auth()->id(),
            'flight_id' => $seat->flight_id,
        ]);

        return redirect()->route('payment.create', ['bookingId' => $booking->id]);
    }

    public function createPayment($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        return view('booking.payment', compact('booking'));
    }

    public function processPayment(Request $request, $bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        Payment::create([
            'booking_id' => $booking->id,
            'amount' => $booking->flight->price,
            'payment_method' => $request->payment_method,
            'status' => 'completed',
        ]);

        return redirect()->route('booking.success');
    }

    public function success()
    {
        return view('booking.success');
    }

    public function history()
    {
        $payments = Payment::whereHas('booking', function ($query) {
            $query->where('user_id', auth()->id());
        })->get();

        return view('booking.history', compact('payments'));
    }
}

