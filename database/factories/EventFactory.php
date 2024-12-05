<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Event;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition()
    {
        return [
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'location' => $this->faker->address(),
            'date_time' => $this->faker->dateTimeBetween('+1 week', '+1 month'),
            'category_id' => \App\Models\Category::inRandomOrder()->first()->id ?? null,
            'max_attendees' => rand(10, 100),
            'ticket_price' => $this->faker->randomFloat(2, 10, 500),
            'status' => 'Upcoming',
            'visibility' => 'public',
        ];
    }
}
