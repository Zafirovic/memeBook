<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\EditrequestRepositoryInterface;

use Illuminate\Http\Request;

class EditrequestController extends Controller
{
    private $editrequestRepository;

    public function __construct(EditrequestRepositoryInterface $editrequestRepository)
    {
        $this->editrequestRepository = $editrequestRepository;
    }

    public function allUserRequests($userID)
    {
        $editrequests = $this->editrequestRepository->getEditrequestsForUser($userID);
        return view('editrequests', $editrequests);
    }

    public function allMemeRequests($memeID)
    {
        $editrequests = $this->editrequestRepository->getEditrequestsForMeme($memeID);
        return view('editrequests', $editrequests);
    }

    public function UserID($editID)
    {
        $username = $this->editrequestRepository->getUserID($editID);
        return view('meme', $username);
    }

    public function add(Request $editRequest)
    {
        $this->editrequestRepository->addRequest($editRequest);
    }

    public function delete($id)
    {
        $this->editrequestRepository->deleteRequest($id);
    }
}
