<!DOCTYPE html>
<html>
<head>
    <title>Booking Confirmation</title>
</head>
<body>
    <h1>Thank you for booking!</h1>
    <p>Booking Details:</p>
    <ul>
        <li>Event: {{ $booking->event->name }}</li>
        <li>Date: {{ $booking->event->date }}</li>
        <li>Quantity: {{ $booking->quantity }}</li>
        <li>Total: ${{ $booking->event->ticket_price * $booking->quantity }}</li>
    </ul>
</body>
</html>
