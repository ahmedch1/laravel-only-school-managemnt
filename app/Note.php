<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable=[
        'title',
        'user_id',
        'rate',
        'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
