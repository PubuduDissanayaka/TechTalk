<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProSkill extends Model
{
    public function skill()
    {
        return $this->belongsTo('App\Skill');
    }
}
