<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;  // Import Controller

use Illuminate\Http\Request;
use App\Models\Flight;
use App\Models\Seat;
use App\Models\Booking;
use App\Models\Payment;

class ApiBookingController extends Controller
{
    public function chooseFlight()
    {
        $flights = Flight::all();
        return response()->json($flights);
    }

    public function chooseSeat($flightId)
    {
        $flight = Flight::findOrFail($flightId);
        $seats = Seat::where('flight_id', $flightId)->where('is_available', true)->get();
        return response()->json(['flight' => $flight, 'seats' => $seats]);
    }

    public function bookSeat(Request $request, $seatId)
    {
        $seat = Seat::findOrFail($seatId);

        if (!$seat->is_available) {
            return response()->json(['error' => 'Seat is already booked.'], 400);
        }

        $seat->is_available = false;
        $seat->save();

        $booking = Booking::create([
            'user_id' => auth()->id(),
            'flight_id' => $seat->flight_id,
        ]);

        return response()->json(['message' => 'Seat booked successfully.', 'booking_id' => $booking->id]);
    }

    public function createPayment($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        return response()->json(['booking' => $booking]);
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

        return response()->json(['message' => 'Payment processed successfully.']);
    }

    public function success()
    {
        return response()->json(['message' => 'Booking successful']);
    }

    public function history()
    {
        $payments = Payment::whereHas('booking', function ($query) {
            $query->where('user_id', auth()->id());
        })->get();

        return response()->json(['payments' => $payments]);
    }

    public function store(Request $request)
    {
        // Validasi input dari request
        $validated = $request->validate([
            'flight_id' => 'required|integer',
            'flight_number' => 'required|string|max:255',
            'departure' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'departure_time' => 'required|date_format:Y-m-d H:i:s',
            'arrival_time' => 'required|date_format:Y-m-d H:i:s|after:departure_time',
            'price' => 'required|numeric|min:0',
        ]);

        // Menyimpan data penerbangan baru
        $flight = Flight::create([
            'flight_id' => $validated['flight_id'],
            'flight_number' => $validated['flight_number'],
            'departure' => $validated['departure'],
            'destination' => $validated['destination'],
            'departure_time' => $validated['departure_time'],
            'arrival_time' => $validated['arrival_time'],
            'price' => $validated['price'],
        ]);

        // Mengembalikan response sukses dengan data penerbangan yang baru dibuat
        return response()->json(['message' => 'Flight created successfully', 'flight' => $flight], 201);
    }
}
