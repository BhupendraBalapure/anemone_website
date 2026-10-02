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

    /**
     * Free default test domain / URL for this store
     */
    public function getTestDomainUrlAttribute(): string
    {
        return url('/store/'.$this->slug);
    }

    /**
     * Local development standalone domain URL (e.g. http://bbb-lcug.localhost:8000)
     */
    public function getLocalDomainUrlAttribute(): string
    {
        $port = request()->getPort();
        $portSuffix = (! $port || in_array($port, [80, 443])) ? '' : ':'.$port;

        return 'http://'.$this->slug.'.localhost'.$portSuffix;
    }

    /**
     * Primary active domain URL
     * In local development (localhost / *.localhost): returns working local standalone URL
     * In production (cloud / live server): returns custom domain https://{custom_domain} or https://{slug}.anemony.in
     */
    public function getPrimaryDomainUrlAttribute(): string
    {
        $host = request()->getHost();
        $isLocalEnv = app()->isLocal()
            || in_array(strtolower($host), ['localhost', '127.0.0.1'])
            || str_ends_with(strtolower($host), '.localhost');

        if ($isLocalEnv) {
            return $this->local_domain_url;
        }

        if ($this->hasCustomDomain()) {
            return 'https://'.$this->custom_domain;
        }

        return 'https://'.$this->slug.'.anemony.in';
    }

    /**
     * Production target URL when hosted on cloud/VPS
     */
    public function getProductionDomainUrlAttribute(): string
    {
        if ($this->hasCustomDomain()) {
            return 'https://'.$this->custom_domain;
        }

        return 'https://'.$this->slug.'.anemony.in';
    }

    /**
     * Whether this tenant has a verified custom domain
     */
    public function hasCustomDomain(): bool
    {
        return ! empty($this->custom_domain);
    }

    /**
     * Status of the custom domain (active, pending, none)
     */
    public function getDomainStatusAttribute(): string
    {
        if (! $this->hasCustomDomain()) {
            return 'none';
        }

        return $this->settings['domain_status'] ?? 'active';
    }
}
