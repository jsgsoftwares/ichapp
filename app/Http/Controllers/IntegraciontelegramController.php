<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Integraciontelegram;
use App\Models\Companie;
use App\Models\User;
use Telegram\Bot\Api;
class IntegraciontelegramController extends Controller
{
    
    function store(Request $request){

            $usuario=User::where('id',$request->user_id)->first();
            $companie=Companie::where('id',$usuario->companie_id)->first();

            $integra=new Integraciontelegram();
            $integra->token=$request->token;
            $integra->enabled=0;
            $integra->companie_id=$companie->id;
            $integra->mytoken=str_random(50);
            $integra->createBy=$request->user_id;
            $integra->save();

    }
    function UpdateTokenTelegram(Request $request){

        $usuario=User::where('id',$request->user_id)->first();
        Integraciontelegram::where('companie_id',$usuario->companie_id)
                            ->update(['token'=>$request->token]); 
       
        $integraTelegram=IntegracionTelegram::where('companie_id',$usuario->companie_id)
        ->first();

        $this->telegram = new Api($integraTelegram->token);
        $url = env('APP_URL').'/api/v1/'.$integraTelegram->companie_id.'/'.$integraTelegram->mytoken;
        $response = $this->telegram->setWebhook(['url' => $url]);
    
        //cambiar
        $json=[
            "status"=>"success"
        ];
        return $json;
    }
    function habilitarDesabilitarTelegram(Request $request){

        $usuario=User::where('id',$request->user_id)->first();
        $integraTelegram=Integraciontelegram::where('companie_id',$usuario->companie_id)
                            ->update(['enabled'=>$request->enabled]); 

        $json=[
            "status"=>"success"
        ];

        return $json;
    }

    function getmessages($companieId,$mytoken,Request $request){
      
     /*    $usuario=User::where(chat_id)

        dd($request->message['from']['id']); */
    }
    function mensajeTexto(){

    }
    function mensajeImagen(){
        
    }
    function mensajeDocumento(){
        
    }
    function mensajeVideo(){
        
    }
    function mensajeAudio(){
        
    }
    function mensajeLocacion(){
        
    }
    function mensajeContacto(){
        
    }



}
