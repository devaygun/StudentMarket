<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name', 'last_name', 'email', 'profile_picture', 'date_of_birth', 'password', 'distance_unit'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token',];

    public function items()
    {
        return $this->hasMany('App\Item');
    }

    public function messages()
    {
        return $this->hasMany('App\Message');
    }

    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

    public function getProfilePicture()
    {
        return asset($this->profile_picture ? "storage/$this->profile_picture" : 'images/default_profile.jpg');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
