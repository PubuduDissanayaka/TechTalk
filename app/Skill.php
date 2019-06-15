<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    public function userpro()
    {
        return $this->hasMany('App\UserProSkill');
    }
}
