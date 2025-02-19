<?php

namespace Tests\Feature;

use App\Models\Resource;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class BookingControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    public function testCreateBooking(): void
    {
        $seededUserId = User::first()->id;
        $resource = Resource::factory()->create();
        $bookingData = [
            'user_id' => $seededUserId,
            'resource_id' => $resource->id,
            'start_time' => Carbon::now(),
            'end_time' => Carbon::now()->addHour(),
        ];
        $response = $this->postJson('/api/bookings', $bookingData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('bookings', $bookingData);
    }

}
