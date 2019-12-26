<?php 

namespace App\Repositories;

use App\Favoritecategory;
use App\Category;

use App\Repositores\Interfaces\FavcategoryRepositoryInterface;

class FavcategoryRepository implements FavcategoryRepositoryInterface
{
    public function allFavforUser($userID)
    {
        $favcategories = Favoritecategory::where('user_id')->all();
        $categories;
        foreach ($favcategories as $fav){
            $categories->pluck(Category::where('id') == $fav->category_id);
        }
        return $categories;
    }

    public function addFavorite($userID, $categoryID)
    {
        $favorite = new Favoritecategory;

        $favorite->user_id = $userID;
        $favorite->category_id = $categoryID;

        $favorite->save();
    }

    public function deleteFavorite($userID, $categoryID)
    {
        $favorite = Favoritecategory::where('user_id', $userID)->where('category_id', $categoryID)->first();
        $favorite->delete();
    }
}