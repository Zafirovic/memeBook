<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\MemeRepositoryInterface;

use Illuminate\Http\Request;

class MemeController extends Controller
{
    private $memeRepository;

    public function __construct(MemeRepositoryInterface $memeRepository)
    {
        $this->memeRepository = $memeRepository;
    }

    public function index()
    {
        $memes = $this->getMemes();
        return view('meme', $memes);
    }

    public function meme($id)
    {
        $meme = $this->getMeme($id);
        return view('meme', $meme);
    }

    public function upvotes($id)
    {
        $up = $this->getUpvotes($id);
        return view('meme', $up);
    }

    public function downvotes($id)
    {
        $down = $this->getDownvotes($id);
        return view('meme', $down);
    }
}
