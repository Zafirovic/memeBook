<?php
namespace App\Repositories\Interfaces;
use App\Category;
use App\Http\Requests\MemeStoreRequest;
use App\Meme;

interface MemeeRepositoryInterface
{
    public function all(); //return all memes
    public function store(MemeStoreRequest $request);

}
