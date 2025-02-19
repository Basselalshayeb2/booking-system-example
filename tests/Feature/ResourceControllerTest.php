<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\Resource;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ResourceControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    public function testCreateResourceWithDescription(): void
    {
        $resourceData = [
            'name' => 'Example Resource',
            'type' => 'type1',
            'description' => 'This is an example resource.',
        ];
        $response = $this->postJson('/api/resources', $resourceData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('resources', $resourceData);
    }

    public function testCreateResourceWithoutDescription(): void
    {
        $resourceData = [
            'name' => 'Example Resource',
            'type' => 'type1',
        ];
        $response = $this->postJson('/api/resources', $resourceData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('resources', $resourceData);
    }

    public function testRetriveResources(): void
    {
        $resources = Resource::factory()->count(3)->create();
        $response = $this->getJson('/api/resources');
        $response->assertStatus(200)
            ->assertJsonCount(3, 'data');

        foreach ($resources as $resource) {
            $this->assertDatabaseHas('resources', [
                'id' => $resource->id,
                'name' => $resource->name,
                'type' => $resource->type,
                'description' => $resource->description,
            ]);
        }
    }

    public function testCancelBooking(): void
    {
        $seededUserId = User::first()->id;
        $resource = Resource::factory()->create();
        $booking = Booking::factory()->create([
            'resource_id' => $resource->id,
            'user_id' => $seededUserId
        ]);
        $response = $this->delete("/api/bookings/{$booking->id}");
        $response->assertStatus(200);
        $this->assertSoftDeleted('bookings', ['id' => $booking->id]);
    }

}
