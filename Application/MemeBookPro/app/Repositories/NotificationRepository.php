<?php
namespace App\Repositories;

use App\Repositories\Interfaces\NotificationRepositoryInterface;
use App\Notification;

class NotificationRepository implements NotificationRepositoryInterface
{

    public function getNotif($id)
    {
       return Notification::find($id);
    }

    public function all()
    {
        return Notification::all();
    }
}
