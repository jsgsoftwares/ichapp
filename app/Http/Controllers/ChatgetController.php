<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp;

class ChatgetController extends Controller
{
    

    
    public function index()
    {
      //  $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/presupuesto.json');
      


    }
    public function facebook(Request $request)
    {
      Storage::disk('local')->put(date("YmdHi").'_chat_facebook.txt', $request);
      $arreglo=[];
      foreach($request as $key)
      {
        foreach($key as $llave)
        {
          $arreglo[]=$llave;
        }
       
      }


      if(!isset($arreglo[1][0]['messaging'][0]['delivery']))
      {
      if(isset($arreglo[1][0]['messaging'][0]['message']['text']))
      {
       
        $tipo='texto';
        $mensaje=strtolower($arreglo[1][0]['messaging'][0]['message']['text']);
        $id=$arreglo[1][0]['messaging'][0]['message']['seq'];
      }
      elseif(isset($arreglo[1][0]['messaging'][0]['message']['sticker_id']))
      {
        $tipo='sticker';
        $mensaje='sticker';
        $id=$arreglo[1][0]['messaging'][0]['message']['seq'];
      }
      elseif(isset($arreglo[1][0]['messaging'][0]['postback']['payload']))
      {
       
        if(($arreglo[1][0]['messaging'][0]['postback']['payload']=='FACEBOOK_WELCOME'))
        {

       
        $tipo='bienvenida';
        $mensaje='hola';
        $id='0';
         }
      }
      else{
        $tipo='nada';
        $mensaje='hola';
        $id='0';
      }
    
    
      $evento='mensaje';
      
      $de=strtolower($arreglo[1][0]['messaging'][0]['recipient']['id']);
      $a=strtolower($arreglo[1][0]['messaging'][0]['sender']['id']);
      $nombre=(' ');
      $created = strtolower($arreglo[1][0]['messaging'][0]['timestamp']);
      $canal='facebook';
  
      if($evento=='mensaje' )
      {
      
      $URL='https://voix.tech/receptor/webhook/';


      //$this->enviar($URL, $id,$nombre,$de,$a,$created,$mensaje,$canal,$tipo);
      
      }


	 
	 
    }
	 
    }

    public function twitter(Request $request)
    {
      Storage::disk('local')->put(date("YmdHi").'_twitter.txt', $request);
    }

    public function whatsapp(Request $request)
    {
      Storage::disk('local')->put(date("YmdHi").'_chat_whatsapp.txt', $request);
    $arreglo;
    $con;
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
    $de = $arreglo[2]['uid'];
    $a = $arreglo[3]['contact[uid]'];
    $nombre=$arreglo[4]['contact[name]'];
    $created = date('YmdHis'); 
    $tipo="texto";

  
    if($evento!='ack' && $id!='' && strlen($id)>0)
    {
   
    $URL='https://voix.tech/receptor/webhook/';


    //$this->enviar($URL, $id,$nombre,$de,$a,$created,$mensaje,$canal,$tipo);
    
    }
    else
    {
      Storage::disk('local')->put(date("YmdHi").'_chat_whatsapp_enblanco.txt', $request);
    }


    }



    public function enviar($url,$id,$nombre,$de,$a,$created,$mensaje,$canal,$tipo)
    {
    
      $client = new GuzzleHttp\Client();
      $res= $client->request('POST',$url,[
        'json'=>[
          'message'=>
          [
             "canal"=>$canal
            ,"receptor"=>$de
            ,"message_id"=>$id
            ,"from"=>[
              "id"=>$a
              ,"nombre"=>$nombre
              ,"empresa"=>"jsgsoftware"
              ,"language"=>"es"
              
            ]
            ,"chat"=>[
              "id"=>$a
              ,"nombre"=>$nombre
              ,"empresa"=>"jsgsoftware"
              ,"type"=>"private"
              
            ]
            ,"date"=>$created
            ,"mensaje"=>$mensaje
          ]
        ]

      ]);
      $response=$res->getBody();





    }
}
