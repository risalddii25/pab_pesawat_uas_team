<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//step 1
Route::get('/flights', [BookingController::class, 'chooseFlight'])->name('booking.chooseFlight');
//step 2
Route::get('/flights/{flightId}/seats', [BookingController::class, 'chooseSeat'])->name('booking.chooseSeat');
Route::post('/seats/{seatId}/book', [BookingController::class, 'bookSeat'])->name('booking.bookSeat');
//step 3
Route::get('/bookings/{bookingId}/payment', [BookingController::class, 'createPayment'])->name('payment.create'); //3
Route::post('/bookings/{bookingId}/payment', [BookingController::class, 'processPayment'])->name('payment.process');
Route::get('/booking-success', [BookingController::class, 'success'])->name('booking.success');
Route::get('/booking-history', [BookingController::class, 'history'])->name('booking.history');
