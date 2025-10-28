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
     * Les attributs qui doivent être stockés comme texte brut (pas d'échappement)
     */
    protected $raw = ['icone_svg'];

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

    /**
     * Accessor pour nettoyer l'icône SVG et décoder les entités HTML
     */
    public function getIconeSvgAttribute($value)
    {
        if (empty($value)) {
            return null;
        }
        
        // Décoder les entités HTML si elles existent
        $decoded = html_entity_decode($value, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        
        // Enlever les espaces en début et fin
        return trim($decoded);
    }

    /**
     * Helper pour obtenir l'icône SVG prête à afficher
     */
    public function getIcone()
    {
        $icone = $this->attributes['icone_svg'] ?? null;
        
        if (empty($icone)) {
            return null;
        }
        
        // Retourner le SVG brut sans transformation
        return trim($icone);
    }
}
