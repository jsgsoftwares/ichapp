<?php

namespace App\Http\Controllers;
use App\subscriptionproducts;
use App\User;
use App\Companie;
use Illuminate\Http\Request;

class SubscriptionproductsController extends Controller
{
    //

    function subscriptions($userid){
        $usuario=User::where('id',$userid)->first();
        $companie=Companie::where('id',$usuario->companie_id)->first();
            $sub=subscriptionproducts::where('companie_id',$companie->id)->get();
            return($sub);
            }
}
