<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IntegracionwapingController extends Controller
{
    function store(Request $request){

        $usuario=User::where('id',$request->user_id)->first();
        $companie=Companie::where('id',$usuario->companie_id)->first();

        $integra=new Integracionwaping();
        $integra->token=$request->token;
        $integra->phone=$request->phone;
        $integra->enabled=0;
        $integra->companie_id=$companie->id;
        $integra->mytoken=str_random(50);
        $integra->createBy=$request->user_id;
        $integra->save();

}
function UpdateTokenTelegram(Request $request){

    $usuario=User::where('id',$request->user_id)->first();
    Integracionwaping::where('companie_id',$usuario->companie_id)
                        ->update(['token'=>$request->token,'phone'=>$request->phone]);       
    $integraTelegram=Integracionwaping::where('companie_id',$usuario->companie_id)
    ->first();

   // $this->telegram = new Api($integraTelegram->token);
   // $url = env('APP_URL').'/api/v1/'.$integraTelegram->companie_id.'/'.$integraTelegram->mytoken;
   // $response = $this->telegram->setWebhook(['url' => $url]);

    //cambiar
    $json=[
        "status"=>"success"
    ];    return $json;
}

function habilitarDesabilitarTelegram(Request $request){

    $usuario=User::where('id',$request->user_id)->first();
    $integraTelegram=Integracionwaping::where('companie_id',$usuario->companie_id)
                        ->update(['enabled'=>$request->enabled]); 

    $json=[
        "status"=>"success"
    ];

    return $json;
}


}
