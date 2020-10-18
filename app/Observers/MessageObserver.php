<?php

namespace App\Observers;
use App\Events\MessageSent;
use App\Events\MessageWasapp;
use App\messages;
use App\Session;
use App\Http\Controllers\ControlController;
use App\conversation;
use DB;

use Storage;
class MessageObserver
{
    /**
     * Handle the Message "created" event.
     *
     * @param  \App\Message  $message
     * @return void
     */
    public function created(messages $message)
    {
        
        
        if(isset($message->session_id) && $message->session_id!=null)// SI LA SESSION VIENE DEL API WEBHOON
        {
            $id_chat= DB::table('sessions')
            ->leftJoin('users', 'sessions.from_id', '=', 'users.id')
            ->select( 'users.id','users.name')
            ->where('sessions.id',$message->session_id)
            ->where('sessions.state_id',2)
            ->first();

           $conversation=conversation::where('session_id',$message->session_id)
                            ->first();
            $session_de_usuario=Session::where('id',$message->session_id)->first();
            
            if($conversation)// SI YA TIENE UNA SESSION CREADA EN CONVERSATION
            {
                $this->save_conversation_api($message,$id_chat->id);
                $this->respuesta_red($message,$id_chat->id,$session_de_usuario);
                
            }
            else // SI no TIENE UNA SESSION CREADA EN CONVERSATION
            {
                $this->create_conversation($message,$id_chat->id);
                $this->save_conversation_api($message,$id_chat->id);
            }

        }
        else// SI LA SESSION VIENE DEL CHAT DIRECTO
        {
            $this->save_conversation_chat($message);
        }
 
  


     

 
        event(new MessageSent($message));
    }

    public function save_conversation_chat($message)
    {

        
            
            $conversation=conversation::where('user_id',$message->from_id)
            ->where('contact_id',$message->to_id)
            ->first();
           
            if($conversation)
            {
            $conversation->last_message="Tu: $message->content";
            $conversation->last_time=$message->created_at;
            $conversation->save();
            }


            $conversation=conversation::where('contact_id',$message->from_id)
            ->where('user_id',$message->to_id)
            ->first();
     
            if($conversation)
            {
            $conversation->last_message="$conversation->contact_name: $message->content";
            $conversation->last_time=$message->created_at;
            $conversation->save();
            }


    }
    public function save_conversation_api($message,$id_chat)
    {
        
        $conversation=conversation::where('user_id',$message->from_id)
        ->where('contact_id',$message->to_id)
        ->where('session_id',$message->session_id)
        ->first();
        
        if($conversation)
        {
        $conversation->last_message="Tu: $message->content";
        $conversation->last_time=$message->created_at;
        $conversation->save();
       
        }


        $conversation=conversation::where('contact_id',$message->from_id)
        ->where('user_id',$message->to_id)
        ->where('session_id',$message->session_id)
        ->first();

        if($conversation)
        {

        $conversation->last_message="user: $message->content";
        $conversation->last_time=$message->created_at;
        $conversation->save();
        
        }
    }
    public function create_conversation($message,$id_chat)
    {


        
            $conversation1=new conversation;
            $conversation1->user_id=$id_chat;
            $conversation1->contact_id=$message->to_id;
            $conversation1->last_message="Tu: $message->content";
            $conversation1->last_time=$message->created_at;
            $conversation1->session_id=$message->session_id;
            $conversation1->save();


            $conver2=new conversation;
            $conver2->user_id=$message->to_id;
            $conver2->contact_id=$id_chat;
            $conver2->last_message="$conver2->contact_name: $message->content";
            $conver2->last_time=$message->created_at;
            $conver2->session_id=$message->session_id;
            $conver2->save(); 


        
    }

    public function respuesta_red($message,$user_id,$session_de_usuario)
    {
        

        $validar=messages::where('to_id',$user_id)
        ->where('session_id',$message->session_id)
        ->where('id',$message->id)
        ->first();

       
        if($validar)
        {
            $usuario_response= DB::table('sessions')
            ->leftJoin('users', 'sessions.from_id', '=', 'users.id')
            ->Join('canales', 'canales.id', '=', 'users.canal_id')
            ->select( 'users.chat_id','canales.detalle as canal','sessions.mytoken')
            ->where('sessions.id',$message->session_id)
            ->where('sessions.state_id',2)
            ->first();
           
            $b = new ControlController();
            $b->envio($usuario_response->canal,$usuario_response->chat_id,$message->content,$message->id,'',$message->tipo,$usuario_response->mytoken,$message->is_in);
    
        }
        


    }



}