<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp;
use App\Http\Controllers\ChatController;
use Storage;
use App\Models\User;
use App\Models\Waboxapp;
class WaboxappController extends Controller
{

    public function handleRequest(Request $request)
    {
      
    $arreglo;
    $con;
    Storage::disk('local')->put('WaboxappController_linea_19'.date("YmdHi").'_whatsapp_entrada.txt', $request);
   
    foreach (explode("event", $request) as $chunk) 
    {
    $con[]=explode("&",'event'.$chunk);
    }
    $arreglodivido=$con[1];
    $arreglosubdiv=str_replace('%5D',']',(str_replace('%5B','[',$arreglodivido)));
    foreach($arreglosubdiv as $key)
    {
    $param=explode("=",$key);
    if ($param) {
    $arreglo[]=array(urldecode($param[0])=>urldecode($param[1]));
    }
    }
  
    $json=json_encode($arreglo);
    $canal="whatsapp";
    $evento=$arreglo[0]['event'];
    $id = $arreglo[7]['message[uid]'];
    $mensaje = $arreglo[11]['message[body][text]'];
    $to_id = $arreglo[2]['uid'];
    $from_id= $arreglo[3]['contact[uid]'];
    $nombre=$arreglo[4]['contact[name]'];
    $created = date('YmdHis'); 
    $tipo="texto";


  
    if($evento!='ack' && $id!='' && strlen($id)>0)
    {
   

        $chat = new ChatController();
        $URL=env('APP_URL').'668803720/webhook';
        $chat->verificar_status($URL, $id,$nombre,$from_id,$to_id,$created,$mensaje,$canal,$tipo,'waboxapp');
    
    }
    else
    {
      Storage::disk('local')->put('WaboxappController_linea_68'.date("YmdHi").'_chat_whatsapp_enblanco.txt', $request);
    }


    }

    
	public function sendMessage($token,$respuesta,$para,$idmensaje)
	{
    $desde=env('DESDE');
    Storage::disk('local')->put('WaboxappController_linea_78'.date("YmdHi").'WABOXAPP_sendme.txt',$respuesta);
    $waboxapp = new Waboxapp;
    $waboxapp->user = $para;
    $waboxapp->mensaje=$respuesta;
    $waboxapp->save();

    if ($waboxapp->save()) {
      $getkeyMensaje=$waboxapp->id;
    }
    //Storage::disk('local')->put('WABOXAPP_getkeyMensaje.txt',$getkeyMensaje);

 
/*             $client = new GuzzleHttp\Client();
                $res= $client->request('POST','https://api.gupshup.io/sm/api/v1/msg',
                [
                    'headers'=>['Content-Type'=>'application/x-www-form-urlencoded',
                    'apikey'=>'bcebbd2610874ee2cee6194843ed0edd'],
                    'form_params' => [
                      'channel' => 'whatsapp',
                      'source' => '917834811114',
                      'destination' =>'50768644548',
                      'message'=>$respuesta

                  ]
                ]
                );
                echo $res->getStatusCode(); */
		//$email = DB::table('BOT_WHATSAPP')->where('from_', $para)->max('id_bot');
		$url_whatsapp="https://www.waboxapp.com/api/send/chat";
   $datastring="token=".$token."&uid=".$desde."&to=".$para."&custom_uid=".$getkeyMensaje."&text=".$respuesta;
 
    
    
  /*   $url_whatsapp='https://api.gupshup.io/sm/api/v1/msg'; */
   // $datastring='channel=whatsapp&source=917834811114 &destination=50768644548&message={"type":"text", "text":"'.$respuesta.'"}';
   Storage::disk('local')->put('WaboxappController_linea_113'.date("YmdHi").'waboxapp_envio_.txt',$url_whatsapp.'?'. $datastring);
   $ch = curl_init($url_whatsapp);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $datastring);
		curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded','apikey:bcebbd2610874ee2cee6194843ed0edd']);
    $response  = curl_exec($ch);
    Storage::disk('local')->put('WaboxappController_linea_119'.date("YmdHi").'waboxapp_envio_.txt',$response);
   
		curl_close($ch);
		

	
	
	}


  public function prueba(Request $request)
  {
    
  
  Storage::disk('local')->put(date("YmdHi").'_pruebas.txt', $request);
  }

  public function validar()
  {
    
    $validar=["auth"=>true];

    return $validar;
      
  
  }

  public function pusher()
  {
    $respuesta=[];
		$respuesta=array(
					  "event"=>"pusher:subscribe",
					  "code"=>94949,
					  "data"=>array(
						"channel"=>"users.1",
						"auth"=>"5735.66983:private-users.1",
						"channel_data"=>array("name"=>"johnny")
					  )
					);
    return json_encode($respuesta);
  }

  public function waping(Request $request)
  {
    Storage::disk('local')->put(date("YmdHi").'_waping.txt', $request);
  }






}
