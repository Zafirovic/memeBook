<?php
namespace App\Repositories;
use App\Category;
use App\Repositories\Interfaces\FavoritecategoryRepositoryInterface;
use App\Meme;
use App\User;

class FavoritecategoryRepository implements FavoritecategoryRepositoryInterface
{

    public function getCategory($id)
    {
       return FavoritecategoryRepositoryInterface::find($id);
    }

    public function all()
    {
        return FavoritecategoryRepositoryInterface::all();
    }


}
