<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Session;
use DB;
use Carbon\Carbon;
class SessionController extends Controller
{
    //
    public function conversations()
    {
       
        $sessiones= Session::select('sessions.id',
                                    DB::raw("CONCAT(g.firstname,' ',g.lastname) as cliente"),
                                    'g.nip as nip',
                                    'c.name as agente',
                                    'd.detalle',
                                    'sessions.created_at as fecha'
                                    
                                    )
                            ->join('users as b', 'sessions.from_id', '=', 'b.id')
                            ->join('users as c', 'sessions.to_id', '=', 'c.id')
                            ->join('states as d', 'sessions.state_id', '=', 'd.id')
                            ->join('messages as e','sessions.id','=','e.session_id')
                            ->join('clientes_canals as f','b.id','=','f.user_id')
                            ->join('clientes_chats as g','f.cliente_id','=','g.id');
        $sesiones_unidas= Session::select('sessions.id',
                            DB::raw("(b.name) as cliente"),
                            DB::raw("'00-000-000' as nip"),
                            'c.name as agente',
                            'd.detalle',
                            'sessions.created_at as fecha'
                            
                            )
                            ->join('users as b', 'sessions.from_id', '=', 'b.id')
                            ->join('users as c', 'sessions.to_id', '=', 'c.id')
                            ->join('states as d', 'sessions.state_id', '=', 'd.id')
                            ->join('messages as e','sessions.id','=','e.session_id')
                            ->leftjoin('clientes_canals as f','b.id','=','f.user_id')
                            ->whereNull('f.user_id')
                            ->union($sessiones);
                           


                        $data;
                        $data['success']=true;
                        $data['conversations']=$sesiones_unidas->distinct()->get();
                        return $data;

    }
    public function chagestate()
    {
        $date= Carbon::now()->format('Ymd');
        $sessiones= Session::where('idkey','<',$date)->where('state_id',2)
        ->update(['state_id' => 1]);
        
    }
    public function cambiarBot($session)
    {
        Session::where('id',$session)
        ->update([
            'flujo_id'=>2
  
            ]);
    }
    public function cambiarAgente($session)
    {
        Session::where('id',$session)
        ->update([
            'flujo_id'=>3
  
            ]);
    }
    public function cambiarDialog($session)
    {
        Session::where('id',$session)
        ->update([
            'flujo_id'=>1
  
            ]);
    }
}
