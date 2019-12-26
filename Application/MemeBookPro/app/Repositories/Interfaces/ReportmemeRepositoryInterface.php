<?php 

namespace App\Repositories\Interfaces;

interface ReportmemeRepositoryInterface
{
    public function getNumberOfReports($memeID);    //vraca broj reporta za meme ciji se id prosledi
    public function addReport($report);
}