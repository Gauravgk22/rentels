<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehicle extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'owner_id', 'make', 'model', 'year', 'type', 'registration_number',
        'price_per_day', 'price_per_hour', 'features', 'images', 'status',
        'current_location_name', 'latitude', 'longitude'
    ];

    protected $casts = [
        'features' => 'array',
        'images' => 'array',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function bookings(): MorphMany
    {
        return $this->morphMany(Booking::class, 'bookable');
    }

    public function gpsLogs(): HasMany
    {
        return $this->hasMany(GpsLog::class);
    }
}
