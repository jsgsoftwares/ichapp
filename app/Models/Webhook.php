<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Webhook extends Model
{

    /* protected $appends=['chat_id'];

    public function getChatIdAttribute()
    {
       
        return $this->cliente()->first(['id'])->chat_id;
    }

    public function cliente()
    {
        return $this->belongsTo(User::class);
    } */
  
}
