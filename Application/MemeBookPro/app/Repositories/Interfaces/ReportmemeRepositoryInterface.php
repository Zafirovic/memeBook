<?php
namespace App\Repositories\Interfaces;
use App\Category;
use App\Meme;
use App\User;

interface ReportmemeRepositoryInterface
{
    public function getReport($id);
    public function all();

}
