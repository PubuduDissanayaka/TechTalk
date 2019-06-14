<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    protected $fillable = [
        'user_id', 'friend_id'
    ];

    public function user1()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function user2()
    {
        return $this->belongsTo('App\User','friend_id');
    }
}
