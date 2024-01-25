<h1>Booking Confirmation</h1>
    <p>Thank you for your booking!</p>

    <div>
        <h2>Booking Details:</h2>
        <ul>
            <li>Room: <?php echo e($booking->room->name); ?></li>
            <li>Check-in: <?php echo e($booking->started_at); ?></li>
            <li>Check-out: <?php echo e($booking->finished_at); ?></li>
            <li>Total Price: $<?php echo e($booking->price); ?></li>
            <li>Total Days: <?php echo e($booking->days); ?></li>
            <?php if($booking->room->hotel): ?>
                <li>Hotel: <?php echo e($booking->room->hotel->title); ?></li>
            <?php endif; ?>
        </ul>
    </div>


<?php /**PATH C:\xampp\htdocs\sites\SwiftBook\resources\views/emails/booking-confirmation.blade.php ENDPATH**/ ?>