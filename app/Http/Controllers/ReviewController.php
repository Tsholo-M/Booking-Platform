<?php
namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // Show the review form
    public function create(Event $event)
    {
        // Check if the user has already reviewed the event
        $userHasReviewed = $event->reviews()->where('user_id', Auth::id())->exists();

        if ($userHasReviewed) {
            return redirect()->route('user.dashboard')->with('info', 'You have already reviewed this event.');
        }

        return view('reviews.create', compact('event'));
    }

    // Store the review
    public function store(Request $request, Event $event)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'event_id' => $event->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('events.show', $event->id)
                         ->with('success', 'Review added successfully!');
    }
}
