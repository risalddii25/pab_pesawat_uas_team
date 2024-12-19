<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seat;

class ApiSeatController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input dari request
        $validated = $request->validate([
            'flight_id' => 'required|integer',
            'seat_number' => 'required|integer',
            'is_available' => 'required|integer',
        ]);

        // Menyimpan data penerbangan baru
        $seat = Seat::create([
            'flight_id' => $validated['flight_id'],
            'seat_number' => $validated['seat_number'],
            'is_available' => $validated['is_available'],
        
        ]);

        // Mengembalikan response sukses dengan data penerbangan yang baru dibuat
        return response()->json(['message' => 'Seats create successfully', 'seats' => $seat], 201);
    }
}
