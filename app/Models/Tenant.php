<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_name',
        'slug',
        'custom_domain',
        'archetype_id',
        'active_theme',
        'phone',
        'whatsapp_number',
        'city',
        'address',
        'tagline',
        'about_text',
        'brand_color',
        'settings',
        'is_active',
    ];

    protected $casts = [
        'settings' => 'array',
        'is_active' => 'boolean',
    ];

    public function getBusinessCategoryAttribute(): ?string
    {
        return $this->settings['business_category'] ?? null;
    }

    public function archetype(): BelongsTo
    {
        return $this->belongsTo(Archetype::class);
    }

    public function catalogItems(): HasMany
    {
        return $this->hasMany(CatalogItem::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Helper to get WhatsApp link with prefilled text
     */
    public function getWhatsAppUrl(string $message = ''): string
    {
        $number = preg_replace('/[^0-9]/', '', $this->whatsapp_number ?? $this->phone ?? '');
        if (! str_starts_with($number, '91') && strlen($number) === 10) {
            $number = '91'.$number;
        }

        return "https://wa.me/{$number}?text=".urlencode($message);
    }
}
