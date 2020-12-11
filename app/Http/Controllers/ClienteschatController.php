<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\clientes_chat;
use App\Models\Clientes_canal;
use App\Models\User;
use DB;
use Storage;
class ClienteschatController extends Controller
{
    
    public function index(Request $request)
    {
        $name=[];
        $userId=auth()->id();
        $usuario=User::where('id',$userId)->get(); 

        $contactId=$request->contact_id;
        if(isset($userId))
        {
        $clientes_=clientes_chat::select(
        'id'
        ,'firstname as first'
        ,'lastname as last'
        ,'correo'
        ,'tipo_nip_id'
        ,'nip'
        ,'profesion'
        ,'nacimiento'
        ,"pais_id"
        ,"genero_id")
        ->where('companie_id',$usuario[0]->companie_id)
        ->orderBy('id','desc')
        ->get();
        foreach($clientes_ as $key)
        {
            array_push($name,
                array(
                "id"=>$key->id
                ,"name"=>["first"    => $key->first,"last" => $key->last]
                ,"correo"=>$key->correo
                ,'tipo_nip_id'=>$key->tipo_nip_id
                ,"nip"=>$key->nip
                ,"profesion"=>$key->profesion
                ,"nacimiento"=>$key->nacimiento
                ,"pais"=>$key->pais_id
                ,"genero"=>$key->genero_id
                )
                );
        }
            
        return $name;
        
        }        
        return json_encode(array('message'=>"error:no hay ningun usuario autenticado"));



        
    }
    public function update(Request $request)
    {
      
        $cliente= clientes_chat::find($request->id);
        $cliente->firstname=$request->nombre;
        $cliente->lastname=$request->apellido;
        $cliente->tipo_nip_id=$request->tipo_nip;
        $cliente->nip=$request->nip;
        $cliente->pais_id=$request->pais;
        $cliente->genero_id=$request->genero;
        $cliente->profesion=$request->profesion;
        $cliente->nacimiento=$request->fecha;
        $cliente->correo=$request->correo;

        $saved = $cliente->save();

        $data=[];
        $data['success'] = $saved;
        $data['message'] = $cliente;
        
        return $data; 

    }

    public function enlazar(Request $request)
    {
        //canal_id
        //cliente_id
        $user       =   User::find($request->to_id);
        $cliente    =   Clientes_chat::find($request->id);
        $verifica   =   Clientes_canal::select('id')
                        ->where('user_id',$request->to_id)
                        ->get();

        $data       =   [];
   
        if(count($verifica)<1)
        {                
            $enlazar    =   new Clientes_canal();
            $enlazar->canal_id=$user->canal_id;
            $enlazar->cliente_id=$request->id;
            $enlazar->user_id=$request->to_id;

            $saved      =   $enlazar->save();
            
            $data['success'] = $saved;
            $data['message'] = $cliente;
        }
        else
        {
            $data['error'] = '1001';
            $data['message'] = 'El cliente ya se encuenta enlazado a un usuario';
        }

        return $data; 


    /*     $data=[];
        $data['success'] = $saved;
        $data['message'] = $cliente;
        Storage::disk('local')->put('retorno.txt',($data));
        return $data;  */

    }

    public function addClienteNew(Request $request)
    {
        $userId=auth()->id();
        $usuario=User::where('id',$userId)->get(); 
        $cliente=new clientes_chat();
        $cliente->firstname=$request->name;
        $cliente->lastname=$request->last;
        $cliente->tipo_nip_id=$request->tipo_doc;
        $cliente->nip=$request->nip;
        $cliente->pais_id=$request->pais;
        $cliente->genero_id=$request->genero;
        $cliente->profesion=$request->profesion;
        $cliente->nacimiento=$request->fecha_nac;
        $cliente->correo=$request->correo;
        $cliente->companie_id=$usuario[0]->companie_id;
        
        $saved  =  $cliente->save();
            
        $data['success'] = $saved;
        $data['message'] = $cliente;

        return $data;
        


    }

}
