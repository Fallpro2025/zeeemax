<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'nom',
        'type',
        'logo_url',
        'actif',
        'ordre'
    ];

    protected $casts = [
        'actif' => 'boolean',
        'ordre' => 'integer'
    ];

    /**
     * Scope pour récupérer uniquement les clients actifs
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
