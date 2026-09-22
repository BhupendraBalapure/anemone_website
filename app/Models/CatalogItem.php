<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CatalogItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'title',
        'description',
        'category_name',
        'price',
        'compare_at_price',
        'type',
        'duration_minutes',
        'min_order_qty',
        'in_stock',
        'stock_quantity',
        'image_url',
        'attributes',
        'sort_order',
    ];

    protected $casts = [
        'price' => 'float',
        'compare_at_price' => 'float',
        'in_stock' => 'boolean',
        'attributes' => 'array',
    ];

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }
}
