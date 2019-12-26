<?php 

namespace App\Repositories\Interfaces;

use App\Meme;

interface MemeRepositoryInterface
{
    public function getMemes();
    public function getMeme($memeID);
    public function getUpvotes($memeID);
    public function getDownvotes($memeID);
    public function addMeme($meme);
    public function deleteMeme($memeID);
    public function updateMeme($memeID, $meme);
}