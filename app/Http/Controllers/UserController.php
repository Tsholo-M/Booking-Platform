<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\User;
use App\Http\Controllers\QrCode;


class UserController extends Controller
{
    public function dashboard()
    {
       
        $user = Auth::user();
        
       // Fetch bookings made by the user 
        $bookings = Booking::where('user_id', $user->id)
            ->with('event') 
            ->orderBy('created_at', 'desc')
            ->get();
           
           

        // Fetch recommended or upcoming events 
        $upcomingEvents = Event::where('date_time', '>', now())
            ->orderBy('date_time', 'asc')
            ->take(5)
            ->get();
            //dd($bookings);
        return view('user.dashboard', compact('bookings', 'upcomingEvents'));
    }
     // Show the booking form
     public function showBookingForm($id)
     {
         $event = Event::findOrFail($id);
         return view('booking.create', compact('event'));
     }
 
    
}
