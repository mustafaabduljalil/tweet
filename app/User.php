<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','birth_date','image'
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

    /**
     * Get user's tweets.
     *
     * @var array
     */
    public function tweets()
    {
        return $this->hasMany('App\Tweet');
    }


    /**
     * Get user's followers.
     *
     * @var array
     */
    public function followers()
    {
        return $this->belongsToMany('App\User','user_follower','following_id','user_id');
    }

    /**
     * Get user's following.
     *
     * @var array
     */
    public function following()
    {
        return $this->belongsToMany('App\User','user_follower','user_id','following_id');
    }

    /**
     * Get user's image with full path.
     *
     * @var array
     */
    public function getImageAttribute($value)
    {
        return !is_null($value) ? url($value) : null;
    }

}
