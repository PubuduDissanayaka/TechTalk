<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsFeedLike extends Model
{
    public function newsfeed()
    {
        return $this->belongsTo('App\NewsFeed');
    }
}
