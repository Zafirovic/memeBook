<?php 

namespace App\Repositories;

use App\Meme;
use App\Repositores\Interfaces\MemeRepositoryInterface;

class MemeRepository implements MemeRepositoryInterface
{
    public function getMemes()
    {
        return Meme::all();
    }

    public function getMeme($memeID)
    {
        return Meme::where('id', $memeID)->first();
    }

    public function getUpvotes($memeID)
    {
        $meme = Meme::where('id', $memeID)->first();
        return $meme->upvotes;
    }

    public function getDownvotes($memeID)
    {
        $meme = Meme::where('id', $memeID)->first();
        return $meme->downvotes;
    }

    public function addMeme($meme)
    {
        $mim = new Meme;
        $mim->user_id = $meme->user_id;
        $mim->category_id = $meme->category_id;
        $mim->upvotes = $meme->upvotes;
        $mim->downvotes = $meme->downvotes;
        $mim->image = $meme->image;
        $mim->title = $meme->title;
        $mim->text = $meme->text;

        $mim->save();
    }

    public function deleteMeme($memeID)
    {
        $meme = Meme::find($memeID);
        $meme->delete();
    }

    public function updateMeme($memeID, $meme)
    {
        $mim = Meme::find($memeID);

        $mim->user_id = $meme->user_id;
        $mim->category_id = $meme->category_id;
        $mim->upvotes = $meme->upvotes;
        $mim->downvotes = $meme->downvotes;
        $mim->image = $meme->image;
        $mim->title = $meme->title;
        $mim->text = $meme->text;

        $mim->save();
    }
}