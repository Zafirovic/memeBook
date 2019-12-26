<?php 

namespace App\Repositories\Interfaces;

interface FavcategoryRepositoryInterface
{
    public function allFavforUser($userID); //vracamo sve omiljene kategorije za usera
    public function addFavorite($userID, $categoryID);
    public function deleteFavorite($userID, $categoryID);
}