<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trim extends Model
{
    protected $fillable=[
        'name',
        'link',
        'description'
    ];
}
