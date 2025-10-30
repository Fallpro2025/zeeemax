<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Valeur extends Model
{
    protected $fillable = [
        'titre',
        'description',
        'icon',
        'couleur',
        'ordre',
        'actif'
    ];

    protected $casts = [
        'actif' => 'boolean',
        'ordre' => 'integer'
    ];

    /**
     * Scope pour les valeurs actives
     */
    public function scopeActif($query)
    {
        return $query->where('actif', true);
    }

    /**
     * Scope pour trier par ordre
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('ordre')->orderBy('created_at');
    }
}

