<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User; // Import User model

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(), // Create a user
            'table_number' => $this->faker->numberBetween(1, 50),
            'reservation_date' => $this->faker->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
            'reservation_time' => $this->faker->time('H:i:s'),
            'number_of_guests' => $this->faker->numberBetween(1, 10),
            'special_request' => $this->faker->sentence,
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'canceled']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
