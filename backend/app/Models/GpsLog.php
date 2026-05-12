<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GpsLog extends Model
{
    protected $fillable = [
        'vehicle_id', 'latitude', 'longitude', 'speed', 'heading', 'recorded_at'
    ];

    protected $casts = [
        'recorded_at' => 'datetime',
    ];

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }
}
