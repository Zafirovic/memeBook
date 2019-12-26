<?php 

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function all();
    public function delete($userID);
}