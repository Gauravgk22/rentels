<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Booking extends Model
{
    protected $fillable = [
        'user_id', 'bookable_type', 'bookable_id', 'start_date', 'end_date',
        'total_price', 'status', 'payment_status', 'confirmed_at', 'cancelled_at'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'confirmed_at' => 'datetime',
        'cancelled_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function bookable(): MorphTo
    {
        return $this->morphTo();
    }
}
