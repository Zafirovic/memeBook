<?php


namespace App\Repositories\Interfaces;
use App\User;

interface UserRepositoryInterface
{
    public function getUser($id);
    public function all();

}
