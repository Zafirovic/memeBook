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
        $memes = $this->memeRepository->getMemes();
        return view('meme', $memes);
    }

    public function meme($id)
    {
        $meme = $this->memeRepository->getMeme($id);
        return view('meme', $meme);
    }

    public function upvotes($id)
    {
        $up = $this->memeRepository->getUpvotes($id);
        return view('meme', $up);
    }

    public function downvotes($id)
    {
        $down = $this->memeRepository->getDownvotes($id);
        return view('meme', $down);
    }

    public function add(Request $meme)
    {
        $this->memeRepository->addMeme($meme);
    }

    public function delete($memeID)
    {
        $this->memeRepository->deleteMeme($memeID);
    }

    public function update(Request $meme, $memeID)
    {
        $this->memeRepository->updateMeme($memeID, $meme);
    }
}
