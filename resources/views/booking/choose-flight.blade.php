@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <h1>Choose a Flight</h1>
                    <table id="tables">
                        <thead>
                            <tr>
                                <th>Flight Number</th>
                                <th>Departure</th>
                                <th>Destination</th>
                                <th>Departure Time</th>
                                <th>Arrival Time</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($flights as $flight)
                                <tr>
                                    <td>{{ $flight->flight_number }}</td>
                                    <td>{{ $flight->departure }}</td>
                                    <td>{{ $flight->destination }}</td>
                                    <td>{{ $flight->departure_time }}</td>
                                    <td>{{ $flight->arrival_time }}</td>
                                    <td>{{ $flight->price }}</td>
                                    <td>
                                        <a href="{{ route('booking.chooseSeat', $flight->id) }}">Choose Seats</a>
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
