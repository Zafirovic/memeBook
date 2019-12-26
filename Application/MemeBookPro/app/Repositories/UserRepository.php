<?php 

namespace App\Repositories;

use App\User;
use App\Repositores\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function all()
    {
        $users = User::all();
    }

    public function delete($userID)
    {
       $user = User::find($userID);
       $user->delete();
    }
}