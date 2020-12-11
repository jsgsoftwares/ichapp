<?php

namespace App\Http\Controllers;

use App\Models\flujomodule;
use App\Models\acciones_modulo;
use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\FlujomoduleController;
use App\Http\Controllers\EvopartsModuloController;
use App\Models\Integracioneswebhook;
use App\Models\Integracionwaping;
use App\Models\Integracionbotflow;
use Storage;
use App\Models\Webhook;
use App\Models\Canales;
use Carbon\Carbon;
use GuzzleHttp;
class FlujomoduleController extends Controller
{

  public function index($intend,$user_id,$session,$contexto){

        $this->intento=$intend;
        $desde=$user_id;
        $this->sesion=$session;
        $this->contextos=$contexto['outputContexts'];
        $this->querytext=$contexto['queryText'];
        
        $date= Carbon::now()->format('Ymd');

        $session = DB::table('sessions')
        ->join('users', 'sessions.from_id', '=', 'users.id')
        ->select('sessions.flujo_id','sessions.mytoken','sessions.id','users.canal_id','users.id as user_id','users.chat_id as user_chatid')
        ->where('users.id', $desde)
        ->where('sessions.idkey', $date)
        ->where('sessions.state_id',2)
        ->first();
        
        $canal_u=Canales::where('id',$session->canal_id)->first();
        $canal=$canal_u->detalle;
     

        $telegramUser=Integracioneswebhook::where('mytoken',$session->mytoken)->get();
        
        $compania=$telegramUser[0]->companie_id;
        $token=$telegramUser[0]->token;
    
       
 
        $webhook=flujomodule::where('companie_id',$compania)->first();
        $url=$webhook->webhook.'/'.$this->intento;
       
        if($intend=='6a3965d5-f83b-4f96-946c-313eeb058211'){
          $this->querytext=$contexto['outputContexts'][0]['parameters']['person.original'];
        }
        //dd($contexto['outputContexts'][0]['parameters']['identificaciones.original']);
       

        
        $repuesta=$this->enviowebhook($url, $this->querytext,$session->user_chatid,$compania);
        $re=json_decode($repuesta);
        $mensaje=$re->mensaje;
        $idmensaje=0;
        $tipo="texto";
        $desde=$session->user_chatid;

        $sendtelegram= new TelegramController();
        $sendfacebook= new FacebookController();
        $sendwaboxapp= new WapingController();
        $sendtwitter= new TwitterController();


        DB::table('sessions')
        ->where('id', $session->id)
        ->update(['flujo_id' => 1]);

        sleep(8);
        if($canal=='telegram'){
          $sendtelegram->sendMessage($token,$mensaje,$desde,$tipo);
        }elseif($canal=='facebook'){
          $sendfacebook->sendMessage($token,$mensaje,$desde,$idmensaje,$tipo);
        }elseif($canal=='whatsapp'){ 
          //Storage::disk('local')->put(date("YmdHi").'_tipomensajes10.txt', ($tip));
          $sendwaboxapp->sendMessage($telegramUser[0],$mensaje,$desde,$idmensaje,$tipo);
        }elseif($canal=='twitter'){
          $sendtwitter->sendMessage($desde,$mensaje);
        }elseif($canal=='instagram'){
          $sendinstagram->sendMessage($desde,$mensaje);
        }
    }

    public function resp($canal,$desde,$mensaje,$idmensaje,$proveedor,$tipo)
    {
      
  
         $date= Carbon::now()->format('Ymd');
  
         $session = DB::table('sessions')
         ->join('users', 'sessions.from_id', '=', 'users.id')
         ->select('sessions.flujo_id','sessions.mytoken','sessions.id','users.canal_id','users.id as user_id')
         ->where('users.chat_id', $desde)
         ->where('sessions.idkey', $date)
         ->where('sessions.state_id',2)
         ->first();
       
      $telegramUser=Integracioneswebhook::where('mytoken',$session->mytoken)->get();
      
      $compania=$telegramUser[0]->companie_id;
      $token=$telegramUser[0]->token;
  
       
      $webhook=flujomodule::where('companie_id',$compania)->first();

      //dd($webhook->webhook);
      
      $repuesta=$this->enviowebhook($webhook->webhook, $mensaje,$desde,$compania);
      
  
      $sendtelegram= new TelegramController();
      $sendfacebook= new FacebookController();
      $sendwaboxapp= new WapingController();
      $sendtwitter= new TwitterController();
      $sendinstagram= new InstagramController();
      
      
  
      if($canal=='telegram'){
        $sendtelegram->sendMessage($token,$mensaje,$desde,$tipo);
      }elseif($canal=='facebook'){
        $sendfacebook->sendMessage($token,$mensaje,$desde,$idmensaje,$tipo);
      }elseif($canal=='whatsapp'){ 
        //Storage::disk('local')->put(date("YmdHi").'_tipomensajes10.txt', ($tip));
        $sendwaboxapp->sendMessage($telegramUser[0],$mensaje,$desde,$idmensaje,$tipo);
      }elseif($canal=='twitter'){
        $sendtwitter->sendMessage($desde,$mensaje);
      }elseif($canal=='instagram'){
        $sendinstagram->sendMessage($desde,$mensaje);
      }
     
  
  
    
    
      
      
    }
  

    public function enviowebhook($url,$mensaje,$para,$companieId){
      $json_d=[
        'mensaje'=>$mensaje,
        'from'=>$para,
        'type'=>'text',
        'companie'=>$companieId
        
      ];


          $client = new GuzzleHttp\Client();
          $res= $client->request('get',$url,[
              'json'=>$json_d
      
            ]);
          $response=$res->getBody();
         
          return $response;
    }



  
  
}
 