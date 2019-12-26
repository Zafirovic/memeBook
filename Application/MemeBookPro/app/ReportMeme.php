<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reportmeme extends Model
{
    public function user()
    {
        return $this->belongsTo('App/User');
    }

    public function meme()
    {
        return $this->belongsTo('App/Meme');
    }
}
