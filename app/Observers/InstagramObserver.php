<?php

namespace App\Observers;

use App\instagram;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\InstagramController;
use Storage;
class InstagramObserver
{
    /**
     * Handle the instagram "created" event.
     *
     * @param  \App\instagram  $instagram
     * @return void
     */
    public function created(instagram $instagram)
    {
        /* $delete=new instagramController();
        $delete->delete($instagram->id_message);
        Storage::disk('local')->put(date("YmdHi").'_twitterObserver.txt', json_encode($instagram)); */
        Storage::disk('local')->put(date("YmdHi").'_instagramObserver.txt', json_encode($instagram->id));
        $chat = new ChatController();
        $URL=env('APP_URL').'668803720/api/insta';

        $chat->verificar_status($URL, $instagram->id,
        $instagram->fullname,
        $instagram->user_id,
        1,
        $instagram->timestamp,
        $instagram->message,
        'instagram',
        '');
    
    }

  
    public function updated(instagram $instagram)
    {
        //
    }


    public function deleted(instagram $instagram)
    {
        //
    }
}