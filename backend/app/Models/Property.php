<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Property extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'owner_id', 'title', 'description', 'type', 'address', 'city',
        'latitude', 'longitude', 'price_per_month', 'security_deposit',
        'amenities', 'images', 'status'
    ];

    protected $casts = [
        'amenities' => 'array',
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
}
