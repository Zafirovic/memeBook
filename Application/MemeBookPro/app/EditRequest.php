<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Editrequest extends Model
{
    public function meme()
    {
        return $this->hasOne('App/Meme');
    }

    public function user()
    {
        return $this->belongsTo('App/User');
    }
}
