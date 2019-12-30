<?php
namespace App\Repositories\Interfaces;
use App\Meme;
use App\Editrequest;

interface EditrequestRepositoryInterface
{
    public function getErequest($id);
    public function all();
}
