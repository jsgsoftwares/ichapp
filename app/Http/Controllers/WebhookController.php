<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Webhook;
use App\User;
use Storage;
use App\Canales;
use DB;
use Carbon\Carbon;

class WebhookController extends Controller
{

    
    public function receptor($request)
    {
        
       
		$canal=$request['message']['canal'];
		$para=$request['message']['receptor'];
		$me_id=$request['message']['message_id'];
		$from_id=$request['message']['from']['id'];
		$nombre=$request['message']['from']['nombre'];
		$mensaje=$request['message']['mensaje'];
        $fecha=$request['message']['date'];
        $tipo=$request['message']['tipo'];
        $proveedor=$request['message']['proveedor'];
        $mytoken=$request['message']['mytoken'];
        //SE GUARDA EL MENSAJE RECIBIDO EN WEBHOOK
 
        $chat = DB::table('users')->where('chat_id', $from_id)->first();
        $tipo_canal= DB::table('canales')->where('detalle',$canal)->first();
       
        $webhook = new Webhook;
        $webhook->cliente_id=$chat->id;
        $webhook->canal_id=$tipo_canal->id;
        $webhook->mensaje=$mensaje;
        $webhook->tipo=$tipo;
        $webhook->mytoken=$mytoken;
        $webhook->save();
       
        if ($webhook->save()) {
           $getkeyMensaje=$webhook->id;
       }
 
      
       $date= Carbon::now()->format('Ymd');
       $session = DB::table('sessions')
       ->join('users', 'sessions.from_id', '=', 'users.id')
       ->select('sessions.flujo_id')
       ->where('users.chat_id', $from_id)
       ->where('sessions.idkey',$date)
       ->where('sessions.mytoken',$mytoken)
       ->where('sessions.state_id',2)
       ->first();
      

        if($session->flujo_id==1){
       
            $b = new ControlController();
        
            $b->envio($canal,$from_id,$mensaje,$getkeyMensaje,$proveedor,$tipo,$mytoken,1);
        }elseif($session->flujo_id==2){
       
            $b = new FlujomoduleController();
            $b->resp($canal,$from_id,$mensaje,$getkeyMensaje,$proveedor,$tipo);

        }
        exit;
        return parent::handle($request, $next);
	

		
		
    }
    public function fecha(){
        return Carbon::now();
        
    }

    public function entradas(Request $request){
       
        $id=now()->timestamp;
        $created =now()->timestamp;
        
        $entro=0;
        $infor='';
        if($request->originalDetectIntentRequest['source']=='facebook')
        {
            $entro=1;
            $to_id=$request->originalDetectIntentRequest['payload']['data']['recipient']['id'];
            $from_id=$request->originalDetectIntentRequest['payload']['data']['sender']['id'];
            $nombre='Usuario facebook';
            $canal=$request->originalDetectIntentRequest['source'];
            $mensaje=$request->originalDetectIntentRequest['payload']['data']['message']['text'];
            $infor='messenger';
            
        }
        elseif($request->originalDetectIntentRequest['source']=='telegram')
        {
            $entro=1;
            $to_id=env('TELEGRAM_BOT_TOKEN');
            $from_id=$request->originalDetectIntentRequest['payload']['data']['chat']['id'];
            $nombre=$request->originalDetectIntentRequest['payload']['data']['from']['first_name'].' '.$request->originalDetectIntentRequest['payload']['data']['from']['last_name'];
            $canal=$request->originalDetectIntentRequest['source'];
            $mensaje=$request->originalDetectIntentRequest['payload']['data']['text'];
            $infor='telegram';
            
        }
        elseif(isset($request->app)=="voixbot")
        {
            
            $entro=1;
            $to_id=$request->app;
            $from_id=$request->payload['source'];
            $nombre="Whatsapp user";
            $canal='whatsapp';
            $mensaje=$request->payload['payload']['text'];
            $infor='dialog';
            
        }
        else
        {
            $entro=0;
            Storage::disk('local')->put(date("YmdHi").'_nueva_red.txt', ($request->app));
      
        }
        if($entro==1)
        {
            
            $tipo='nada'; 
            $chat = new ChatController();
            $URL=env('APP_URL').'668803720/webhook';
            $chat->verificar_status($URL, $id,$nombre,$from_id,$to_id,$created,$mensaje,$canal,$tipo,$infor);
          
        }
        

    }

    public function chagestate()
    {
        
    }


}
