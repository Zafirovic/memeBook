<?php
namespace App\Repositories;
use App\Category;
use App\Repositories\Interfaces\EditrequestRepositoryInterface;
use App\Repositories\Interfaces\MemeeRepositoryInterface;
use App\Meme;

class EditrequestRepository implements EditrequestRepositoryInterface

{

    public function getErequest($id)
    {
        return EditrequestRepository::find($id);
    }

    public function all()
    {
        return EditrequestRepository::all();
    }
}
