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

    public function addNotification($notification)
    {
        $notif = new Notification;  
        $notif->user_id = $notification->user_id;
        $notif->notificationable_id = $notification->notificationable_id;
        $notif->notificationable_type = $notification->notificationable_type;

        $notif->save();
    }

    public function deleteNotificationsForUser($userID)
    {
        $notifications = Notification::find('user_id', $userID)->all();

        $notifications->delete();
    }
}