<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Integracioneswebhook;
use App\Integracionbotflow;
use App\Companie;
use App\wapingtoken;
use App\User;
use Illuminate\Http\UploadedFile;
use Telegram\Bot\Api;
use Storage;
class IntegracioneswebhookController extends Controller
{

    function store(Request $request){

        $usuario=User::where('id',$request->user_id)->first();
        $companie=Companie::where('id',$usuario->companie_id)->first();

        $integra=Integracioneswebhook::where('companie_id',$usuario->companie_id)
        ->where('canal',$request->canal)
        ->first();

        
        if(!$integra){
            $integra=new Integracioneswebhook();
            $integra->token=$request->token;
            $integra->enabled=0;
            $integra->companie_id=$companie->id;
            $integra->phone=$request->phone;
            $integra->canal=$request->canal;
            $integra->verify=$request->verify;
            $integra->mytoken=str_random(50);
            $integra->createBy=$request->user_id;
            $integra->start=0;
            $integra->save();
        }
     //cambiar
     $web=env('APP_URL').'/api/v1/integrations/messenger/webhook/'.$integra->companie_id.'/'.$integra->mytoken;
            $json=[
                "status"=>"success",
                "webhook"=>$web
            ];
            return $json;


    }

    function UpdateTokenTelegram(Request $request){
        $url="";
        $usuario=User::where('id',$request->user_id)->first();
        $companie=Companie::where('id',$usuario->companie_id)->first();
        $status="";
        $integracion_webhook=Integracioneswebhook::where('companie_id',$usuario->companie_id)
        ->where('canal',2)
        ->first();
        if($integracion_webhook){
            Integracioneswebhook::where('companie_id',$usuario->companie_id)
                ->where( 'canal',2)
                ->update([
                'token'=>$request->token,
                'enabled'=>$request->enabled,
                'start'=>$request->start
                    ]); 
            $integra=Integracioneswebhook::where('companie_id',$usuario->companie_id)
                ->where('token',$request->token)
                ->where( 'canal',2)
                ->first();
            $telegram = new Api($request->token);

            if($request->enabled==1){
                $url = env('APP_URL').'/api/v1/integrations/telegram/webhook/'.$integra->companie_id.'/'.$integra->mytoken;
                $response = $telegram ->setWebhook(['url' => $url]);
            }elseif($request->enabled==0){
                $response = $telegram->removeWebhook();
            }
            $status="Update";
        }else{
            $integra=new Integracioneswebhook();
            $integra->token=$request->token;
            $integra->enabled=1;
            $integra->companie_id=$companie->id;
            $integra->phone=0;
            $integra->canal=2;
            $integra->start=$request->start;
            $integra->verify="";
            $integra->mytoken=str_random(50);
            $integra->createBy=$request->user_id;
            $integra->save();
            $status="create";
        }

        //cambiar
        $json=[
            "status"=>$status,
            "webhook"=>$url
        ];
        return $json;
    }
    function UpdateTokenFacebook(Request $request){

        $url="";
        $usuario=User::where('id',$request->user_id)->first();
        $companie=Companie::where('id',$usuario->companie_id)->first();
        $status="";
        $integracion_webhook=Integracioneswebhook::where('companie_id',$usuario->companie_id)
        ->where('canal',4)
        ->first();
        if($integracion_webhook){
            Integracioneswebhook::where('companie_id',$usuario->companie_id)
                ->where( 'canal',4)
                ->update([
                    'token'=>$request->token,
                    'enabled'=>$request->enabled,
                    'verify'=>$request->verify,
                    'start'=>$request->start
                    ]); 
            $integra=Integracioneswebhook::where('companie_id',$usuario->companie_id)
                ->where('token',$request->token)
                ->where( 'canal',4)
                ->first();
                $url=env('APP_URL').'/api/v1/integrations/messenger/webhook/'.$integra->companie_id.'/'.$integra->mytoken;
            $status="Update";
        }else{
            $integra=new Integracioneswebhook();
            $integra->token=$request->token;
            $integra->enabled=1;
            $integra->companie_id=$companie->id;
            $integra->phone=0;
            $integra->canal=4;
            $integra->verify="";
            $integra->start=$request->start;
            $integra->mytoken=str_random(50);
            $integra->createBy=$request->user_id;
            $integra->save();
            $status="create";
            $url=env('APP_URL').'/api/v1/integrations/messenger/webhook/'.$integra->companie_id.'/'.$integra->mytoken;
        }

        //cambiar
        $json=[
            "status"=>$status,
            "webhook"=>$url
        ];
        return $json;





    }
    function UpdateDialogFlow(Request $request){
        $url="";
        $usuario=User::where('id',$request->user_id)->first();
        $companie=Companie::where('id',$usuario->companie_id)->first();
        $status="";
        $integracion_webhook=Integracionbotflow::where('companie_id',$usuario->companie_id)
        ->where('canal_id',7)
        ->first();
        if($integracion_webhook){
            Integracionbotflow::where('companie_id',$usuario->companie_id)
                ->where( 'canal_id',7)
                ->update([
                    'filename'=>$request->filename,
                    'project_id'=>$request->project_id,
                    'enabled'=>$request->enabled,
                    'start'=>$request->start,
                    'token'=>''
                    
                    ]); 
            $integra=Integracionbotflow::where('companie_id',$usuario->companie_id)
                ->where( 'canal_id',7)
                ->first();
                $url=env('APP_URL').'/api/v1/integrations/dialogflow/webhook/'.$integra->companie_id.'/'.$integra->mytoken;
            $status="Update";
        }else{

            $integra=new Integracionbotflow();
            $integra->token='';
            $integra->filename=$request->filename;
            $integra->project_id=$request->project_id;
            $integra->bot_id=1;
            $integra->companie_id=$companie->id;
            $integra->enabled=$request->enabled;
            $integra->start=$request->start;
            $integra->createBy=$request->user_id;
            $integra->mytoken=str_random(50);
            $integra->canal_id=7;
            $integra->save();
            $status="create";
            $url=env('APP_URL').'/api/v1/integrations/messenger/webhook/'.$integra->companie_id.'/'.$integra->mytoken;
        }
               //cambiar
               $json=[
                "status"=>$status,
                "webhook"=>$url
            ];
            return $json;

    }
    function UpdateTokenWaping(Request $request){
        $url="";
        $usuario=User::where('id',$request->user_id)->first();
        $companie=Companie::where('id',$usuario->companie_id)->first();
        $status="";
        $integracion_webhook=Integracioneswebhook::where('companie_id',$usuario->companie_id)
        ->where('canal',3)
        ->first();
        if($integracion_webhook){
            Integracioneswebhook::where('companie_id',$usuario->companie_id)
                ->where( 'canal',3)
                ->update([
                    'enabled'=>$request->enabled,
                    'phone'=>$request->phone,
                    'pais_id'=>$request->pais_id,
                    'start'=>$request->start,
                    'phone_code'=>$request->phone_code
                    ]); 
            $integra=Integracioneswebhook::where('companie_id',$usuario->companie_id)
                ->where('companie_id',$usuario->companie_id)
                ->where( 'canal',3)
                ->first();
            $url=env('APP_URL').'/api/v1/integrations/messenger/webhook/'.$integra->companie_id.'/'.$integra->mytoken;
            $status="Update";
        }
        else{

            $waping=wapingtoken::where('companie_id',$companie->id)->first();
            $integra=new Integracioneswebhook();
            $integra->enabled=1;
            $integra->companie_id=$companie->id;
            $integra->phone=$request->phone;
            $integra->phone_code=$request->phone_code;
            $integra->pais_id=$request->pais_id;
            if($waping){
                
                $integra->token=$waping->token;
            
            }
            else{
                $wapingtoken=wapingtoken::where('companie_id',1)->where('disponible',1)->where('enabled',1)->first();
                
                $integra->token=$wapingtoken->token;
                wapingtoken::where('id',$wapingtoken->id)
                ->update([
                    'disponible'=>0,
                    'companie_id'=>$companie->id,
                    ]);
               
            }

            $integra->canal=3;
            $integra->verify="";
            $integra->start=$request->start;
            $integra->mytoken=str_random(50);
            $integra->createBy=$request->user_id;
            $integra->save();
            $status="create";
            $url=env('APP_URL').'/api/v1/integrations/messenger/webhook/'.$integra->companie_id.'/'.$integra->mytoken;
        
        }

        //cambiar
        $json=[
            "status"=>$status,
            "webhook"=>$url
        ];
        return $json;
    }
    function getIntegracion(Request $request){
       
        $usuario=User::where('id',$request->user_id)->first();
        
        $companie=Companie::where('id',$usuario->companie_id)->first();
        $status="";
        $integracion_telegram=Integracioneswebhook::where('companie_id',$usuario->companie_id)
        ->where('canal',2)
        ->first(); 
        $integracion_waping=Integracioneswebhook::where('companie_id',$usuario->companie_id)
        ->where('canal',3)
        ->first(); 
        //FACEBOOK
        $integracion_f=Integracioneswebhook::where('companie_id',$usuario->companie_id)
        ->where('canal',4)
        ->first();
        if($integracion_f){
            $url = env('APP_URL').'/api/v1/integrations/messenger/webhook/'.$integracion_f->companie_id.'/'.$integracion_f->mytoken;
                
            $integracion_facebook=[
                "id"=>$integracion_f->id,
                "token"=>$integracion_f->token,
                "enabled"=>$integracion_f->enabled,
                "start"=>$integracion_f->start,
                "companie_id"=>$integracion_f->companie_id,
                "mytoken"=>$integracion_f->mytoken,
                "verify"=>$integracion_f->verify,
                "canal"=>$integracion_f->canal,
                "webhook"=>$url
            ];
        }else{$integracion_facebook=null;}
        $integracion_twitter=Integracioneswebhook::where('companie_id',$usuario->companie_id)
        ->where('canal',5)
        ->first(); 
        $integracion_instagram=Integracioneswebhook::where('companie_id',$usuario->companie_id)
        ->where('canal',6)
        ->first(); 
        $integracion_dialog=Integracionbotflow::where('companie_id',$usuario->companie_id)
        ->where('canal_id',7)
        ->first(); 
        $json=[
            "telegram"=>$integracion_telegram,
            "waping"=>$integracion_waping, 
            "facebook"=>$integracion_facebook,
            "twitter"=>$integracion_twitter,
            "instagra,"=>$integracion_instagram,
            "dialogflow"=>$integracion_dialog,
        ];

        

        return $json;
    }
    public function upload(Request $request){
    
        
                
                $path=$request->file('file')->store('public');
                $file = explode("/", $path);
              
                $json=[
                    "imagen"=>$file[1],

                ];
                return $json;
    }
    function obtenerTokenWaping(Request $request){

       

     
            $numero = explode("@", str_replace('"','',$request->numero)); 
        

        $integracion_webhook=Integracioneswebhook::where('phone_code',$numero[0])->first();
        if($integracion_webhook){
                $integracion_=[
                    "id"=>$integracion_webhook->id,
                    "token"=>$integracion_webhook->token,
                    "enabled"=>$integracion_webhook->enabled,
                    "mytoken"=>$integracion_webhook->mytoken,

                ];
         }else{
            $integracion_=[
                "error"=>"no found token"];
         }
        return $integracion_;
    }
    


}
