<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'nom_client',
        'profession',
        'contenu',
        'metrique',
        'avatar_url',
        'note',
        'featured',
        'actif',
        'ordre'
    ];

    protected $casts = [
        'note' => 'integer',
        'featured' => 'boolean',
        'actif' => 'boolean',
        'ordre' => 'integer'
    ];

    /**
     * Scope pour récupérer uniquement les témoignages actifs
     */
    public function scopeActif($query)
    {
        return $query->where('actif', true);
    }

    /**
     * Scope pour récupérer les témoignages mis en avant
     */
    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    /**
     * Scope pour ordonner par ordre croissant
     */
    public function scopeOrdre($query)
    {
        return $query->orderBy('ordre');
    }

    /**
     * Accesseur pour obtenir les étoiles sous forme de chaîne
     */
    public function getEtoilesAttribute()
    {
        return str_repeat('⭐', $this->note);
    }
}
