@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    <h1>Payment History</h1>
                    <table id="tables">
                        <thead>
                            <tr>
                                <th>Booking ID</th>
                                <th>Amount</th>
                                <th>Payment Method</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payments as $payment)
                                <tr>
                                    <td>{{ $payment->booking_id }}</td>
                                    <td>{{ $payment->amount }}</td>
                                    <td>{{ $payment->payment_method }}</td>
                                    <td>{{ $payment->status }}</td>
                                    <td>{{ $payment->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
