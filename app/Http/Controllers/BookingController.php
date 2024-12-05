<?php 
namespace App\Http\Controllers;

use App\Mail\BookingConfirmation;
use App\Models\Booking;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class BookingController extends Controller
{
    /**
     * Store a new booking.
     */
     
     public function store(Request $request)
{
    $request->validate([
        'event_id' => 'required|exists:events,id',
        'quantity' => 'required|integer|min:1',
    ]);

    $event = Event::findOrFail($request->event_id);

    // Check ticket availability
    if ($event->current_bookings + $request->quantity > $event->max_attendees) {
        return back()->with('error', 'Not enough tickets available.');
    }

    $totalAmount = $event->ticket_price * $request->quantity;

    // Create a pending booking entry
    $booking = Booking::create([
        'user_id' => auth()->id(),
        'event_id' => $event->id,
        'quantity' => $request->quantity,
        'payment_status' => 'pending',
        'qr_code' => '', // Placeholder for now
    ]);

    // Generate QR Code for booking
    $qrCode = new QrCode(route('bookings.show', $booking->id));
    $writer = new PngWriter();
    $qrCodeData = $writer->write($qrCode);

    // Save QR Code as Base64 string
    $booking->qr_code = base64_encode($qrCodeData->getString());
    $booking->save();
    
  
    // Stripe Checkout Session
    Stripe::setApiKey(config('stripe.secret_key'));

    $session = StripeSession::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                    'name' => $event->name,
                    'description' => $event->description,
                ],
                'unit_amount' => $event->ticket_price * 100, // Stripe uses cents
            ],
            'quantity' => $request->quantity,
        ]],
        'mode' => 'payment',
        'success_url' => route('bookings.payment.success') . '?session_id={CHECKOUT_SESSION_ID}',

        'cancel_url' => route('bookings.payment.cancel'),
        'metadata' => [
            'booking_id' => $booking->id, // Pass the booking ID for success handling
        ],
    ]);

    // Redirect to Stripe Checkout
    return redirect($session->url);
}
     
     
    /**
     * Show booking details.
     */
    public function show(Booking $booking)
    {
        return view('booking.show', compact('booking'));
    }

    public function paymentSuccess(Request $request)
{
    $sessionId = $request->query('session_id');

    Stripe::setApiKey(config('stripe.secret_key'));
    $session =   $session = \Stripe\Checkout\Session::retrieve($sessionId);

    if (!$session || $session->payment_status !== 'paid') {
        return redirect()->route('home')->with('error', 'Payment verification failed.');
    }

    $booking = Booking::findOrFail($session->metadata['booking_id']);
    $booking->payment_status = 'completed';
    $booking->save();
    

    // Record the payment
    $booking->payments()->create([
        'amount' => $session->amount_total / 100,
        'payment_method' => 'stripe',
        'payment_status' => 'completed',
    ]);
     // Send confirmation email
     Mail::to($booking->user->email)->send(new BookingConfirmation($booking));

    return redirect()->route('bookings.show', $booking->id)->with('success', 'Payment successful! Your booking is confirmed.');
}

}