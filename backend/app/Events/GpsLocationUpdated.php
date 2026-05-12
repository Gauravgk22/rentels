<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class GpsLocationUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $vehicleId;
    public $latitude;
    public $longitude;

    public function __construct($vehicleId, $latitude, $longitude)
    {
        $this->vehicleId = $vehicleId;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('vehicle.'.$this->vehicleId),
        ];
    }
}
