<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $fillable = [
        'email',
        'prenom',
        'nom',
        'source',
        'actif',
        'unsubscribed_at',
    ];

    protected $casts = [
        'actif' => 'boolean',
        'unsubscribed_at' => 'datetime',
    ];
}


