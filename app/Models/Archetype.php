<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Archetype extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'icon',
        'description',
        'enabled_features',
        'default_cta',
        'cta_label',
        'schema_type',
    ];

    protected $casts = [
        'enabled_features' => 'array',
    ];

    public function tenants(): HasMany
    {
        return $this->hasMany(Tenant::class);
    }

    public function hasFeature(string $feature): bool
    {
        return in_array($feature, $this->enabled_features ?? []);
    }
}
