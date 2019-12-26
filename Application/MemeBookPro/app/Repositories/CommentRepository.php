<?php 

namespace App\Repositories;

use App\Comment;
use App\Meme;
use App\Repositores\Interfaces\CommentRepositoryInterface;

class CommentRepository implements CommentRepositoryInterface
{
    public function getByMeme($memeID)
    {
        return Comment::where('meme_id', $memeID)->all();
    }

    public function add($comment)
    {
        $comm = new Comment;

        $comm->text = $comment->text;
        $comm->meme_id = $comment->meme_id;
        $comm->user_id = $comment->user_id;

        $comm->save();
    }

    public function delete($id)
    {
        $comm = Comment::find($id);
        $comm->delete();
    }
}