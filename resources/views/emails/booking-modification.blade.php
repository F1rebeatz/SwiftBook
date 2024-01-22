@if ($modificationType === 'update')
    <h1>Booking Modification</h1>
    <p>Your booking details have been updated. Thank you for choosing our service!</p>
@elseif ($modificationType === 'delete')
    <h1>Booking Cancellation</h1>
    <p>Your booking has been canceled. If you have any questions, please contact us.</p>
@endif

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
