<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp;
use Storage;
use App\Models\Integracioneswebhook;
use App\Models\subscriptionproducts;
class WapingController extends Controller
{
    
    public function entrada(Request $request){
      

      
        $pos = strpos($request, "{");
        $cadena=utf8_encode(substr($request,$pos));
        $decodificacion=json_decode($cadena);
        $request=($decodificacion);
        $status=$request->status;
        $id=$request->id;
        $type=$request->message->type;
        $date=$request->message->date;
        $from=$request->message->from;
        $to=$request->message->to;
        $fromMe=$request->message->fromMe;
        $name=$request->message->name;
        $tipo=$request->message->type;
        
        if(strlen($name)>0)
        {
          $name=$from;
        }
        if($type=="text" || $type=="chat")
        {
            $mensaje=$request->message->body->text;
            $tipo="texto";
        }
        else{
          $mensaje=$request->message->body->url;
        }
        
        
        $mensaje=$this->eliminar_acentos($mensaje);

        
        
        $chat = new ChatController();
        $URL=env('APP_URL').'668803720/webhook';
        $chat->verificar_status($URL, $id,$name,$from,$to,$date,$mensaje,'whatsapp',$tipo,'waping','','');
    }
    
    public function sendMessage($token,$respuesta,$para,$idmensaje,$tip){

   
          if($tip=="texto"){
              $tipoMen="text";
              $body=[
                "text"=>$respuesta
              ];
            }else{
              $tipoMen="media";
              $body=[
                "url"=>$respuesta,
                "caption"=>"voix.bot"
              ];
            }
            
            $tokenwhatsapp=env('WAPING');
          
            $json=[
                "token"=>$token->token,
                "source"=>$token->phone_code,
                "destination"=>$para,
                "type"=>$tipoMen,
                'channel' => 'whatsapp',
                "body"=>$body

            ];
            
    
          $curl = curl_init();
           
          curl_setopt_array($curl, array(
          CURLOPT_URL => "http://waping.es/api/send",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS =>json_encode($json),
          CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json"
          ),
          ));
        
        $response = curl_exec($curl);
        Storage::disk('local')->put(date("YmdHi").'_mmm.txt', json_encode($response));
        if($curl != null) 
        curl_close($curl);

        echo $response; 


                
      }

      function eliminar_acentos($cadena)
      {
            
          //Reemplazamos la A y a
          $cadena = str_replace(
          array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
          array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
          $cadena
          );

          //Reemplazamos la E y e
          $cadena = str_replace(
          array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
          array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
          $cadena );

          //Reemplazamos la I y i
          $cadena = str_replace(
          array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
          array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
          $cadena );

          //Reemplazamos la O y o
          $cadena = str_replace(
          array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
          array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
          $cadena );

          //Reemplazamos la U y u
          $cadena = str_replace(
          array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
          array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
          $cadena );

          //Reemplazamos la N, n, C y c
          $cadena = str_replace(
          array('Ñ', 'ñ', 'Ç', 'ç'),
          array('N', 'n', 'C', 'c'),
          $cadena
          );
          
          return $cadena;
      }

    public function getmessages($companieId,$mytoken,Request $request){
      

      
        $pos = strpos($request, "{");
        $cadena=utf8_encode(substr($request,$pos));
        $decodificacion=json_decode($cadena);
        $request=($decodificacion);
        $status=$request->status;


       
        $id=$request->id;
        $type=$request->message->type;
        $date=$request->message->date;
        $from=$request->message->from;
        $to=$request->message->to;
        $fromMe=$request->message->fromMe;
        $name=$request->message->from;
        $tipo=$request->message->type;



       // $integracion=Integracioneswebhook::where('phone',$to)->first();



       
        if(strlen($name)>0)
        {
          $name=$from;
        }
        if($type=="text" || $type=="chat")
        {
            $mensaje=$request->message->body->text;
            $tipo="texto";
        }
        else{
          $mensaje=$request->message->body->url;
        }
        
        
        $mensaje=$this->eliminar_acentos($mensaje);

        
        
        $chat = new ChatController();
        $URL=env('APP_URL').'668803720/webhook';
        $chat->verificar_status($URL, $id,$name,$from,$to,$date,$mensaje,'whatsapp',$tipo,'waping',$mytoken,$companieId);
    }
    public function getmessagesWaping(Request $request){

      
          
      
        $pos = strpos($request, "{");
        $cadena=utf8_encode(substr($request,$pos));
        $decodificacion=json_decode($cadena);
        $request=($decodificacion);
        $status=$request->status;


        
        $id=$request->id;
        $type=$request->message->type;
        $date=$request->message->date;
        $from=$request->message->from;
        $to=$request->message->to;
        $fromMe=$request->message->fromMe;
        $name=$request->message->from;
        $tipo=$request->message->type;


     
        $integracion=Integracioneswebhook::where('phone_code',$to)->first();
        $sub=subscriptionproducts::where('companie_id',$integracion->companie_id)
        ->where('product_id',3)
        ->where('enabled',1)
        ->get();
          

      
        if($sub){
          if($integracion->enabled && $integracion->start){
                if(strlen($name)>0){
                  $name=$from;
                }
                if($type=="text" || $type=="chat"){
                    $mensaje=$request->message->body->text;
                    $tipo="texto";
                }
                else{
                  $mensaje=$request->message->body->url;
                }
                
                
                $mensaje=$this->eliminar_acentos($mensaje);

                
            
                $chat = new ChatController();
                $URL=env('APP_URL').'668803720/webhook';
                $chat->verificar_status($URL, $id,$name,$from,$to,$date,$mensaje,'whatsapp',$tipo,'waping',$integracion->mytoken,$integracion->companie_id);
            
          }
        }

      }
      
    
}
