<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Twitter extends Model
{
    protected $table = 'twitters';
    protected $fillable = ['type', 'id_message', 'created_timestamp', 'recipient_id','sender_id','content', 'created_at', 'updated_at'];


}
