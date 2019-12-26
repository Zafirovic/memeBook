<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favoritecategory extends Model
{
    public function user()
    {
        return $this->belongsTo('App/User');
    }

    public function memeCategory()
    {
        return $this->hasMany('App/Category');
    }
}
