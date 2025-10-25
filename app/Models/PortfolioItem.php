<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PortfolioItem extends Model
{
    protected $fillable = [
        'titre',
        'slug',
        'categorie',
        'description',
        'image_url',
        'technologies',
        'lien_demo',
        'lien_github',
        'featured',
        'actif',
        'ordre'
    ];

    protected $casts = [
        'technologies' => 'array',
        'featured' => 'boolean',
        'actif' => 'boolean',
        'ordre' => 'integer'
    ];

    /**
     * Génère automatiquement le slug à partir du titre
     */
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($item) {
            if (empty($item->slug)) {
                $item->slug = Str::slug($item->titre);
            }
        });
    }

    /**
     * Scope pour récupérer uniquement les items actifs
     */
    public function scopeActif($query)
    {
        return $query->where('actif', true);
    }

    /**
     * Scope pour récupérer les items mis en avant
     */
    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    /**
     * Scope pour filtrer par catégorie
     */
    public function scopeCategorie($query, $categorie)
    {
        return $query->where('categorie', $categorie);
    }

    /**
     * Scope pour ordonner par ordre croissant
     */
    public function scopeOrdre($query)
    {
        return $query->orderBy('ordre');
    }
}
