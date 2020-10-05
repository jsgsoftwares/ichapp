<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp;
use App\Integracioneswebhook;
use App\Http\Controllers\ChatController;
use Kerox\Messenger\Messenger;




class FacebookController extends Controller
{
    public function handleRequest(Request $request){

        
        //Storage::disk('local')->put(date("YmdHi").'_chat_facebook.txt', $request);
        $data=json_decode($request->getContent(), true);
        
        $arreglo=[];


        if(!isset($data['entry'][0]['messaging'][0]['delivery']))
        {

            if(isset($data['entry'][0]['messaging'][0]['message']['text']))
            {
            
                $tipo='texto';
                $mensaje=strtolower($data['entry'][0]['messaging'][0]['message']['text']);
                //$id=$data['entry'][0]['messaging'][0]['message']['seq'];
            }
            elseif(isset($data['entry'][0]['messaging'][0]['message']['sticker_id']))
            {
                $tipo='sticker';
                $mensaje='sticker';
                //$id=$data['entry'][0]['messaging'][0]['message']['seq'];
            }
            elseif(isset($data['entry'][0]['messaging'][0]['postback']['payload']))
            {
            
                if(($data['entry'][0]['messaging'][0]['postback']['payload']=='FACEBOOK_WELCOME'))
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
            $id='0';
            $to_id=strtolower($data['entry'][0]['messaging'][0]['recipient']['id']);
            $from_id=strtolower($data['entry'][0]['messaging'][0]['sender']['id']);
            $nombre=('facebook');
            $created = strtolower($data['entry'][0]['messaging'][0]['timestamp']);
            $canal='facebook';

            if($evento=='mensaje' )
            {
                $chat = new ChatController();
                $URL=env('APP_URL').'668803720/webhook';

               
                $chat->verificar_status($URL, $id,$nombre,$from_id,$to_id,$created,$mensaje,$canal,$tipo,'facebook','','');
            
            }


        
        
        }
	 
    }


    public function sendMessage($token,$respuesta,$para,$idmensaje,$tipo){
        
        if($tipo=="texto"){
           $json= $this->jsonTexto($para,$respuesta);
          
        }elseif($tipo=="image"){
           // $image=asset('assets/images/doc.svg');
            $json=$this->JsonMedia($respuesta,$para,$respuesta);
        }elseif($tipo=="video"){
            $image=asset('assets/images/video.jpg');
            $json=$this->JsonMedia($image,$para,$respuesta);
        }elseif($tipo=="document"){
            $image=asset('assets/images/doc.svg');
            $json=$this->JsonMedia($image,$para,$respuesta);
        }
       $url='https://graph.facebook.com/v2.6/me/messages?access_token='.$token;
  
        $client = new GuzzleHttp\Client();

        $res= $client->request('POST',$url,['json'=>$json]);
        $response=$res->getBody();
    }

    public function enviarMensaje(){
        $token=env('FACEBOOK_TOKEN');
        $image=asset('assets/images/doc.svg');
        $json=$this->JsonMedia($image,"4519405324744277",$image);

       
        $url='https://graph.facebook.com/v2.6/me/messages?access_token='.$token;
  
        $client = new GuzzleHttp\Client();

        $res= $client->request('POST',$url,['json'=>$json]);
        $response=$res->getBody();
      
    }

    public function Webhook(Request $request)
    {
        print_r($request);
    }


    public function  JsonMedia( $image,$para,$mensaje){
        $arreglo=[
            'title'=>' ',
            'image_url'=>$image,
            'subtitle'=>'http://voixbot.com',
            'default_action'=>[
                'type'=>'web_url',
                'url'=>$mensaje,
                'messenger_extensions'=>false,
                'webview_height_ratio'=>'tall'
            ]
            ];
        $json= [
                'recipient'=>['id'=>$para],
                'message'=> [ 
                    'attachment' => [
                        'type'=>'template',
                        'payload'=>[
                            'template_type'=>'generic',
                            'elements'=>[
                                $arreglo
                            ]
                        ]
                    ] 
                ] 
        ];
       return ($json);
    }

    public function  jsonTexto($para,$mensaje){
       $json= [
            'recipient'=>['id'=>$para],
            'message'=> [ 'text' => $mensaje ] 
       ];

       return $json;
    }

    public function getmessages($companieId,$mytoken,Request $request){
   
        $data=$request->entry[0];
        $id=$data['id'];
        $from_id=$data['messaging'][0]['sender']['id'];
        $nombre=$data['messaging'][0]['sender']['id'];
        $to_id=$data['messaging'][0]['recipient']['id'];
        $created=$data['time'];
        if(isset($data['messaging'][0]['message']['text'])){
            $mensaje=$data['messaging'][0]['message']['text'];
            $chat = new ChatController();
            $URL='';
            $chat->verificar_status($URL, $id,$nombre,$from_id,$to_id,$created,$mensaje,'facebook','texto','facebook',$mytoken,$companieId);
        
        }else{
            $media=$data['messaging'][0]['message'];
            foreach($media['attachments'] as $value){
                //$value['type']
                //$value['payload']['url']
               
                if($value['type']=='file'){
                    $tipo='document';
                }else{
                    $tipo=$value['type'];
                }

                $mensaje=$value['payload']['url'];
                $chat = new ChatController();
                $URL='';
                $chat->verificar_status($URL, $id,$nombre,$from_id,$to_id,$created,$mensaje,'facebook',$tipo,'facebook',$mytoken,$companieId);
            


            }
            
            
        }
       
    }

    public function verify($companieId,$mytoken,Request $request){
        $challenge = $request->hub_challenge;
        $verify_token = $request->hub_verify_token;


        $webhookIntegracion=Integracioneswebhook::where('mytoken',$mytoken)->get();
		$verificacion=$webhookIntegracion[0]->verify;
        // Set this Verify Token Value on your Facebook App 
        if ($verify_token ===$verificacion) {
        echo $challenge;
}
    }

}
