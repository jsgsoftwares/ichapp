<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class messages extends Model
{
    
    protected $casts=[
            'receptor'=>'boolean'
    ];
}
