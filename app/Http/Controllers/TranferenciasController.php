<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Session;
use App\messages;
use DB;
use Storage;
use Auth;
use Carbon\Carbon;
class TranferenciasController extends Controller
{
    //

    public function searchAgent()
    {
        $userId=auth()->id();
        
        $usuario=User::where('id',$userId)->get(); 
       // print_r($usuario[0]->companie_id);
        if(isset(Auth::user()->name))
        {
        return User::select('id','name as nombre','email')
        ->where('companie_id',$usuario[0]->companie_id)
        ->where('state_id',2)
        ->where('rol_id',5)
        ->orWhere('rol_id',4)

        
        ->get();
        }
    }

    public function transfer(Request $request)
    {
        //Storage::disk('local')->put('transferencia.txt',json_encode($request->id));
        $userId=auth()->id();
        $date= Carbon::now()->format('Ymd');
            $sesion=Session::where('to_id', $userId)
                            ->where('state_id',2)
                            ->where('from_id',$request->contacto)
                            ->get();
           // Storage::disk('local')->put('session_find.txt',json_encode($sesion[0]->id));
            //Se actualiza la session anterior
            $session_vieja=DB::table('sessions')
                    ->where('id', $sesion[0]->id)
                    ->update(['state_id' => 7]);
            

            //Storage::disk('local')->put('session_old.txt',json_encode($session_vieja));
            //Se crea la nueva session
            $sesion_nueva=new Session;
            $sesion_nueva->num_sesion = 0;
            $sesion_nueva->idkey=$date;
            $sesion_nueva->from_id=$request->contacto;
            $sesion_nueva->to_id=$request->id;
            $sesion_nueva->flujo_id=3;
            $sesion_nueva->state_id=2;
            $sesion_nueva->save();
            if ($sesion_nueva->save()) {
                $getkeysession=$sesion_nueva->id;
            }
            $usuario=User::select('id','name as nombre','email')->where('id',$userId)->get();
            Storage::disk('local')->put('session_nueva.txt',json_encode($usuario[0]->nombre));
            $message1 = new messages();
            $message1->from_id = $request->contacto;
            $message1->to_id = $request->id;
            $message1->content =  'Conversacion transferida numero : '.$sesion[0]->id;
            $message1->session_id =  $getkeysession;
            $saved = $message1->save();

            
            $message = new messages();
            $message->from_id = $request->contacto;
            $message->to_id = $request->id;
            $message->content =  'Nueva conversacion numero : '.$getkeysession;
            $message->session_id =  $getkeysession;
            $saved = $message->save();

           

            $message2 = new messages();
            $message2->from_id = $request->contacto;
            $message2->to_id = $request->id;
            $message2->content =  'Chat transferido por: '.$usuario[0]->nombre.' , Email: '.$usuario[0]->email;
            $message2->session_id =  $getkeysession;
            $saved = $message2->save();

            //Storage::disk('local')->put('session_nueva.txt',json_encode($getkeysession));
            //Storage::disk('local')->put('transferencia_session.txt',json_encode($sesion));

    }

}
