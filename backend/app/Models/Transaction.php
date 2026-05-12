<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $fillable = [
        'wallet_id', 'amount', 'type', 'status', 'reference_type',
        'reference_id', 'description', 'metadata'
    ];

    protected $casts = [
        'metadata' => 'array',
    ];

    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }
}
