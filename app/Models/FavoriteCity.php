<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoriteCity extends Model
{
    protected $table = 'favorite_cities';

    protected $fillable = [
        'user_id', 'place_id'
    ];

    protected $hidden = [];

    protected $casts = [
        'user_id' => 'integer',
        'place_id' => 'integer'
    ];
}
