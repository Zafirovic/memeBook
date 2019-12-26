<?php 

namespace App\Repositories;

use App\Notification;
use App\Repositores\Interfaces\NotificationRepositoryInterface;

class NotificationRepository implements NotificationRepositoryInterface
{
    public function getNotificationsForUser($userID)
    {
        return Notification::where('user_id', $userID)->all();
    }
}