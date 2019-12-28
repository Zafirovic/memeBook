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
        $comments = $this->commentRepository->getByMeme($id);
        return view('comment', $comments);
    }

    public function addComment(Request $comment)
    {
        $this->commentRepository->add($comment);
    }

    public function deleteComment($id)
    {
        $this->commentRepository->delete($id);
    }
}
