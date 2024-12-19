@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <h1>Payment for Booking</h1>
                    <p>Flight: {{ $booking->flight->flight_number }}</p>
                    <p>Amount: {{ $booking->flight->price }}</p>

                    <form method="POST" action="{{ route('payment.process', $booking->id) }}">
                        @csrf
                        <label for="payment_method">Payment Method:</label>
                        <select name="payment_method" id="payment_method" required>
                            <option value="credit_card">Credit Card</option>
                            <option value="bank_transfer">Bank Transfer</option>
                        </select>
                        <button type="submit">Pay</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
