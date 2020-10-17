<?php

namespace App\Observers;

use App\Webhook;
use App\Session;
use App\clientes_chat;
use App\conversation;
use App\messages;
use Carbon\Carbon;
use Storage;
use DB;
use App\Integracioneswebhook;
class WebhookObserver
{

    public function created(Webhook $webhook)
    {
        $date= Carbon::now()->format('Ymd');
        $sesion=Session::where('idkey',$date)
        ->where('from_id',$webhook->cliente_id)
        ->where('mytoken',$webhook->mytoken)
        ->where('state_id',2)
        ->first();
        $telegramUser=Integracioneswebhook::where('mytoken',$webhook->mytoken)->get();
        
        $companie=$telegramUser[0]->companie_id;
        

        $sessiones= collect(\DB::select("select x.id,sum(x.cantidad) cantidad,max(x.fecha)  from (SELECT a.`id`,if(b.id is null ,0,1) cantidad ,if(b.created_at is null,'2010-01-01 08:00:37',b.created_at) fecha FROM `users` as a LEFT outer join sessions as b  on a.id=b.to_id and   b.state_id=2 WHERE a.`inmessage`=1 and a.`state_id`= 2  and a.`companie_id`=".$companie." ) as x group by x.id,x.fecha order by cantidad,x.fecha LIMIT 1 "))->first();
      
        if(!isset($sesion))
        {
           
            $sesion=new Session;
            $max_id = $sesion->max('id');
            $sesion->num_sesion = ($max_id+1);
            $sesion->idkey=$date;
            $sesion->from_id=$webhook->cliente_id;
            $sesion->to_id=$sessiones->id;
            $sesion->mytoken=$webhook->mytoken;
            $sesion->flujo_id=1;
            $sesion->state_id=2;
            $sesion->save();     
        }
        $chat = DB::table('users')->where('id', $webhook->cliente_id)->first();
      
        
        if($sesion->flujo_id==3){
            
        $max_id = $sesion->id;
        $message = new messages();
        $message->from_id = $chat->id;
        $message->to_id = $sesion->to_id;
        $message->session_id=$max_id;
        $message->content = $webhook->mensaje;
        $message->tipo = $webhook->tipo;
        $message->save();
       
        return 1;
        }

    }

    public function updated(Webhook $webhook)
    {
        //
    }


    public function deleted(Webhook $webhook)
    {
        //
    }

}