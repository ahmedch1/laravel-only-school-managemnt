<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hebdo extends Model
{
    protected $fillable=[
        'name',
        'link',
        'description'
    ];
}
