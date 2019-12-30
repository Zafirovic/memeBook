<?php
namespace App\Repositories;
use App\Category;
use App\Repositories\Interfaces\MemeeRepositoryInterface;
use App\Meme;
use App\Repositories\Interfaces\ReportmemeRepositoryInterface;
use App\User;
use App\Reportmeme;

class ReportmemeRepository implements ReportmemeRepositoryInterface
{

    public function getReport($id)
    {
        return Reportmeme::find($id);
    }

    public function all()
    {
        return Reportmeme::all();
    }


}
