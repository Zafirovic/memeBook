<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use App\Comment;
use App\Meme;

class CommentController extends Controller
{
    protected $commentRepository;
    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository=$commentRepository;
    }
    public function detail($meme_id)
    {
        $meme=Meme::find($meme_id);
        $comments=$this->commentRepository->getByMeme($meme);
    }

    //
//    public function index()
//    {
//        $comments=$this->commentRepository->all();
//        return view('')
//    }
}
