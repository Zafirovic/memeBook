<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\CommentRepositoryInterface;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    private $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function commentsForMeme($id)
    {
        $comments = $this->getByMeme($id);
        return view('category', $comments);
    }

    public function addComment(Request $comment)
    {
        $this->add($comment);
    }

    public function deleteComment($id)
    {
        $this->delete($id);
    }
}
