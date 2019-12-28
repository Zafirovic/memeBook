<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\NotificationRepositoryInterface;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    private $notificationRepository;

    public function __construct(MemeRepositoryInterface $notificationRepository)
    {
        $this->notificationRepository = $notificationRepository;
    }

    public function allNotifications($userID)
    {
        $notifications = $this->notificationRepository->getNotificationsForUser($userID);
        return view('notifications', $notifications);
    }

    public function add(Request $notification)
    {
        $this->notificationRepository->addNotification($notification);
    }

    public function delete($userID)
    {
        $this->notificationRepository->deleteNotificationsForUser($userID);
    }

}
