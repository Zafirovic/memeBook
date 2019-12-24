<?php

namespace App\Http\Controllers;
use App\Repository\UserRepository;
use App\User;
use Illuminate\Cache\Repository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $model;
    public function __construct(User $user)
    {
        $this->model=new Repository($user);
    }

    public function store(Request $request)
    {
        return $this->model->create($request->only($this->model->get()->fillable));
    }
    public function update(Request $request,$id)
    {
    }
}
