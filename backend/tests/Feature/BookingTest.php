<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Property;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_property_booking()
    {
        $user = User::factory()->create();
        $owner = User::factory()->create();
        $property = Property::create([
            'owner_id' => $owner->id,
            'title' => 'Sample Villa',
            'description' => 'A beautiful villa',
            'type' => 'Villa',
            'city' => 'Bangalore',
            'price_per_month' => 50000,
            'security_deposit' => 100000,
            'status' => 'available',
            'address' => 'Test Address'
        ]);

        $token = auth('api')->login($user);

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
                         ->postJson('/api/bookings', [
                             'bookable_type' => 'property',
                             'bookable_id' => $property->id,
                             'start_date' => now()->addDay()->toDateTimeString(),
                             'total_price' => 50000,
                         ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('bookings', [
            'bookable_id' => $property->id,
            'bookable_type' => 'property'
        ]);
    }
}
