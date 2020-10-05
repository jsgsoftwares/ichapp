<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Webhook;
use App\Dialogflow;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Controllers\FlujomoduleController;
use Illuminate\Support\Facades\Storage;

class FullfillmentController extends Controller
{
    protected $arreglo;
    public function Fulfillment(Request $request)
    {
        Storage::disk('local')->put(date("YmdHis").'_fullfillment.txt', $request);
        $date= Carbon::now()->format('Ymd');
      
        if(isset($request->result['metadata']['intentId']))
        {
           
        $idproceso=$request->result['metadata']['intentId'];
        $idname=$request->result['metadata']['intentName'];
        $mensaje="-----";
        $usuario= $request->sessionId;
        }
        elseif(isset($request->queryResult['intent']))
        {
            
            $idproceso=substr(strstr($request->queryResult['intent']['name'], 'intents/'),8);
            
            $idname=$request->queryResult['intent']['displayName'];
            $mensaje=$request->queryResult['queryText'];
            $usuario= substr(strstr($request->session, 'sessions/'),9);
            $outputContexts=$request->queryResult;
        }
        
        

    

        $intend=Dialogflow::where('intentId',$idproceso)->get();
       
        if(count($intend)<1)
        {
            
        $intentNew = new Dialogflow;
        $intentNew->intentName=$idname;
        $intentNew->intentId=$idproceso;
        $intentNew->save();
        }
        


        $flujo=DB::table('fullfillments')
		->select('fullfillments.flujo_id')
        ->where('fullfillments.intentId', $idproceso)->first();
   
    

        $session = DB::table('sessions')
		->join('users', 'sessions.from_id', '=', 'users.id')
		->select('sessions.flujo_id','sessions.mytoken','sessions.id','users.canal_id','users.id as user_id')
        ->where('users.chat_id', $usuario)
        ->where('sessions.idkey', $date)
        ->where('sessions.state_id',2)
        ->first();
       
        
        DB::table('sessions')
        ->where('id', $session->id)
        ->update(['flujo_id' => $flujo->flujo_id]);

        
        if($flujo->flujo_id==3)
        {
           
            $webhook = new Webhook;
            $webhook->cliente_id=$session->user_id;
            $webhook->canal_id= $session->canal_id;
            $webhook->tipo= 'texto';
            $webhook->mytoken= $session->mytoken;
            $webhook->mensaje="Nueva sesion numero : ".$session->id.' Mensaje: '.$mensaje;
            $webhook->save();
        }
        elseif($flujo->flujo_id==2)
        {
            
        
            $b = new FlujomoduleController();
            $b->index($idproceso,$session->user_id,$session->id,$outputContexts);
           
            //$b.hook($intend);
        }
      


        exit;
        return parent::handle($request, $next);
       // 
        //Storage::disk('local')->put(date("YmdHi").'_fullfillment.txt', $request);
    }



}
