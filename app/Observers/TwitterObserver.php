<?php

namespace App\Observers;

use App\Twitter;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\TwitterController;
use Storage;
class TwitterObserver
{
    /**
     * Handle the Twitter "created" event.
     *
     * @param  \App\Twitter  $Twitter
     * @return void
     */
    public function created(Twitter $twitter)
    {
        $delete=new TwitterController();
        $delete->delete($twitter->id_message);
        //Storage::disk('local')->put(date("YmdHi").'_twitterObserver.txt', json_encode($twitter));
        $chat = new ChatController();
        $URL=env('APP_URL').'668803720/twitter';
        $chat->verificar_status($URL, $twitter->id_message,
        'Usuario twitter',
        $twitter->sender_id,
        $twitter->recipient_id,
        $twitter->created_at,
        $twitter->content,
        'twitter',
        '');
    
    }

  
    public function updated(Twitter $twitter)
    {
        //
    }


    public function deleted(Twitter $twitter)
    {
        //
    }
}