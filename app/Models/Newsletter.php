<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    protected $table = 'blog_posts';

    protected $fillable = [
        'titre',
        'slug',
        'extrait',
        'categorie',
        'contenu',
        'image_couverture',
        'publie',
        'publie_le',
    ];

    protected $casts = [
        'publie' => 'boolean',
        'publie_le' => 'datetime',
    ];
}


