<?php
namespace App\Repositories;

use App\Http\Requests\NotificationStoreRequest;
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

    public function store($users,$id,$category_name)
    {
        foreach($users as $user){
            Notification::create([
               'user_id'=>$user,
               'type'=>' ',
               'notifiable_type'=>'App\Meme',
                'notifiable_id'=>$id,
                'data'=>$category_name
            ]);
        }
    }
}
