<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Meme extends Model
{
    use Notifiable;
    protected $guarded=[];
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    public function editRequests()
    {
        return $this->hasMany('App\Editrequest');
    }
    public function reports()
    {
        return $this->hasMany('App\Reportmeme');
    }

}
