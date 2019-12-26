<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meme extends Model
{
    public function user()
    {
        return $this->belongsTo('App/User');
    }

    public function memeCategory()
    {
        return $this->belongsTo('App/Category');
    }

    public function editRequest()
    {
        return $this->belongsTo('App/Editrequest');
    }

    public function comment()
    {
        return $this->hasMany('App/Comment');
    }

    public function reportMeme()
    {
        return $this->hasMany('App/Reportmeme');
    }
}
