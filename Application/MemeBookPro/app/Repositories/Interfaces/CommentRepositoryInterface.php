<?php 

namespace App\Repositories\Interfaces;

use App\Comment;
use App\Meme;

interface CommentRepositoryInterface
{
    public function getByMeme($memeID);
    public function add($comment);
    public function delete($id);
}