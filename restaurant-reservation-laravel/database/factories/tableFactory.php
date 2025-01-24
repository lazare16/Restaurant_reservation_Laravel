<?php

namespace Database\Factories;

use App\Models\Table;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\table>
 */
class tableFactory extends Factory
{
    protected $model = Table::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'table_number' => Table::factory()->create()->table_number,
            'reservation_date' => $this->faker->dateTimeBetween('+1 day', '+1 month')->format('Y-m-d'),
            'reservation_time' => $this->faker->time('H:i'),
            'number_of_guests' => $this->faker->numberBetween(1, 10),
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'canceled']),
            'special_request' => $this->faker->sentence,
        ];
    }
}
