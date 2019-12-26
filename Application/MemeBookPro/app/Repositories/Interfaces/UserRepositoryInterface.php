<?php 

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function allUsers();
    public function deleteUser($userID);
}