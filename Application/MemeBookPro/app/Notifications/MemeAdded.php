<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\User;
use App\Meme;

class MemeAdded extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $meme;
    protected $users;
    public function __construct(User $users,Meme $meme)
    {
        $this->meme=$meme;
        $this->users=$users;
    }

    public function toDatabase($notifiable)
    {
        return [
            'user_id' => $this->users->id,
            'username' => $this->users->username,
            'meme_id' => $this->meme->id,
        ];
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {

        return ['database','broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
//    public function toArray($notifiable)
//    {
//
//        return [
//            'id'=>$this->id,
//            'read_at'=>null,
//            'data'=>[
//                'meme_id'=>$this->meme->id,
//                'user_id' => $this->users->id,
//                'username' => $this->users->username,
//            ]
//        ];
//    }
}
