<h1>Booking Confirmation</h1>
    <p>Thank you for your booking!</p>

    <div>
        <h2>Booking Details:</h2>
        <ul>
            <li>Room: {{ $booking->room->name }}</li>
            <li>Check-in: {{ $booking->started_at->format('Y-m-d') }}</li>
            <li>Check-out: {{ $booking->finished_at->format('Y-m-d') }}</li>
            <li>Total Price: ${{ $booking->price }}</li>
            <li>Total Days: {{ $booking->days }}</li>
            @if($booking->room->hotel)
                <li>Hotel: {{ $booking->room->hotel->title }}</li>
            @endif
        </ul>
    </div>


