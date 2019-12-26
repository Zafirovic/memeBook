<?php 

namespace App\Repositories;

use App\User;
use App\Repositores\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function allUsers()
    {
        $users = User::all();
        return $users;
    }

    public function deleteUser($userID)
    {
       $user = User::find($userID);
       $user->delete();
    }
}