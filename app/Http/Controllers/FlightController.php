<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\Booking;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function index()
    {
        $flights = Flight::all();
        return response()->json($flights);
    }

    public function show($id)
    {
        $flight = Flight::find($id);
        // return $flight;

        if (!$flight) {
            return response()->json(['message' => 'Flight not found'], 404);
        }
        return response()->json($flight);
    }

    public function store(Request $request)
    {
    // Validasi input
    $request->validate([
        'flight_id' => 'required|integer|unique:flights,flight_id', // Menambahkan validasi unik untuk flight_id
        'flight_number' => 'required|string',
        'departure' => 'required|string',
        'destination' => 'required|string',
        'departure_time' => 'required|date',
        'arrival_time' => 'required|date',
        'price' => 'required|numeric',
    ]);

    // Jika validasi berhasil, simpan data penerbangan
    $flight = Flight::create($request->all());
    return response()->json($flight, 201);
}
}
