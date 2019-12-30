<?php
namespace App\Repositories;
use App\Category;
use App\Repositories\Interfaces\MemeeRepositoryInterface;
use App\Meme;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\User;

class UserRepository implements UserRepositoryInterface
{

    public function getUser($id)
    {
        return User::find($id);
    }

    public function all()
    {
        return User::all();
    }
}
