<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\FavcategoryRepositoryInterface;

use Illuminate\Http\Request;

class FavoritecategoryController extends Controller
{
    private $favcategoryRepository;

    public function __construct(FavcategoryRepositoryInterface $favcategoryRepository)
    {
        $this->favcategoryRepository = $favcategoryRepository;
    }

    public function allFavforUser($userID)
    {
        $categories = $this->favcategoryRepository->allFavforUser($userID);
        return view('favcategory', $categories);
    }

    public function add($userID, $categoryID)
    {
        $this->favcategoryRepository->addFavorite($userID, $categoryID);
    }

    public function removeFavorite($userID, $categoryID)
    {
        $this->favcategoryRepository->deleteFavorite($userID, $categoryID);
    }

}
