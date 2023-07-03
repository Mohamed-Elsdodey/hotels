<?php


namespace App\Http\Traits;


use Pusher\Pusher;

trait Notifications
{

    public function notify($count,$message,$logo,$sound)
    {
        $options = array(
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'encrypted' => true
        );
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $data['count'] = $count;
        $data['message'] = $message;
        $data['logo'] = $logo;
        $data['sound'] = $sound;


        $pusher->trigger('new-notification-channel', 'App\\Events\\NotificationEvent', $data);

    }
}


