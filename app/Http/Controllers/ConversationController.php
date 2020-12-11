<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Models\conversation;
use App\Models\Session;
class ConversationController extends Controller
{
    

    public function index()
    {

        $chat= DB::table('conversations')
            ->leftJoin('sessions', 'conversations.session_id', '=', 'sessions.id')
            ->join('users', 'conversations.contact_id', '=', 'users.id')
            ->join('users as agente', 'conversations.user_id', '=', 'agente.id')
            ->join('canales', 'users.canal_id', '=', 'canales.id')
            ->select(
            'conversations.id', 
            'conversations.contact_id', 
            'conversations.has_blocked', 
            'conversations.listen_notifications', 
            'conversations.last_message',
            'conversations.last_time',
            'users.name as contact_name',
            'agente.name as agente',
            'canales.icon as icon',
            'canales.id as interno'
            )
            ->where('conversations.user_id',auth()->id())
            ->where('sessions.state_id',2)
            ->whereNull('sessions.id');
          

            $union_data=DB::table('conversations')
            ->Join('sessions', 'conversations.session_id', '=', 'sessions.id')
            ->join('users', 'sessions.from_id', '=', 'users.id')
            ->join('users as agente', 'sessions.to_id', '=', 'agente.id')
            ->join('canales', 'users.canal_id', '=', 'canales.id')
            ->select(
            'conversations.id', 
            'users.id as contact_id', 
            'conversations.has_blocked', 
            'conversations.listen_notifications', 
            'conversations.last_message',
            'conversations.last_time',
            'users.name as contact_name',
            'agente.name as agente'
            ,'canales.icon as icon'
            ,'canales.id as interno')
            ->where('conversations.user_id',auth()->id())
            ->where('sessions.state_id',2)
            ->union($chat);

            return $union_data->orderBy('last_time', 'desc')->get();
       /*  return conversation::where('user_id',auth()->id())
        ->get([
            'id',
            'contact_id',
            'has_blocked',
            'listen_notifications',
            'last_message',
            'last_time'
        ]); */
    }

    public function Endconversations(Request $request)
    {
        return DB::table('sessions')
        ->where('from_id', $request->contact_id)
        ->update(['state_id' => 4,'flujo_id' => 1]);
        
        //return true;
       // $end=conversation::where('user_id',auth()->id());

    }




    public function prueba()
    {
        /*         $chat= DB::table('conversations')
        ->leftJoin('sessions', 'conversations.session_id', '=', 'sessions.id')
        ->join('users', 'conversations.contact_id', '=', 'users.id')
        ->select(
        'conversations.id', 
        'conversations.contact_id', 
        'conversations.has_blocked', 
        'conversations.listen_notifications', 
        'conversations.last_message',
        'conversations.last_time',
        'users.name as contact_name')
        ->where('conversations.user_id',auth()->id())
        ->whereNull('sessions.id');
      

        return DB::table('conversations')
        ->Join('sessions', 'conversations.session_id', '=', 'sessions.id')
        ->join('clientes_chats', 'sessions.from_id', '=', 'clientes_chats.id')
        ->select(
        'conversations.id', 
        'clientes_chats.chat_id as contact_id', 
        'conversations.has_blocked', 
        'conversations.listen_notifications', 
        'conversations.last_message',
        'conversations.last_time',
        'clientes_chats.nombre as contact_name')
        ->where('conversations.user_id',auth()->id())
        ->union($chat)
        ->get(); */
        
        $sessiones= collect(\DB::select("select x.id,sum(x.cantidad) cantidad,max(x.fecha)  from (
            SELECT a.`id`,
            if(b.id is null ,0,1) cantidad ,
            if(b.created_at is null,'2010-01-01 08:00:37',b.created_at) fecha
            FROM `users` A
            LEFT outer join 
            sessions b 
            on a.id=b.to_id and   b.state_id=2
            WHERE a.`inmessage`=1 and a.`state_id`= 2
                ) as x
           group by x.id
           order by cantidad,fecha
            LIMIT 1"))->first();

        dd($sessiones->id);
    


        
    }
}
