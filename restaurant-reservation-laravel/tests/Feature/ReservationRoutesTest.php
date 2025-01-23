<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Reservation;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReservationRoutesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_reservations()
    {
        $user = User::factory()->create();
        Reservation::factory()->count(5)->create(['user_id' => $user->id]);

        $response = $this->get('/api/reservations');

        $response->assertStatus(200);
        $response->assertJsonCount(5); // Check if 5 reservations are returned
    }

    /** @test */
    public function it_can_create_a_reservation()
    {
        $user = User::factory()->create();

        $data = [
            'user_id' => $user->id,
            'table_number' => 5,
            'reservation_date' => '2025-01-25',
            'reservation_time' => '18:00:00',
            'number_of_guests' => 4,
            'status' => 'pending',
        ];

        $response = $this->post('/api/reservations', $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('reservations', $data); // Check if data exists in the DB
    }
}
