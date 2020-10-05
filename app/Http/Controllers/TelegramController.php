<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Api;
use GuzzleHttp;
use App\Http\Controllers\ChatController;
use Storage;
use App\User;
use App\Integracioneswebhook;
use Telegram\Bot\FileUpload\InputFile;
class TelegramController extends Controller
{
    protected $telegram;
    protected $urlapi;

    protected $update_id;
    protected $message_id;
    protected $first_name;
    protected $last_name;
    protected $language_code;
    protected $type;
    protected $date;
    protected $chat_id;
    protected $text;
	protected $texto_numero;
    protected $tipoarchivo;
    protected $aplicacion;
    protected $companieId;
    protected $mytoken;
	
	
	
    protected $com=array();
    protected $com1=array();
    protected $com2=array();
    protected $com3=array();
    protected $com4=array();
    protected $com5=array();
	protected $fotos=array();
    protected $document=array();
    protected $mtexto=array();
    protected $MBotones=array();
    protected $MImagenes=array();
    protected $MDocumentos=array();
    protected $MAudio=array();
    protected $MVideos=array();
    protected $ArregloMulti=array();

 
    public function __construct()
    {
        $this->urlapi='https://api.telegram.org/bot';
        $this->telegram = new Api('921564257:AAHBeXkKKKMMLnC4OMZwoEX75-8eKSXHvzc');
    }
 
    public function getMe()
    {
        $response = $this->telegram->getMe();
        return $response;
    }
 
    public function setWebHook()
    {
        $url = env('APP_URL').'668803720/telegram';
        $response = $this->telegram->setWebhook(['url' => $url]);
 
        return $response == true ? redirect()->back() : dd($response);
    }
 
    public function handleRequest(Request $request)
    {
        try
        {
			
			mb_internal_encoding('UTF-8');
            // Tell PHP that we'll be outputting UTF-8 to the browser
            mb_http_output('UTF-8');
			
			
		
		
            if(isset($request->message['aplicacion']))
            {
            $this->aplicacion = $request->message['aplicacion'];
            }
            else
            {
				
	        $this->aplicacion ='t3l3gr4m';
            }


            if(isset($request->message['from']['first_name']) || ($request->message['from']['first_name'])=='')
            {
                $this->first_name = $request->message['from']['first_name'].' ';
                
            }
            else
            {
                $this->first_name='Nombre Fict';
            }
            if(isset($request->message['from']['last_name']) || ($request->message['from']['last_name'])=='')
            {
                $this->last_name = $request->message['from']['last_name'].' ';
            }
            else
            {
                $this->last_name = 'Apellido fict';
            }
		
        if(isset($request->message['text']))
        {

       $this->update_id = $request->update_id;
       $this->message_id = $request->message['message_id'];

       
       
      
       if(isset($request->message['from']['first_name']))
       {
           $this->first_name = $request->message['from']['first_name'].' ';
           
       }
       else
       {
           $this->first_name='Nombre Fict';
       }
       if(isset($request->message['from']['last_name']))
       {
           $this->last_name = $request->message['from']['last_name'].' ';
       }
       else
       {
           $this->last_name = 'Apellido fict';
       }
       
       
       $this->type = 'app';
       $this->date = $request->message['date'];
       $this->chat_id = $request->message['chat']['id'];
       $this->text = $request->message['text'];
	   
       $this->tipoarchivo="TEXTO";
        
       }
	   
       else if(isset($request->message['photo']))
       {
		   
        if(isset($request->message['from']['first_name']))
       {
           $this->first_name = $request->message['from']['first_name'].' ';
           
       }
       else
       {
           $this->first_name='Nombre Fict';
       }
       if(isset($request->message['from']['last_name']))
       {
           $this->last_name = $request->message['from']['last_name'].' ';
       }
       else
       {
           $this->last_name = 'Apellido fict';
       }
           
           
           
           
       $this->update_id = $request->update_id;
       $this->message_id = $request->message['message_id'];

       $this->type = $request->message['chat']['type'];
       $this->date = $request->message['date'];
       $this->chat_id = $request->message['chat']['id'];
       $this->fotos[] = $request->message['photo'];
       $this->tipoarchivo = 'photo'; 
       $this->enviarData('Imagen',"nada");
       }
         elseif(isset($request->message['document']))
       {
		   
          $this->update_id = $request->update_id;
       $this->message_id = $request->message['message_id'];
       $this->first_name = $request->message['from']['first_name'];
       $this->last_name = $request->message['from']['last_name'];
       $this->type = $request->message['chat']['type'];
       $this->date = $request->message['date'];
       $this->chat_id = $request->message['chat']['id'];
       $this->text = $request->message['document']; 
       $this->tipoarchivo = 'documento';
       $this->enviarData('Documento',"nada");
       }
         
		 elseif(isset($request->message['contact']['phone_number']))
       {
                   if(isset($request->message['from']['first_name']))
       {
           $this->first_name = $request->message['from']['first_name'].' ';
           
       }
       else
       {
           $this->first_name='Nombre Fict';
       }
       if(isset($request->message['from']['last_name']))
       {
           $this->last_name = $request->message['from']['last_name'].' ';
       }
       else
       {
           $this->last_name = 'Apellido fict';
       }
           
           
           
       $this->update_id = $request->update_id;
       $this->message_id = $request->message['message_id'];
       $this->first_name = $request->message['from']['first_name'];
       $this->last_name = $request->message['from']['last_name'];
       $this->type = 'PEDNU';
       $this->date = $request->message['date'];
       $this->chat_id = $request->message['chat']['id'];
       $this->text = substr($request->message['contact']['phone_number'],3); 
       $this->tipoarchivo = 'PHONE';
       }

   
       if($this->tipoarchivo == 'photo')
       {

            $this->Imagenes();
       }
       else
       {
		   
           $this->masterOp();
       }



        }
        catch(Exception $e)
     {
        //Storage::disk('local')->put('error_telegram.txt',$e);
     
     }




    }


    protected function masterOp(){
    
        try{
        
            $data=[
                'message'=>
                [
                "canal"=>"telegram"
                ,"receptor"=>'921564257:AAHBeXkKKKMMLnC4OMZwoEX75-8eKSXHvzc'
                ,"message_id"=>$this->message_id
                ,"from"=>[
                    "id"=> (string) $this->chat_id
                    ,"nombre"=>$this->first_name.' '.$this->last_name
                    ,"empresa"=>"jsgsoftware"
                    ,"language"=>"es"     
                ]
                ,"chat"=>[
                    "id"=> (string) $this->chat_id
                    ,"nombre"=>$this->first_name.' '.$this->last_name
                    ,"empresa"=>"jsgsoftware"
                    ,"type"=>"private"
                    
                ]
                ,"date"=>$this->date
                ,"mensaje"=>$this->text
                ]
            ];
            
                $evento='mensaje';
                $id=$this->message_id;
                $to_id='921564257:AAHBeXkKKKMMLnC4OMZwoEX75-8eKSXHvzc';
                $from_id=(string) $this->chat_id;
                $nombre=$this->first_name.' '.$this->last_name;
                $created =$this->date;
                $canal='telegram';
                $mensaje=$this->text;
                $tipo=$this->tipoarchivo;
            $chat = new ChatController();
            $URL=env('APP_URL').'668803720/webhook';
            $chat->verificar_status($URL, $id,$nombre,$from_id,$to_id,$created,$mensaje,$canal,$tipo,'telegram',$this->mytoken,$this->companieId);
        
        

        }
        catch(Exception $e)
        {
        dd($e);
        }
            
    }
    
    


    protected function Imagenes(){  

            $dk=($this->fotos[0][(count($this->fotos[0])-1)]["file_id"]);
            foreach ($this->fotos as $value){

            
                $client = new GuzzleHttp\Client();
                $res= $client->request('GET','https://api.telegram.org/bot269874330:AAG1SvGkRFs8x26AxP80KM9cFqOuzvp0d-M/getFile?file_id='.$dk);
                $reponse=json_decode($res->getBody(),true);
            
                
    
                $this->update_id = 0;
                $this->message_id = 9999999;
                $this->first_name = 'IMAGENBOT';
                $this->last_name = 'IMAGENBOT';
                $this->type = 'PROCESO';
                $this->date = 1494449903;

                $this->text =  'https://api.telegram.org/file/bot269874330:AAG1SvGkRFs8x26AxP80KM9cFqOuzvp0d-M/'.$reponse['result']['file_path'];
                $this->tipoarchivo="image";

                $this->masterOp();
    
    
            }
    
    }


  
 
    protected function formatArray($data)
    {
        $formatted_data = "";
        foreach ($data as $item => $value) {
            $item = str_replace("_", " ", $item);
            if ($item == 'last updated') {
                $value = Carbon::createFromTimestampUTC($value)->diffForHumans();
            }
            $formatted_data .= "<b>{$item}</b>\n";
            $formatted_data .= "\t{$value}\n";
        }
        return $formatted_data;
    }
 
	
    public function sendMessage($token,$message,$para,$tipo, $parse_html = false)
    {
        $this->telegram = new Api($token);
        $namefile=str_random(10);
        if($tipo=="texto"){
            $data = [
                    'chat_id' =>(int) $para,
                    'text' => $message,
                ];
        
                if ($parse_html) $data['parse_mode'] = 'HTML';
        
                $this->telegram->sendMessage($data);
        }elseif($tipo=="image"){
            $file = explode("storage/", $message);
            $fileExtension = explode(".", $file[1]);

            $data = [
                'chat_id' =>(int) $para,
                'photo' => InputFile::create($message,$namefile.'.'.$fileExtension[1]),
                //'caption'=>'voixbot'
            ];
    
            if ($parse_html) $data['parse_mode'] = 'HTML';
    
            $this->telegram->sendPhoto($data);
        }elseif($tipo=="document"){
            $file = explode("storage/", $message);
            $fileExtension = explode(".", $file[1]);
            $data = [
                'chat_id' =>(int) $para,
                'document' => InputFile::create($message,$namefile.'.'.$fileExtension[1]),
                //'caption'=>'voixbot'
            ];
    
            if ($parse_html) $data['parse_mode'] = 'HTML';
    
            $this->telegram->sendDocument($data);
        }
        elseif($tipo=="video"){
            $file = explode("storage/", $message);
            $fileExtension = explode(".", $file[1]);
            $data = [
                'chat_id' =>(int) $para,
                'video' => InputFile::create($message,$namefile.'.'.$fileExtension[1]),
                //'caption'=>'voixbot'
            ];
    
            if ($parse_html) $data['parse_mode'] = 'HTML';
    
            $this->telegram->sendVideo($data);
        }

    }





    //NUEVA VERSION V1


    function getmessages($companieId,$mytoken,Request $request){
      
        try{
            $this->companieId=$companieId;
            $this->mytoken=$mytoken;
			mb_internal_encoding('UTF-8');
            mb_http_output('UTF-8');
			
            if(isset($request->message['aplicacion'])){
                $this->aplicacion = $request->message['aplicacion'];
            }
            else{
               $this->aplicacion ='t3l3gr4m';
            }


            if(isset($request->message['from']['first_name']) || ($request->message['from']['first_name'])==''){
                $this->first_name = $request->message['from']['first_name'].' ';  
            }
            else{
                $this->first_name=$request->message['from']['id'];
            }
            if(isset($request->message['from']['last_name']) || ($request->message['from']['last_name'])==''){
                $this->last_name = $request->message['from']['last_name'].' ';
            }
            else{
                $this->last_name = $request->message['from']['id'];
            }
            $this->update_id = $request->update_id;
            $this->message_id = $request->message['message_id'];
            if(isset($request->message['text'])){
                    
                    $this->type = 'app';
                    $this->date = $request->message['date'];
                    $this->chat_id = $request->message['chat']['id'];
                    $this->text = $request->message['text'];
                    $this->tipoarchivo="texto";
            
            }else if(isset($request->message['photo'])){
                    $this->type = $request->message['chat']['type'];
                    $this->date = $request->message['date'];
                    $this->chat_id = $request->message['chat']['id'];
                    $this->fotos[] = $request->message['photo'];
                    $this->tipoarchivo = 'image'; 
                   
                   // $this->enviarData('Imagen',"nada");
            }elseif(isset($request->message['document'])){
                
                    $this->type = $request->message['chat']['type'];
                    $this->date = $request->message['date'];
                    $this->chat_id = $request->message['chat']['id'];
                    $this->document = $request->message['document']; 
                    $this->tipoarchivo = 'document';
                    
                   // $this->enviarData('Documento',"nada");
            }elseif(isset($request->message['video'])){
                
    
                $this->type = $request->message['chat']['type'];
                $this->date = $request->message['date'];
                $this->chat_id = $request->message['chat']['id'];
                $this->document = $request->message['video']; 
                $this->tipoarchivo = 'video';
                
               // $this->enviarData('Documento',"nada");
            }elseif(isset($request->message['contact']['phone_number'])){
                  
                $this->type = 'PEDNU';
                    $this->date = $request->message['date'];
                    $this->chat_id = $request->message['chat']['id'];
                    $this->text = substr($request->message['contact']['phone_number'],3); 
                    $this->tipoarchivo = 'phonecontact';
            }elseif(isset($request->message['location'])){

                $this->type = $request->message['chat']['type'];
                $this->date = $request->message['date'];
                $this->chat_id = $request->message['chat']['id'];
                $this->document = $request->message['location']; 
                $this->tipoarchivo = 'location';
                
               // $this->enviarData('Documento',"nada");
            }

   
            if($this->tipoarchivo == 'image'){

                    $this->Imagenes();
            }elseif($this->tipoarchivo == 'document'){
                $this->Documents();
            }elseif($this->tipoarchivo == 'video'){
                $this->videos();
            }elseif($this->tipoarchivo == 'location'){
                $this->locations();
            }else{  
                $this->masterOp();
            }



        }
        catch(Exception $e){
            //Storage::disk('local')->put('error_telegram.txt',$e);
        
        }
    }
    protected function Documents(){  

        //dd($this->document);
          $dk=$this->document['file_id'];

            $client = new GuzzleHttp\Client();
            $res= $client->request('GET','https://api.telegram.org/bot269874330:AAG1SvGkRFs8x26AxP80KM9cFqOuzvp0d-M/getFile?file_id='.$dk);
            $reponse=json_decode($res->getBody(),true);
        
        
            $this->first_name = 'documentBot';
            $this->last_name = 'documentBot';
            $this->type = 'PROCESO';
            $this->date = 1494449903;

            $archivo =  'https://api.telegram.org/file/bot269874330:AAG1SvGkRFs8x26AxP80KM9cFqOuzvp0d-M/'.$reponse['result']['file_path'];
            $this->tipoarchivo="document";

            $imagen=file_get_contents($archivo);
           
            if($this->document['mime_type']=='application/pdf'){
                $namefile=$this->document['file_unique_id'].'.pdf';
                Storage::put('public/'.$namefile,$imagen, 'public');
            }elseif($this->document['mime_type']=='application/vnd.ms-excel'){
                $namefile=$this->document['file_unique_id'].'.xls';
                Storage::put('public/'.$namefile,$imagen, 'public');
            }elseif($this->document['mime_type']=='application/vnd.openxmlformats-officedocument.wordprocessingml.document'){
                $namefile=$this->document['file_unique_id'].'.doc';
                Storage::put('public/'.$namefile,$imagen, 'public');
            }elseif($this->document['mime_type']=='text/plain'){
                $namefile=$this->document['file_unique_id'].'.txt';
                Storage::put('public/'.$namefile,$imagen, 'public');
            }
            

            $this->text= env('APP_URL').'/storage/'.$namefile;
            
            $this->masterOp();


        

    }
    protected function videos(){  

   
          $dk=$this->document['file_id'];

            $client = new GuzzleHttp\Client();
            $res= $client->request('GET','https://api.telegram.org/bot269874330:AAG1SvGkRFs8x26AxP80KM9cFqOuzvp0d-M/getFile?file_id='.$dk);
            $reponse=json_decode($res->getBody(),true);
        
        
            $this->first_name = 'videoBot';
            $this->last_name = 'videoBot';
            $this->type = 'PROCESO';
            $this->date = 1494449903;

            $this->text =  'https://api.telegram.org/file/bot269874330:AAG1SvGkRFs8x26AxP80KM9cFqOuzvp0d-M/'.$reponse['result']['file_path'];
            $this->tipoarchivo="video";

         
            $this->masterOp();


        

    }
    protected function locations(){  

      
      
          $this->first_name = 'videoBot';
          $this->last_name = 'videoBot';
          $this->type = 'PROCESO';
          $this->date = 1494449903;

          $this->text =  'https://www.google.com/maps/dir/'.$this->document['latitude'].','.$this->document['longitude'];
          $this->tipoarchivo="location";

       
          $this->masterOp();


      

    }
 

    
}
