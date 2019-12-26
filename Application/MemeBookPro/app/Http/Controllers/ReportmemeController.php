<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\ReportmemeRepositoryInterface;
use Illuminate\Http\Request;

class ReportmemeController extends Controller
{
    private $reportmemeRepository;

    public function __construct(ReportmemeRepositoryInterface $reportmemeRepository)
    {
        $this->reportmemeRepository = $reportmemeRepository;
    }

    public function numberOfReports($memeID)
    {
        $reports = $this->getNumberOfReports($memeID);
        return view('reportmeme', $reports);
    }

    public function getAllMemes()
    {
        $memes = $this->all();
        return view('memes', $memes);
    }
}
