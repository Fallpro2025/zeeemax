<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'nom_site',
        'logo_url',
        'description_site',
        'email',
        'telephone',
        'adresse',
        'ville',
        'code_postal',
        'pays',
        'facebook',
        'twitter',
        'instagram',
        'linkedin',
        'youtube',
        'tiktok'
    ];
}
