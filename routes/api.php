<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\api\ApiSeatController;
use App\Http\Controllers\Api\ApiBookingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout'])->name('logout');



// Route::middleware('auth:sanctum')->group(function () {
//     Route::get('/user/profile', [CustomerController::class, 'getProfile']);

//     // Endpoint untuk penerbangan
//     Route::get('/flights', [FlightController::class, 'index']);
//     Route::get('/flights/{id}', [FlightController::class, 'show']);
//     Route::post('/flights', [FlightController::class, 'store']); // Hanya untuk admin atau pengguna tertentu

    // Endpoint untuk pemesanan
//     Route::post('/bookings', [BookingController::class, 'store']);
//   Route::get('/bookings/{id}', [BookingController::class, 'show']);
// });

Route::middleware('auth:sanctum')->group(function () {
    // 1
    Route::get('flights', [ApiBookingController::class, 'chooseFlight']);
    Route::post('flights', [ApiBookingController::class, 'store']);

    //2
    Route::get('flights/{flightId}/seats', [ApiBookingController::class, 'chooseSeat']);
    Route::post('seats/{seatId}/book', [ApiBookingController::class, 'bookSeat']);

    //3
    Route::get('bookings/{bookingId}/payment', [ApiBookingController::class, 'createPayment']);
    Route::post('bookings/{bookingId}/payment', [ApiBookingController::class, 'processPayment']);

    Route::get('bookings/success', [ApiBookingController::class, 'success']);
    Route::get('payments/history', [ApiBookingController::class, 'history']);
    Route::post('seats/store', [ApiSeatController::class, 'store']);

});
