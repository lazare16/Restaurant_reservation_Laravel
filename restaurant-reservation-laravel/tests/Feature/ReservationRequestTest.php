<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Table;
use App\Models\Reservation;

class ReservationRequestTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_validates_required_fields_for_reservation()
    {
        // Acting as a user
        $user = User::factory()->create();
        $this->actingAs($user);

        // Sending a POST request with empty data
        $response = $this->postJson(route('reservations.store'), []);

        // Expect validation errors
        $response->assertStatus(422)
                 ->assertJsonValidationErrors([
                     'table_number',
                     'reservation_date',
                     'reservation_time',
                     'number_of_guests',
                 ]);
    }

    /** @test */
    public function it_validates_field_formats_and_constraints()
    {
        $user = User::factory()->create();
        $table = Table::factory()->create(['table_number' => 5]);
        $this->actingAs($user);

        // Invalid data (e.g., wrong formats)
        $response = $this->postJson(route('reservations.store'), [
            // 'table_number' => 999, // Non-existent table
            // 'reservation_date' => 'invalid-date', // Invalid date
            // 'reservation_time' => '25:00', // Invalid time
            // 'number_of_guests' => -5, // Negative number
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors([
                    //  'table_number',
                    //  'reservation_date',
                    //  'reservation_time',
                    //  'number_of_guests',

                    'user_id',
             'table_number',
             'reservation_date',
             'reservation_time',
             'number_of_guests',
             'status',
                 ]);
    }

    /** @test */
    public function it_allows_valid_reservation_data()
    {
        $user = User::factory()->create();
        $table = Table::factory()->create(['table_number' => 5]);
        $this->actingAs($user);

        // Valid data
        $response = $this->postJson(route('reservations.store'), [
            // 'table_number' => $table->table_number,
            // 'reservation_date' => now()->addDay()->toDateString(),
            // 'reservation_time' => '19:00',
            // 'number_of_guests' => 4,

            'user_id' => $user->id,
    'table_number' => $table->table_number,
    'reservation_date' => now()->addDay()->toDateString(),
    'reservation_time' => '19:00',
    'number_of_guests' => 4,
    'status' => 'pending',
        ]);

        $response->assertStatus(201)
                 ->assertJson([
                     'message' => 'ჯავშანი წარმატებით შეიქმნა.',
                 ]);

        $this->assertDatabaseHas('reservations', [
            // 'user_id' => $user->id,
            // 'table_number' => $table->table_number,
            // 'number_of_guests' => 4,

            'user_id' => $user->id,
            'table_number' => $table->table_number,
            'number_of_guests' => 4,
        ]);
    }

    /** @test */
    public function it_prevents_double_booking_for_the_same_table()
    {
        $user = User::factory()->create();
        $table = Table::factory()->create(['table_number' => 5]);

        // Create an existing reservation
        Reservation::factory()->create([
            // 'table_number' => $table->table_number,
            // 'reservation_date' => now()->addDay()->toDateString(),
            // 'reservation_time' => '19:00',

            'user_id' => $user->id,
    'table_number' => $table->table_number,
    'reservation_date' => now()->addDay()->toDateString(),
    'reservation_time' => '19:00',
    'status' => 'confirmed',
        ]);

        $this->actingAs($user);

        // Try to book the same table at the same time
        $response = $this->postJson(route('reservations.store'), [
            // 'table_number' => $table->table_number,
            // 'reservation_date' => now()->addDay()->toDateString(),
            // 'reservation_time' => '19:00',
            // 'number_of_guests' => 2,

            'user_id' => $user->id,
    'table_number' => $table->table_number,
    'reservation_date' => now()->addDay()->toDateString(),
    'reservation_time' => '19:00',
    'number_of_guests' => 2,
    'status' => 'pending',
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['table_number']);
    }
}
