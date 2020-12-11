<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consultas;
use DB;
use Storage;
class ConsultasController extends Controller
{
    
    public function index(Request $request)
    {
        $userId=auth()->id();
        $contactId=$request->contact_id;
        if(isset($userId))
        {
        return Consultas::select('consultas.id','consultas.consulta','consultas.created_at','users.name')
        ->join('sessions','sessions.id','=','consultas.session_id')
        ->join('users','users.id','=','sessions.to_id')
        ->where('cliente_id',$contactId)
        ->get();
        }        
        return json_encode(array('message'=>"error:no hay ningun usuario autenticado"));

    }
    
    public function store(Request $request)
    {

       try{
        $setsession=null;
        $session= DB::table('sessions')
        ->select('sessions.id')
        ->where('sessions.from_id',$request->to_id)
        ->where('sessions.to_id',$request->from_id)
        ->where('sessions.state_id',2)
        ->first();

        $usuario=DB::table('users')
        ->select('users.canal_id')
        ->where('users.id',$request->to_id)
        ->first();


        if($session)
        {
            $setsession=$session->id;
        }
        
        $consultas = new Consultas();
        $consultas->tipo_consulta_id=$request->type;
        $consultas->canal_id = $usuario->canal_id;
        $consultas->cliente_id = $request->to_id;
        $consultas->session_id =  $setsession;
        $consultas->consulta =  $request->consulta;
        $saved = $consultas->save();
        
        $data=[];
        $data['success'] = $saved;
        $data['message'] = $consulta;
        return $data; 
        }
        catch (Exception $e) {
            report($e);
          /*   Storage::disk('local')->put('error.txt',json_encode($e)); */
            return false;
        }
    }
}
