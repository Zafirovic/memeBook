<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
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

    /*functions*/
    public function memes()
    {
        return $this->hasMany('App\Meme');
    }
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    public function reportMemes()
    {
        return $this->hasMany('App\Reportmeme');
    }
    public function notifications()
    {
        return $this->hasMany('App\Notification');
    }
    public function favoriteCategories()
    {
        return $this->hasMany('App\Favoritecategory');
    }
    public function editRequests()
    {
        return $this->hasMany('App\User');
    }

    public static function is_followed_category($category_id)
    {
        $followed=Favoritecategory::where([['category_id',$category_id],['user_id',auth()->user()->id]])->first();
        if($followed != null)
        {
            return true;
        }
        else
            return false;
    }
    public static function is_unfollowed_category($category_id)
    {
        $unfollowed=Favoritecategory::where([['category_id',$category_id],['user_id',auth()->user()->id]])->first();
        if($unfollowed!=null)
        {
            return false;
        }
        else
            return true;
    }
}
