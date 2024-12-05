<?php
namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Booking; 

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Category;


class OrganizerController extends Controller
{
    // Organizer Dashboard
    public function dashboard()
    {
        $user = Auth::user();

        // Get organizer-specific data
        $totalEvents = Event::where('organizer_id', $user->id)->count();
        $totalBookings = Booking::whereIn('event_id', $user->events->pluck('id'))->count();
        $totalRevenue = Booking::whereIn('event_id', $user->events->pluck('id'))
            ->where('payment_status', 'completed')
            ->sum('amount');

        return view('organizer.dashboard', compact('totalEvents', 'totalBookings', 'totalRevenue'));
    }
        // View all events
        public function manageEvents()
        {
            $events = Event::where('organizer_id', Auth::id())->get();
            return view('organizer.events.index', compact('events'));
        }
    
        // Create event form
        public function createEvent()
        {
             // Fetch categories created by admin users
            $categories = Category::all(); 
    
            return view('organizer.events.create', compact('categories'));
        }
    
        // Store event
        public function storeEvent(Request $request)
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'date_time' => 'required|date|after:today',  // Change 'date' to 'date_time'
                'location' => 'required|string|max:255',
                'category_id' => 'required|exists:categories,id',
                'max_attendees' => 'required|integer|min:1',
                'ticket_price' => 'required|numeric|min:0',
            ]);
            
    
            Event::create([
                'organizer_id' => Auth::id(),
                'name' => $request->name,
                'description' => $request->description,
                'date_time' => $request->date_time,
                'location' => $request->location,
                'category_id' => $request->category_id,
                'max_attendees' => $request->max_attendees,
                'ticket_price' => $request->ticket_price,
            ]);
    
            return redirect()->route('organizer.events')->with('success', 'Event created successfully!');
        }

        public function show($id)
{
    $event = Event::findOrFail($id);
    
    

    return view('organizer.events.show', compact('event'));
}

    
        // Edit event form
        public function editEvent($id)
        {
            $event = Event::where('organizer_id', Auth::id())->findOrFail($id);

    // Fetch all categories created by the admin
          $categories = Category::all();
            return view('organizer.events.edit', compact('event','categories'));
        }
    
        // Update event
        public function updateEvent(Request $request, $id)
        {
            $event = Event::where('organizer_id', Auth::id())->findOrFail($id);
    
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'date' => 'required|date|after:today',
                'location' => 'required|string|max:255',
                'category_id' => 'required|exists:categories,id',
                'max_attendees' => 'required|integer|min:1',
                'ticket_price' => 'required|numeric|min:0',
            ]);
    
            $event->update($request->all());
    
            return redirect()->route('organizer.events')->with('success', 'Event updated successfully!');
        }
    
        // Delete event
        public function deleteEvent($id)
        {
            $event = Event::where('organizer_id', Auth::id())->findOrFail($id);
            $event->delete();
    
            return redirect()->route('organizer.events')->with('success', 'Event deleted successfully!');
        }
}
