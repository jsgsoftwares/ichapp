<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Events\MessageWasapp;
use GuzzleHttp;
class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public function __construct($message)
    {
        $this->message=$message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
               // Create a client with a base URI
       /*  $client = new GuzzleHttp\Client(['base_uri' => 'https://api.telegram.org/bot269874330:AAG1SvGkRFs8x26AxP80KM9cFqOuzvp0d-M/']);     
        $response = $client->request('GET', 'sendMessage?chat_id=249997265&text=message>>'.$this->message->content); */
        //return new PrivateChannel('users.'.$this->message->to_id);
       
        return new Channel('users.'.$this->message->to_id);
    }
}
