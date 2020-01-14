<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\NotificationStoreRequest;
use App\Notification;
use App\Meme;


interface NotificationRepositoryInterface
{
    public function getNotif($id);
    public function all();
    public function store($users,$notification,$category_name);
}
