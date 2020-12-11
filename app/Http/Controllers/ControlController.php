<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Session;
use DB;
use App\Models\User;
use App\Models\Integracioneswebhook;
use App\Models\Integracionwaping;
use App\Models\Integracionbotflow;
use App\Models\subscriptionproducts;
use Storage;
use Carbon\Carbon;
use App\Models\Webhook;
class ControlController extends Controller
{
    
    public function index()
    {
    	
    }
	
	public function envio($canal,$desde,$mensaje,$idmensaje,$proveedor,$tipo,$token,$in)
	{
		

		   $date= Carbon::now()->format('Ymd');

		   $session = DB::table('sessions')
		   ->join('users', 'sessions.from_id', '=', 'users.id')
		   ->select('sessions.flujo_id','sessions.mytoken','sessions.id','users.canal_id','users.id as user_id')
		   ->where('users.chat_id', $desde)
		   ->where('sessions.idkey', $date)
		   ->where('sessions.mytoken',$token)
		   
		   ->where('sessions.state_id',2)
		   ->first();

		$telegramUser=Integracioneswebhook::where('mytoken',$session->mytoken)->get();
		
		$compania=$telegramUser[0]->companie_id;
		$token=$telegramUser[0]->token;

	
		

		$sendtelegram= new TelegramController();
		$sendfacebook= new FacebookController();
		$sendwaboxapp= new WapingController();
		$sendtwitter= new TwitterController();
		$sendinstagram= new InstagramController();
		$botApi=Integracionbotflow::where('companie_id',$compania)->get();
		$sub=subscriptionproducts::where('companie_id',$compania)
        ->where('product_id',2)
        ->where('enabled',1)
        ->get();
		
			if(($session->flujo_id==1 and $botApi[0]->enabled==1 and $sub)){
			
				$resp = new DialogflowController();
				$info=$resp->conversacion($canal,$token,$desde,$mensaje,$idmensaje,$proveedor,$compania);
				
				
			}elseif($session->flujo_id==1 and $botApi[0]->enabled==0){
			
				DB::table('sessions')
				->where('id', $session->id)
				->update(['flujo_id' => 3]);
				$webhook = new Webhook;
				$webhook->cliente_id=$session->user_id;
				$webhook->canal_id= $session->canal_id;
				$webhook->mytoken= $session->mytoken;
				$webhook->tipo= 'texto';
				$webhook->mensaje="Nueva sesion numero : ".$session->id.' Mensaje: '.$mensaje;
				$webhook->save();
				
			}
			elseif($session->flujo_id==3 && $in==1){
			
	
				$webhook = new Webhook;
				$webhook->cliente_id=$session->user_id;
				$webhook->canal_id= $session->canal_id;
				$webhook->mytoken= $session->mytoken;
				$webhook->tipo= 'texto';
				$webhook->mensaje=$mensaje;
				$webhook->save();
				
			}
			
			else{
				//Storage::disk('local')->put(date("YmdHi").'_tipomensajes10.txt', 'aqui');
				
				if($canal=='telegram'){
					$sendtelegram->sendMessage($token,$mensaje,$desde,$tipo);
				}elseif($canal=='facebook'){
					$sendfacebook->sendMessage($token,$mensaje,$desde,$idmensaje,$tipo);
				}elseif($canal=='whatsapp'){ 
					$sendwaboxapp->sendMessage($telegramUser[0],$mensaje,$desde,$idmensaje,$tipo);
				}elseif($canal=='twitter'){
					$sendtwitter->sendMessage($desde,$mensaje);
				}elseif($canal=='instagram'){
					$sendinstagram->sendMessage($desde,$mensaje);
				}
			}
		
	


	
	
		
		
	}

}
