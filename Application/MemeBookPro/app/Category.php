<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function favoriteCategory()
    {
        return $this->belongsTo('App/Favoritecategory');
    }

    public function meme()
    {
        return $this->hasMany('App/Meme');
    }
}
