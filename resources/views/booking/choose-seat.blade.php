@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <h1>Choose a Seat for Flight {{ $flight->flight_number }}</h1>
                    <table id="tables">
                        <thead>
                            <tr>
                                <th>Seat Number</th>
                                <th>Availability</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($seats as $seat)
                                <tr>
                                    <td>{{ $seat->seat_number }}</td>
                                    <td>{{ $seat->is_available ? 'Available' : 'Booked' }}</td>
                                    <td>
                                        @if($seat->is_available)
                                            <form method="POST" action="{{ route('booking.bookSeat', $seat->id) }}">
                                                @csrf
                                                <button type="submit">Book</button>
                                            </form>
                                        @else
                                            N/A
                                        @endif
                                    </td>
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
