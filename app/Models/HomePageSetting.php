<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomePageSetting extends Model
{
    protected $table = 'homepage_settings';
    
    protected $fillable = [
        'titre',
        'description',
        'background_type',
        'background_image_url',
        'background_video_url',
        'bouton_texte',
        'bouton_url'
    ];
}
