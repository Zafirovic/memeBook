<?php 

namespace App\Repositories\Interfaces;

use App\Notification;

interface NotificationRepositoryInterface
{
    public function getNotificationsForUser($userID);
}