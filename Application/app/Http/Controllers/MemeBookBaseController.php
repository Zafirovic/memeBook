<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repository\IRepositories\MemeIRepository;
use App\Repository\IRepositories\UserIRepository;
use App\Repository\IRepositories\CategoryIRepository;
use App\Repository\IRepositories\VoteIRepository;
use App\Repository\IRepositories\EditRequestIRepository;
use App\Repository\IRepositories\MemeReportIRepository;

class MemeBookBaseController extends Controller
{
    protected $memeRepository;
    protected $userRepository;
    protected $categoryRepository;
    protected $voteRepository;
    protected $editRequestRepository;
    protected $memeReportRepository;

    public function __construct(UserIRepository $userRepository,
                                MemeIRepository $memeRepository,
                                CategoryIRepository $categoryRepository,
                                VoteIRepository $voteRepository,
                                EditRequestIRepository $editRequestRepository,
                                MemeReportIRepository $memeReportRepository)
    {
        $this->memeRepository = $memeRepository;
        $this->userRepository = $userRepository;
        $this->categoryRepository = $categoryRepository;
        $this->voteRepository = $voteRepository;
        $this->editRequestRepository = $editRequestRepository;
        $this->memeReportRepository = $memeReportRepository;
    }

    protected function fillMemeData($memes)
    {
        $auth_user = Auth::user();
        if ($memes instanceof LengthAwarePaginator)
        {
            foreach ($memes as $meme)
            {
                $meme->sourceImage = $this->checkImageSource($meme);
                $meme->votes = $this->voteRepository->getMemeVotesSum($meme->id);
                $meme->username = $this->userRepository->getUser($meme->user_id)->name;
                $meme->voted = $auth_user ? $this->voteRepository->votedMemeByUser($meme->id, $auth_user->id)
                                            : array('upvoted' => 'white', 'downvoted' => 'white');
            }
        }
        else
        {
            $memes->sourceImage = $this->checkImageSource($memes);
            $memes->votes = $this->voteRepository->getMemeVotesSum($memes->id);
            $memes->username = $this->userRepository->getUser($memes->user_id)->name;
            $memes->voted = $auth_user ? $this->voteRepository->votedMemeByUser($memes->id, $auth_user->id)
                                         : array('upvoted' => 'white', 'downvoted' => 'white');
        }
        return $memes;
    }

    private function checkImageSource($meme)
    {
        return strpos($meme->image, "imgflip") !== false ? $meme->image
                                                         : URL::to('/') . '/images/memes/' .  $meme->image;
    }
}
