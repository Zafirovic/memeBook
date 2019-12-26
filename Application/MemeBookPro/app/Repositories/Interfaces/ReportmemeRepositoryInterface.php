<?php 

namespace App\Repositories\Interfaces;

interface ReportmemeRepositoryInterface
{
    public function all();
    public function getNumberOfReports($memeID);    //vraca broj reporta za meme ciji se id prosledi
}