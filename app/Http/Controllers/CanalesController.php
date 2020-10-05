<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Auth;
class CanalesController extends Controller
{
   
    public function user()
    {
        if(isset(Auth::user()->name))
        {
        return json_encode(array("name"=>Auth::user()->name));
        }
        else
        {
            return json_encode(array("name"=>""));
        }
    }
}
