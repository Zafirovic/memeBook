<?php

namespace App\Observers;

use App\Notifications\MemeAdded;
use App\Meme;
use App\Category;

class MemeObserver
{
    public function created(Meme $meme)
    {
        $category=$meme->category;
        foreach ($category->follows_category as $follower) {
            $follower->notify(new MemeAdded($follower,$meme));
        }
    }
}
