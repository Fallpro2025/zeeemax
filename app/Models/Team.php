<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table = 'team';
    
    protected $fillable = [
        'nom',
        'poste',
        'bio',
        'photo_url',
        'reseau_social',
        'ordre',
        'actif'
    ];
    
    protected $casts = [
        'actif' => 'boolean',
        'reseau_social' => 'array'
    ];
}
