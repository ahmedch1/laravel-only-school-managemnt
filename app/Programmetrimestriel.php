<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Programmetrimestriel extends Model
{
    protected $fillable=[
        'title',
        'name',
        'rate',
        'description'
    ];
}
