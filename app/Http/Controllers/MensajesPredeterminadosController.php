<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\MensajesPredeterminados;
use App\Models\Documento;
use App\Models\Paises;
use App\Models\Genero;
use App\Models\clientes_chat;
use App\Models\TipoConsultas;
use App\Models\User;
class MensajesPredeterminadosController extends Controller
{
    //
    public function index()
    {
        return MensajesPredeterminados::get();
    }
    public function servicioinicial()
    {
        if(isset(Auth::user()->name))
        {
            //mensajes predeterminados
            $mensajepre=MensajesPredeterminados::get();
                //username
            $username=array(["name"=>Auth::user()->name]);
            //clientes registrados
            $clientes=[];
            $userId=auth()->id();

            $usuario=User::where('id',$userId)->get(); 
           // print_r($usuario[0]->companie_id);
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
                array_push($clientes,
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
                
                    //Paises
            $paises= Paises::select('id as value','nombre as text')
                    ->get();
            $documentos=Documento::select('id as value','detalle as text','created_at')
                ->get();
            $generos=Genero::select('id as value','genero as text')
                ->get();
            $tipoconsulta=TipoConsultas::select('id','detalle','created_at')
            ->get();
            $agentes=User::select('id','name as nombre','email')
            ->where('companie_id',$usuario[0]->companie_id)
            ->where('state_id',2)
            ->where('rol_id',5)
            ->orWhere('rol_id',4)
            ->get();
            return array("success"=>true,array(
                "username"=>$username,
                "clientes"=>$clientes,
                "paises"=>$paises,
                "documentos"=>$documentos,
                "generos"=>$generos,
                "mensajesPre"=>$mensajepre,
                "tipoconsulta"=>$tipoconsulta,
                "agentes_online"=>$agentes
            ));
        
        }
    }




}
