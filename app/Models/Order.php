<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'order_number',
        'type',
        'customer_name',
        'customer_phone',
        'customer_email',
        'customer_address',
        'total_amount',
        'payment_status',
        'payment_method',
        'status',
        'items_payload',
        'metadata',
    ];

    protected $casts = [
        'total_amount' => 'float',
        'items_payload' => 'array',
        'metadata' => 'array',
    ];

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }
}
