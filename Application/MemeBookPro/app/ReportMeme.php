<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reportmeme extends Model
{
    protected $guarded=[];
    public function meme()
    {
        return $this->belongsTo('App\Meme');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
