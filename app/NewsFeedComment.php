<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsFeedComment extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function feed()
    {
        return $this->belongsTo('App\NewsFeed');
    }
}
