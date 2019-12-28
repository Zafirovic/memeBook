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
        $reports = $this->reportmemeRepository->getNumberOfReports($memeID);
        return view('reportmeme', $reports);
    }

    public function add(Request $report)
    {
        $this->reportmemeRepository->addReport($report);
    }
}
