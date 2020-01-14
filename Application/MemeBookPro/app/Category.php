<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded=[];
    public function memes()
    {
        return $this->hasMany('App\Meme');
    }
    public function follows_category()
    {
        return $this->belongsToMany(User::class,'favoritecategories','category_id','user_id');
    }
}
