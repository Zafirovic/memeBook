<?php 

namespace App\Repositories;

use App\Reportmeme;
use App\Meme;
use App\Repositores\Interfaces\ReportmemeRepositoryInterface;

class ReportmemeRepository implements ReportmemeRepositoryInterface
{
    public function all()
    {
        $memes = Meme::all();
    }

    public function getNumberOfReports($memeID)
    {
        $countreports = Reportmeme::where('meme_id', $memeID)->count();
        return $countreports;
    }
}