<?php

namespace App\Repositories\Interfaces;

use App\Notification;
use App\Meme;

interface NotificationRepositoryInterface
{
    public function getNotif($id);
    public function all();
}
