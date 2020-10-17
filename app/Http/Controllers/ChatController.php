<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp;
use App\User;
use App\Canales;
use Carbon\Carbon;
use DB;
use Storage;
use Auth;
use App\Http\Controllers\WebhookController;
class ChatController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('chat');
    }
    public function dashboard()
    {
        
        if(Auth::user()->rol_id==2 || Auth::user()->rol_id==1){
             return view('dashboard');
        }else{
            return redirect('/chat');
        }
        


        
    }
    public function verificar_status($url,$id,$nombre,$from_id,$to_id,$created,$mensaje,$canal,$tipo,$proveedor,$mytoken,$companieId)
    {
      
        //Storage::disk('local')->put(date("YmdHi").'_chatController.txt', json_encode(array($id,$from_id,$mensaje)));
        //$clientes = new User;
        $data= User::where('chat_id',$from_id)->get();
        $tipo_canal= DB::table('canales')->where('detalle',$canal)->first();
    
       
      
        if(isset($data) && count($data)>0)
        {
            $this->enviar($url,$id,$nombre,$from_id,$to_id,$created,$mensaje,$canal,$tipo,$proveedor,$mytoken,$companieId); 
        }
        else
        {
            $clientes = new User();
            $clientes->chat_id = $from_id;
            $clientes->canal_id = $tipo_canal->id;
            $clientes->name = $nombre;
            $clientes->email = $from_id.'@ichapp.com';
            $clientes->password=bcrypt($from_id);
            $clientes->rol_id = 6;
            $clientes->state_id = 2;
            $clientes->companie_id=1;
            $clientes->save();
            $this->enviar($url,$id,$nombre,$from_id,$to_id,$created,$mensaje,$canal,$tipo,$proveedor,$mytoken,$companieId);
        }
        
    }

    public function enviar($url,$id,$nombre,$from_id,$to_id,$created,$mensaje,$canal,$tipo,$proveedor,$mytoken,$companieId)
    {
        
        $data=[
            'message'=>
            [
               "canal"=>$canal
              ,"receptor"=>$to_id
              ,"tipo"=>$tipo
              ,"message_id"=>$id
              ,"from"=>[
                "id"=>$from_id
                ,"nombre"=>$nombre
                ,"empresa"=>"jsgsoftware"
                ,"language"=>"es"
                
              ]
              ,"chat"=>[
                "id"=>$from_id
                ,"nombre"=>$nombre
                ,"empresa"=>"jsgsoftware"
                ,"type"=>"private"
                
              ]
              ,"date"=>$created
              ,"mensaje"=>$mensaje
              ,"proveedor"=>$proveedor
              ,"mytoken"=>$mytoken
              ,"companieId"=>$companieId
            ]
              ];
           
           
              $chat = new WebhookController();
              $chat->receptor($data);
       



    }

}
