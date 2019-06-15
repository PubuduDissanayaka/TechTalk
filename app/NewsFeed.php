<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsFeed extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function comments()
    {
        return $this->hasMany('App\NewsFeedComment', 'feed_id');
    }

    public function likes()
    {
        return $this->hasMany('App\NewsFeedLike');
    }
}
