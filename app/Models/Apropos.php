<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apropos extends Model
{
    protected $fillable = [
        'titre',
        'description',
        'image_url'
    ];
}
