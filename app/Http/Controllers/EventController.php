<?php
namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class EventController extends Controller
{
    // Organizer's Event Dashboard
    public function index(Request $request)
    {
     
        $user = Auth::user(); // Retrieve the authenticated user

    if ($user) {
        $query = Event::where('visibility', true);

        // Filter by category
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }
    
        // Filter by status (upcoming/past)
        if ($request->has('status') && $request->status != '') {
            if ($request->status == 'upcoming') {
                $query->where('date_time', '>', Carbon::now());
            } elseif ($request->status == 'past') {
                $query->where('date_time', '<', Carbon::now());
            }
        }
    
        // Fetch the events with applied filters
        $events = $query->get();
    
        // Fetch categories for the filter dropdown
        $categories = Category::all();
        return view('events.index', compact('events','categories'));
    }
    return redirect()->route('dashboard')->with('error', 'Unauthorized Access!');
}

    // Create Event Form
    public function create()
    {
        $categories = Category::all();
        return view('events.create', compact('categories'));
    }

    // Store Event
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'date_time' => 'required|date',
            'category_id' => 'required|exists:categories,id',
            'max_attendees' => 'required|integer|min:1',
            'ticket_price' => 'nullable|numeric|min:0',
        ]);

        $user = Auth::user(); // Retrieve the authenticated user

        if ($user) {
            Event::create([
                'name' => $request->name,
                'description' => $request->description,
                'location' => $request->location,
                'date_time' => $request->date_time,
                'category_id' => $request->category_id,
                'organizer_id' => $user->id, // Use the user's ID explicitly
                'max_attendees' => $request->max_attendees,
                'ticket_price' => $request->ticket_price,
            ]);
        }

        return redirect()->route('events.index')->with('success', 'Event created successfully!');
    }

    // Edit Event Form
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        $categories = Category::all();
        $user = Auth::user(); // Retrieve the authenticated user

        if ($user && $event->organizer_id !== $user->id) {
            return redirect()->route('events.index')->with('error', 'Unauthorized Access!');
        }

        return view('events.edit', compact('event', 'categories'));
    }

    // Update Event
    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $user = Auth::user(); // Retrieve the authenticated user

        if ($user && $event->organizer_id !== $user->id) {
            return redirect()->route('events.index')->with('error', 'Unauthorized Access!');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'date_time' => 'required|date',
            'category_id' => 'required|exists:categories,id',
            'max_attendees' => 'required|integer|min:1',
            'ticket_price' => 'nullable|numeric|min:0',
        ]);

        $event->update($request->all());
        return redirect()->route('events.index')->with('success', 'Event updated successfully!');
    }

    // Delete Event
    public function delete($id)
    {
        $event = Event::findOrFail($id);
        $user = Auth::user(); 
        if  ($user && $event->organizer_id !== $user->id) {
            return redirect()->route('events.index')->with('error', 'Unauthorized Access!');
        }

        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event deleted successfully!');
    }

    // Browse Events
    public function browse(Request $request)
    {
        $query = Event::where('visibility', true);

        // Filter by category
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }
    
        // Filter by status (upcoming/past)
        if ($request->has('status') && $request->status != '') {
            if ($request->status == 'upcoming') {
                $query->where('date_time', '>', Carbon::now());
            } elseif ($request->status == 'past') {
                $query->where('date_time', '<', Carbon::now());
            }
        }
    
        // Fetch the events with applied filters
        $events = $query->get();
    
        // Fetch categories for the filter dropdown
        $categories = Category::all();
    
        return view('events.browse', compact('events', 'categories'));
    }

    // Show Event Details
    public function show($id)
    {
        $event = Event::findOrFail($id);
        $event->load('reviews.user'); // Eager load reviews with user info
        return view('events.show', compact('event'));
    }
}
