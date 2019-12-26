<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use Notifiable;

    public function comment()
    {
        return $this->hasMany('App/Comment');
    }

    public function notifications()
    {
        return $this->hasMany('App/Notifications');
    }

    public function favoriteCategories()
    {
        return $this->hasMany('App/Favoritecategory');
    }

    public function meme()
    {
        return $this->hasMany('App/Meme');
    }

    public function reports()
    {
        return $this->hasMany('App/Reportmeme');
    }

    public function editrequest()
    {
        return $this->hasMany('App/Editrequest');
    }

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
}
