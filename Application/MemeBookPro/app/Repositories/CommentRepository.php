<?php
namespace App\Repositories;

use App\Meme;
use App\Comment;
use App\Repositories\Interfaces\CommentRepositoryInterface;

class CommentRepository implements CommentRepositoryInterface
{

    public function all()
    {
        return Comment::all();
    }

}
