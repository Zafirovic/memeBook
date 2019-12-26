<?php 

namespace App\Repositories\Interfaces;

use App\Editrequest;
use App\User;
use App\Meme;

interface EditrequestRepositoryInterface
{
    public function getEditrequestsForUser($userID); //vracamo sve requeste koje je user poslao
    public function getEditrequestsForMeme($memeID); //vracamo sve requeste za dati meme
    public function getUserID($editID);              //vraca id user-a koji zahteva request
    public function addRequest($request);
    public function deleteRequest($id);
}