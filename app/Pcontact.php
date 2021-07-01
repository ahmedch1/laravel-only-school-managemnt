<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pcontact extends Model
{
    protected $fillable=[
        'user_id',
        'subject',
        'message'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
