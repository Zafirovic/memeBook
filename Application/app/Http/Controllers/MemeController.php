<?php

namespace App\Http\Controllers;

use Session;
use App\Meme;
use App\ImageHelper;
use Illuminate\Http\Request;
use App\Http\Requests\MemeRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class MemeController extends MemeBookBaseController
{
    public function index()
    {
        $allMemes = $this->memeRepository->getAllMemes();
        $categories = $this->categoryRepository->getCategories();
        $memes = $this->fillMemeData($allMemes);

        return view('index')->with(compact('memes', 'categories'));
    }

    public function categoryIndex($category_id)
    {
        $allMemes = $this->memeRepository->getAllMemesForCategory($category_id);
        $categories = $this->categoryRepository->getCategories();
        $memes = $this->fillMemeData($allMemes);

        return view('meme.show')->with(compact('memes', 'categories'));
    }

    public function userIndex($user_id)
    {
        $allMemes = $this->memeRepository->getAllMemesForUser($user_id);
        $categories = $this->categoryRepository->getCategories();
        $memes = $this->fillMemeData($allMemes);

        return view('meme.show-content')->with(compact('memes', 'categories'));
    }

    public function singleMeme($meme_id)
    {
        $singleMeme = $this->memeRepository->getMeme($meme_id);
        $meme = $this->fillMemeData($singleMeme);

        return view('meme.single')->with('meme', $meme);
    }

    public function create()
    {
        $apiData = json_decode(file_get_contents('https://api.imgflip.com/get_memes'), true);
        $apiMemeImages = $apiData['data']['memes'];
        $categories = $this->categoryRepository->getCategories();
        return view('meme.create', compact('apiMemeImages', 'categories'));
    }

    public function store(MemeRequest $request)
    {
        if ($request->ajax()) {
            $message = $this->memeRepository->addApiMeme($request);
            return response()->json(['url' => route('memes.index')]);
        }
        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $img_name = ImageHelper::CreateImage($request->file('image'), 'images/memes');
            $message = $this->memeRepository->addMeme($request, $img_name);
        }
        return redirect(route('memes.index'))->with($message);
    }

    public function edit($meme_id)
    {
        $meme = $this->memeRepository->getMeme($meme_id);
        return view('meme.edit')->with(compact('meme'));
    }

    public function update(MemeRequest $request, $meme_id)
    {
        $validated = $request->validated();
        $message = $this->memeRepository->updateMeme($request, $meme_id);

        return redirect(route('memes.index'))->with($message);
    }

    public function destroy($meme_id)
    {
        $message = $this->memeRepository->deleteMeme($meme_id);
        return redirect(route('memes.index'))->with($message);
    }

    public function vote(Request $request)
    {
        return $this->voteRepository->voteMeme($request->meme_id, Auth::user()->id, $request->vote);
    }
}
