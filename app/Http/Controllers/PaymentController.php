<?php 
namespace App\Http\Controllers;

use Stripe\Stripe;
use Stripe\Charge;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function checkout()
    {
        return view('payments.checkout'); // Create this view
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.5',
            'stripeToken' => 'required',
        ]);

        try {
            Stripe::setApiKey(config('services.stripe.secret'));

            // Create a Stripe charge
            $charge = Charge::create([
                'amount' => $request->amount * 100, // Amount in cents
                'currency' => 'usd',               // Change to your preferred currency
                'description' => 'Event Booking Payment',
                'source' => $request->stripeToken,
            ]);

            // Handle post-payment actions (e.g., update booking status)
            return redirect()->route('bookings.index')->with('success', 'Payment successful!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
