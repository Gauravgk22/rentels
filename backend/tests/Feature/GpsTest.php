<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Vehicle;
use App\Models\GpsLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use App\Events\GpsLocationUpdated;
use Tests\TestCase;

class GpsTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_update_vehicle_gps_location()
    {
        Event::fake();

        $user = User::factory()->create();
        $vehicle = Vehicle::create([
            'owner_id' => $user->id,
            'make' => 'Tesla',
            'model' => 'Model 3',
            'year' => '2024',
            'type' => 'Car',
            'registration_number' => 'TS01AWISH',
            'price_per_day' => 5000,
            'status' => 'available'
        ]);

        $token = auth('api')->login($user);

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
                         ->postJson('/api/vehicles/' . $vehicle->id . '/gps', [
                             'latitude' => 12.9716,
                             'longitude' => 77.5946,
                             'speed' => 60,
                             'heading' => 180
                         ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('vehicles', [
            'id' => $vehicle->id,
            'latitude' => 12.9716,
            'longitude' => 77.5946
        ]);

        $this->assertDatabaseHas('gps_logs', [
            'vehicle_id' => $vehicle->id,
            'latitude' => 12.9716,
            'longitude' => 77.5946
        ]);

        Event::assertDispatched(GpsLocationUpdated::class);
    }
}
