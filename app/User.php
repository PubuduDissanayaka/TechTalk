<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;



class User extends \TCG\Voyager\Models\User implements MustVerifyEmail
{
    use Notifiable;
    // use Friendable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function blogpost()
    {
        return $this->hasMany('App\BlogPost');
    }


    public function events()
    {
        return $this->hasMany('App\Event');
    }

    public function blogcomments()
    {
        return $this->hasMany(BlogComment::class , 'id' ,'post_id');
    }

    public function friendsOfMine()
    {
        return $this->belongsToMany('App\User', 'friends', 'user_id', 'friend_id');
    }

    public function friendOf()
    {
        return $this->belongsToMany('App\User', 'friends',  'friend_id', 'user_id');
    }

    public function friends(){
        return $this->friendsOfMine->merge($this->friendOf);
    }

    public function cource()
    {
        return $this->hasMany('App\Cource');
    }

    public function detail()
    {
        return $this->hasOne('App\UserDetail');
    }

    public function study()
    {
        return $this->hasMany('App\Study');
    }

    public function studycomments()
    {
        return $this->hasMany('App\StudyComment');
    }

    public function studyratings()
    {
        return $this->hasMany('App\StudyRating');
    }

    public function feeds()
    {
        return $this->hasMany('App\NewsFeed');
    }

    public function feedcomments()
    {
        return $this->hasMany('App\NewsFeedComment');
    }

    public function friend()
    {
        return $this->hasMany('App\Friend','user_id');
    }

    public function friend1()
    {
        return $this->hasMany('App\Friend', 'friend_id');
    }

    public function stars()
    {
        return $this->hasMany('App\UserRating');
    }

    public function skills()
    {
        return $this->hasMany('App\UserProSkill');
    }
}
