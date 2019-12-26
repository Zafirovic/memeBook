<?php 

namespace App\Repositories;

use App\Editrequest;
use App\User;
use App\Meme;
use App\Repositores\Interfaces\EditrequestRepositoryInterface;

class EditrequestRepository implements EditrequestRepositoryInterface
{
    public function getEditrequestsForUser($userID)
    {
        $editrequests = App\Editrequest::where('user_id', $userID)->all();
        return $editrequests;
    }

    public function getEditrequestsForMeme($memeID)
    {
        $editrequests = App\Editrequest::where('meme_id', $memeID)->all();
        return $editrequests;
    }

    public function getUserID($editID)
    {
        $user = App\Editrequest::where('id', $editID)->first();
        return $user->username;
    }

    public function addRequest($editRequest)
    {
        $eRequest = new Editrequest;

        $eRequest->user_id = $editRequest->user_id;
        $eRequest->meme_id = $editRequest->meme_id;

        $eRequest->save();
    }

    public function deleteRequest($id)
    {
        $eReq = Editrequest::find($id);
        $eReq->delete();
    }
}