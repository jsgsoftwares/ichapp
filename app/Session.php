<?php

namespace App;
use App\clientes_chat;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
   
/*     protected $appends=['chat_id'];

    public function getChatIdAttribute()
    {
       
        return $this->cliente()->first(['chat_id'])->from_id;
    }

    public function cliente()
    {
        return $this->belongsTo(clientes_chat::class);
    } */

}
