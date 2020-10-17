<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\messages;
use App\Session;
use App\conversation;
use DB;
use Storage;
class MessageController extends Controller
{

    public function __construct()
    {
        // Necesitamos obtener una instancia de la clase Client la cual tiene algunos métodos
        // que serán necesarios.
        $this->dropbox = Storage::disk('dropbox')->getDriver()->getAdapter()->getClient();   
    }

    public function index(Request $request)
    {
        $userId=auth()->id();
    
        $contactId=$request->contact_id;

        if(isset($userId))
        {
         $mensajes_int = messages::select(
        'messages.id'
        ,DB::raw("IF(messages.`from_id`= $userId,1,0) as receptor")
        ,DB::raw("IF(messages.`from_id`= $userId,'info','light') as variant")
        ,'messages.from_id'
        ,'messages.to_id'
        ,'messages.created_at'
        ,'messages.content'
        ,'messages.tipo'
        ,DB::raw("IF(messages.`from_id`=a.id,ax.`icon`,bx.`icon`) as imagen")
        ,DB::raw("IF(messages.`from_id`=a.id,1,0) as interno")
        )
        ->join('users as a','a.id','=','messages.from_id')
        ->join('canales as ax','a.canal_id','=','ax.id')
        ->join('users as b','b.id','=','messages.to_id')
        ->join('canales as bx','b.canal_id','=','bx.id')
        ->where(function ($query) use($userId,$contactId) {
            $query->where('messages.from_id',$userId)
            ->where('messages.to_id',$contactId)
            ->whereNull('messages.session_id');
            
        })->orwhere(function ($query) use($userId,$contactId) {

            $query->where('messages.from_id',$contactId)
            ->where('messages.to_id',$userId)
            ->whereNull('messages.session_id');
        });
        
        $union_data=messages::select(
            'messages.id'
            ,DB::raw("IF(messages.`from_id`= $userId,1,0) as receptor")
            ,DB::raw("IF(messages.`from_id`= $userId,'info','light') as variant")
            ,'messages.from_id'
            ,'messages.to_id'
            ,'messages.created_at'
            ,'messages.content'
            ,'messages.tipo'
            ,DB::raw("IF(messages.`from_id`=a.id,ax.`icon`,bx.`icon`) as imagen")
            ,DB::raw("IF(messages.`from_id`=a.id,0,1) as interno")
            )
            ->leftJoin('sessions','sessions.id','=','messages.session_id')
            ->join('users as a','a.id','=','messages.from_id')
            ->join('canales as ax','a.canal_id','=','ax.id')
            ->join('users as b','b.id','=','messages.to_id')
            ->join('canales as bx','b.canal_id','=','bx.id')
            ->where(function ($query) use($userId,$contactId) {
                $query->where('messages.from_id',$userId)
                ->where('messages.to_id',$contactId)
                ->where('sessions.state_id',2);
                
            })->orwhere(function ($query) use($userId,$contactId) {
    
                $query->where('messages.from_id',$contactId)
                ->where('messages.to_id',$userId)
                ->where('sessions.state_id',2);
            })
            ->where('sessions.state_id',2)
            ->union($mensajes_int);
            

            return $union_data->orderBy('created_at')->get();
        
        }
        return json_encode(array('message'=>"error:no hay ningun usuario autenticado"));
    }


    public function store(Request $request)
    {
       try{
        $setsession=null;
        $session= DB::table('sessions')
        ->leftJoin('users', 'sessions.from_id', '=', 'users.id')
        ->select( 'users.chat_id','users.name','sessions.id')
        ->where('users.id',$request->to_id)
        ->where('sessions.state_id',2)
        ->first();

        if($session)
        {
            $setsession=$session->id;
        }
        
        $message = new messages();
        $message->from_id = auth()->id();
        $message->to_id = $request->to_id;
        $message->content =  $request->content;
        $message->session_id =  $setsession;
        $message->tipo=$request->tipo;
        $message->is_in=0;
        $saved = $message->save();
        //Storage::disk('local')->put(date("YmdHi").'_tipomensajes9.txt', ($message->tipo));
        $data=[];
        $data['success'] = $saved;
        $data['message'] = $message;





        return $data;
    }
    catch(Exception $e){

    }

    }

    public function buscar_conversation(Request $request)
    {
       /*  ,DB::raw("IF(messages.`from_id`= $userId,1,0) as receptor")
        ,DB::raw("IF(messages.`from_id`= $userId,'info','light') as variant") */
        $session=$request->id;
        $sesion_conversation=Session::find($session);
        if($sesion_conversation){
        $union_data=messages::select(
            'messages.id'
            ,DB::raw("IF(messages.`to_id`= $sesion_conversation->from_id,1,0) as receptor")
            ,DB::raw("IF(messages.`from_id`= $sesion_conversation->from_id,'info','light') as variant")
            ,'messages.from_id'
            ,'messages.to_id'
            ,'messages.created_at'
            ,'messages.content'
            ,DB::raw("IF(messages.`from_id`=$sesion_conversation->from_id,ax.`icon`,bx.`icon`) as imagen")
            ,DB::raw("IF(messages.`from_id`=$sesion_conversation->from_id,0,1) as interno")
            )
            ->leftJoin('sessions','sessions.id','=','messages.session_id')
            ->join('users as a','a.id','=','messages.from_id')
            ->join('canales as ax','a.canal_id','=','ax.id')
            ->join('users as b','b.id','=','messages.to_id')
            ->join('canales as bx','b.canal_id','=','bx.id')
            
            ->where('sessions.id',$session)
            ->get();

            return $union_data;
        }
        else
        {
            return null;  
        }
    }


    public function upload(Request $request){


    
        $path=$request->file('file')->store('public');
        $file = explode("/", $path);
        $json=[
            "imagen"=>$file[1],

        ];
        return $json;
    }
}
