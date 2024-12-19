<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Flight</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Add New Flight</h2>
        <form action="{{ route('flights.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="flight_id">flight id:</label>
                <input type="number" class="form-control" id="flight_id" name="flight_id" required>
            </div>
            <div class="form-group">
                <label for="flight_number">Flight Number:</label>
                <input type="text" class="form-control" id="flight_number" name="flight_number" required>
            </div>
            <div class="form-group">
                <label for="departure">Departure City:</label>
                <input type="text" class="form-control" id="departure" name="departure" required>
            </div>
            <div class="form-group">
                <label for="destination">Destination City:</label>
                <input type="text" class="form-control" id="destination" name="destination" required>
            </div>
            <div class="form-group">
                <label for="departure_time">Departure Time:</label>
                <input type="datetime-local" class="form-control" id="departure_time" name="departure_time" required>
            </div>
            <div class="form-group">
                <label for="arrival_time">Arrival Time:</label>
                <input type="datetime-local" class="form-control" id="arrival_time" name="arrival_time" required>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Flight</button>
        </form>
    </div>
</body>
</html>