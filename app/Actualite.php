<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actualite extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'actualite_code',
        'description',
    ];
}
