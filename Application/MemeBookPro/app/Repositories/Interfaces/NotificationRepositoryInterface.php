<?php 

namespace App\Repositories\Interfaces;

use App\Notification;

interface NotificationRepositoryInterface
{
    public function getNotificationsForUser($userID);
    public function addNotification($notification);
    public function deleteNotificationsForUser($userID);
}