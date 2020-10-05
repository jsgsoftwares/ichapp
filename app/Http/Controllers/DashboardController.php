<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Consultas;
use App\Session;
use App\messages;
class DashboardController extends Controller
{
    //

    public function CantUser()
    {

        $verificacion=array();
        $fecha=[];
        $user=[];
        $canales=[];
        $cant_usuarios=Session::select('sessions.from_id','canales.detalle','sessions.created_at')
        ->join('users','sessions.from_id', '=', 'users.id')
        ->join('canales','canales.id', '=', 'users.canal_id')
        ->whereBetween('sessions.created_at', ['2020-02-26 00:00:00','2020-03-30 23:59:59'])
        ->groupBy('sessions.from_id','canales.detalle','sessions.created_at')
        ->get();
        $canales=array('dias'
                        ,'interno',
                        'telegram',
                        'whatsapp',
                        'facebook',
                        'twitter',
                        'instagram');
        $verificacion[]= array(
                                    'dias',
                                    'interno',
                                    'telegram',
                                    'whatsapp',
                                    'facebook',
                                    'twitter',
                                    'instagram'
                            );  
        
                            foreach($cant_usuarios as $key)
                            {

                               
                                
                                if (!in_array($key->created_at->format('d-m'), $fecha)) {
                                    
                                    array_push($fecha,$key->created_at->format('d-m'));
                                     
                                }
                                $infecha=array_search($key->created_at->format('d-m'),$fecha);
                                
                                $verificacion[$infecha+1][0]=$key->created_at->format('d-m');
                                $verificacion[$infecha+1][1]=0;
                                $verificacion[$infecha+1][2]=0;
                                $verificacion[$infecha+1][3]=0;
                                $verificacion[$infecha+1][4]=0;
                                $verificacion[$infecha+1][5]=0;
                                $verificacion[$infecha+1][6]=0;
                                
                             
                            }  
                            foreach($cant_usuarios as $key)
                            {

                                $incanal=array_search($key->detalle,$canales);
                                $infecha=array_search($key->created_at->format('d-m'),$fecha);
                                if(isset($verificacion[$infecha+1][$incanal])!=null)
                                {
                                    $valor=$verificacion[$infecha+1][$incanal];
                                    $verificacion[$infecha+1][$incanal]=$valor+1;  
                                }
                                else
                                {
                                    $verificacion[$infecha+1][$incanal]=1;
                                }
                                
                                
                                
                            
                        }
                            
                   
                        foreach($verificacion as $data)
                        {
                            $final[]=array($data[0],$data[1],$data[2],$data[3],$data[4],$data[5],$data[6]);
                            
                        }
                             
                        print_r(json_encode($final));
    }

    public function tipoConsultas()
    {

        $verificacion=array();
        $fecha=[];
 
        $cant_usuarios=Consultas::select('tipo_consultas.detalle','consultas.created_at')
        ->join('tipo_consultas','consultas.tipo_consulta_id', '=', 'tipo_consultas.id')
        ->whereBetween('consultas.created_at', ['2020-02-26 00:00:00','2020-03-30 23:59:59'])
        ->get();
        $consultas=[];
        $verificacion[]= array('dias');  
        
            foreach($cant_usuarios as $setconsultas)
            {
                if (!in_array($setconsultas->detalle, $consultas)) {
                                    
                    array_push($consultas,$setconsultas->detalle);
                     
                }
                $inconsulta=array_search($setconsultas->detalle,$consultas);
                $verificacion[0][$inconsulta+1]=$setconsultas->detalle;
                
            }
            
            foreach($cant_usuarios as $key)
            {

                if (!in_array($key->created_at->format('d-m'), $fecha)) {
                    
                    array_push($fecha,$key->created_at->format('d-m'));      
                }

                $infecha=array_search($key->created_at->format('d-m'),$fecha);
                $inconsulta=array_search($key->detalle,$consultas);

                $verificacion[$infecha+1][0]=$key->created_at->format('d-m');
                for ($i = 0; $i < count($consultas); $i++) {

                    $verificacion[$infecha+1][$i+1]=0;
                }           
            }  
            foreach($cant_usuarios as $key)
            {

                $inconsulta=array_search($key->detalle,$consultas);
                $infecha=array_search($key->created_at->format('d-m'),$fecha);

                if(isset($verificacion[$infecha+1][$inconsulta+1])!=null)
                {
                    $valor=$verificacion[$infecha+1][$inconsulta+1];
                    $verificacion[$infecha+1][$inconsulta+1]=$valor+1;  
                }
                else
                {
                    $verificacion[$infecha+1][$inconsulta+1]=1;
                }
                
            }
                            
                        return (json_encode($verificacion));
    }

    public function MensajesRecibidos()
    {
        $verificacion=array();
        $fecha=[];

        $cant_usuarios=messages::select('canales.detalle','messages.created_at')
        ->join('users','messages.from_id', '=', 'users.id')
        ->join('canales','users.canal_id', '=', 'canales.id')
        ->where('canales.detalle','<>','interno')
        ->whereBetween('messages.created_at', ['2020-02-26 00:00:00','2020-03-30 23:59:59'])
        ->get();
        $canales=[];
        $verificacion[]= array('dias');  
        foreach($cant_usuarios as $setcanales)
        {
            if (!in_array($setcanales->detalle, $canales)) {
                                
                array_push($canales,$setcanales->detalle);
                 
            }
            $incanal=array_search($setcanales->detalle,$canales);
            $verificacion[0][$incanal+1]=$setcanales->detalle;
            
        }
        foreach($cant_usuarios as $key)
        {

            if (!in_array($key->created_at->format('d-m'), $fecha)) {
                
                array_push($fecha,$key->created_at->format('d-m'));      
            }

            $infecha=array_search($key->created_at->format('d-m'),$fecha);
            $inconsulta=array_search($key->detalle,$canales);

            $verificacion[$infecha+1][0]=$key->created_at->format('d-m');
            for ($i = 0; $i < count($canales); $i++) {

                $verificacion[$infecha+1][$i+1]=0;
            }           
        } 
        foreach($cant_usuarios as $key)
        {

            $inconsulta=array_search($key->detalle,$canales);
            $infecha=array_search($key->created_at->format('d-m'),$fecha);

            
            if(isset($verificacion[$infecha+1][$inconsulta+1])!=null)
            {
                $valor=$verificacion[$infecha+1][$inconsulta+1];
                $verificacion[$infecha+1][$inconsulta+1]=$valor+1;  
            }
            else
            {
                $verificacion[$infecha+1][$inconsulta+1]=1;
            }
            
        }
        



        print_r(json_encode($verificacion));
    }

}
