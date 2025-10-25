<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    protected $fillable = [
        'titre',
        'slug',
        'description',
        'icone_svg',
        'actif',
        'ordre'
    ];

    protected $casts = [
        'actif' => 'boolean',
        'ordre' => 'integer'
    ];

    /**
     * Génère automatiquement le slug à partir du titre
     */
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($service) {
            if (empty($service->slug)) {
                $service->slug = Str::slug($service->titre);
            }
        });
    }

    /**
     * Scope pour récupérer uniquement les services actifs
     */
    public function scopeActif($query)
    {
        return $query->where('actif', true);
    }

    /**
     * Scope pour ordonner par ordre croissant
     */
    public function scopeOrdre($query)
    {
        return $query->orderBy('ordre');
    }
}
