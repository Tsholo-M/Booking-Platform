<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'location', 'date_time', 'category_id',
        'organizer_id', 'max_attendees', 'ticket_price', 'status', 'visibility'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function getCurrentBookingsAttribute()
    {
        return $this->bookings->sum('quantity');
    }
}
