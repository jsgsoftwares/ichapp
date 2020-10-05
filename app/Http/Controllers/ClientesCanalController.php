<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\clientes_chat;
use App\Clientes_canal;
use App\User;
use DB;
use Storage;
class ClientesCanalController extends Controller
{
    //
    public function index(Request $request)
    {

        $info=Clientes_canal::select('b.firstname','b.lastname','b.correo','b.nip','b.profesion')
                ->join('clientes_chats as b','clientes_canals.cliente_id', '=', 'b.id')
                ->where('clientes_canals.user_id',$request->contact_id)
                ->get();
               if(count($info)>0)
               {
                $data=[];
                $data['success'] = 'true';
                $data['message'] = $info[0];
                
                return $data; 
              
               }
               else {
                $data=[];
                $data['success'] = 'true';
                $data['message'] = '{firstname: null, lastname: null, correo: null, nip: null, profesion: null}';
                return $data;
                   
               }
                

    }
    public function canales(Request $request)
    {
        
        $buscar=Clientes_canal::select('cliente_id')
        ->where('user_id',$request->contact_id)
        ->get();
        if(count($buscar)>0)
        {
        $info=Clientes_canal::select('b.chat_id','b.rol_id','c.detalle','c.icon')
                ->join('users as b','clientes_canals.user_id', '=', 'b.id')
                ->join('canales as c','b.canal_id','=','c.id')
                ->where('clientes_canals.cliente_id',$buscar[0]->cliente_id)
                ->get();
                
                $data=[];
                $data['success'] = 'true';
                $data['message'] = $info;
                
                return $data;
        }
        else {
                
            $data=[];
            $data['success'] = 'true';
            $data['message'] = array(array('chat_id'=>null,'rol_id'=>null,'detalle'=>null,'icon'=>'/assets/icons/sinimagen.jpg'));
            return $data;
        }

    }
    public function canales_p(Request $request)
    {
        
        $buscar=Clientes_canal::select('cliente_id')
        ->where('user_id',$request->contact_id)
        ->get();
        if(count($buscar)>0)
        {
        $info=Clientes_canal::select('b.chat_id','b.rol_id','c.detalle','c.icon')
                ->join('users as b','clientes_canals.user_id', '=', 'b.id')
                ->join('canales as c','b.canal_id','=','c.id')
                ->where('clientes_canals.cliente_id',$buscar[0]->cliente_id)
                ->get();
                
                $data=[];
                $data['success'] = 'true';
                $data['message'] = $info;
                
                return $data;
        }
        else {
       
            $data=[];
            $data['success'] = 'true';
            $data['message'] = array(array('chat_id'=>null,'rol_id'=>null,'detalle'=>null,'icon'=>'/assets/icons/sinimagen.jpg'));
            return $data;
        }

    }
}
