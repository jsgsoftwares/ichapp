<?php

namespace App\Http\Controllers;
use Telegram\Bot\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Models\Integracionbotflow;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp;

use App\Http\Controllers\TelegramController; 
use App\Http\Controllers\FacebookController; 
use App\Http\Controllers\WaboxappController; 

use Carbon\Carbon;
use App\Models\Integracioneswebhook;
use App\Models\Integracionwaping;



use Google\ApiCore\ApiException;
use Google\Cloud\Dialogflow\V2\Intent;
use Google\Cloud\Dialogflow\V2\IntentView;
use Google\Cloud\Dialogflow\V2\IntentsClient;
use Google\Cloud\Dialogflow\V2\Intent_Message;
use Google\Cloud\Dialogflow\V2\Intent_Message_Text;
use Google\Cloud\Dialogflow\V2\Intent_TrainingPhrase;
use Google\Cloud\Dialogflow\V2\Intent_TrainingPhrase_Part;
use Google\Cloud\Dialogflow\V2\AgentsClient;
use Google\Cloud\Dialogflow\V2\SessionsClient;
use Google\Cloud\Dialogflow\V2\TextInput;
use Google\Cloud\Dialogflow\V2\QueryInput;
use Google\Cloud\Dialogflow\V2\Message;
class DialogflowController extends Controller
{
	protected $text;
	protected $telegram;
    public function index()
    {

    }
	public function __construct()
    {
        $this->telegram = new Api(env('TELEGRAM_BOT_TOKEN'));
    }
    public function create()
    {

    }
    public function conversacion($canal,$token,$para,$mensaje,$idmensaje,$proveedor,$companieId){
		
		$url="https://api.dialogflow.com/v1/query?v=20170712";
		$datajson=$this->apidialog($url,$mensaje,$para,$companieId);
	
      	$texto_='';

		
		  foreach ($datajson as $key) 
		  {
			  
			  $texto_ .=$key['text']."\n" .chr(10);
		  }


            $sendtelegram= new TelegramController();
            $sendfacebook= new FacebookController();
			$sendwaboxapp= new WapingController();
			$sendtwitter= new TwitterController();
			$sendinstagram= new InstagramController();

			
			$date= Carbon::now()->format('Ymd');
			$session = DB::table('sessions')
			->join('users', 'sessions.from_id', '=', 'users.id')
			->select('sessions.flujo_id','sessions.mytoken')
			->where('users.chat_id', $para)
			->where('sessions.idkey',$date)
			->where('sessions.state_id',2)
			->first();

			$telegramUser=Integracioneswebhook::where('mytoken',$session->mytoken)->get();
			$compania=$telegramUser[0]->companie_id;
			$token=$telegramUser[0]->token;

		
			if($canal=='telegram'){
				$sendtelegram->sendMessage($token,$texto_,$para,'texto');
            }elseif($canal=='facebook'){
				$sendfacebook->sendMessage($token,$texto_,$para,$idmensaje,'texto');
			}elseif($canal=='whatsapp'){
				$sendwaboxapp->sendMessage($telegramUser[0],$texto_,$para,$idmensaje,'texto');
			}elseif($canal=='twitter'){
				$sendtwitter->sendMessage($para,$texto_);
			}elseif($canal=='instagram'){
				$sendinstagram->sendMessage($para,$texto_);
			}
          
    	//}
    }
 
	public function apidialog($url,$mensaje,$para,$companieId)
	{
        $botApi=Integracionbotflow::where('companie_id',$companieId)->get();
		$token=$botApi[0]->token;
		$projectId=$botApi[0]->project_id;
		$filename=$botApi[0]->filename;
		//dd($botApi[0]->filename);
		return $this->detect_intent_texts($filename,$projectId,$mensaje,$para);
	}
	



	function detect_intent_texts($filename,$projectId, $text, $sessionId, $languageCode = 'en-US'){
        // new session
        $filePath= storage_path('app/public/'.$filename);// public_path(env('GOOGLE_FILE_NAME').'.json');
		
        $test = array('credentials' => $filePath);
		
        
        $sessionsClient = new SessionsClient($test);
       

        $session = $sessionsClient->sessionName($projectId, $sessionId ?: uniqid());
       // printf('Session path: %s' . PHP_EOL, $session);
        
        // create text input
        $textInput = new TextInput();
        $textInput->setText($text);
        $textInput->setLanguageCode($languageCode);
        
        // create query input
        $queryInput = new QueryInput();
        $queryInput->setText($textInput);
       
        // get response and relevant info
        $response = $sessionsClient->detectIntent($session, $queryInput);
		
		$queryResult = $response->getQueryResult();
		
		$queryText = $queryResult->getQueryText();
		
		$intent = $queryResult->getIntent();
		
		$displayName = $intent->getDisplayName();
		
        $confidence = $queryResult->getIntentDetectionConfidence();
		$fulfilmentText = $queryResult->getFulfillmentText();
		$fulfilmentMessages=$response
					->getQueryResult()
					->getFulfillmentMessages();

					$output = [];
					foreach ($fulfilmentMessages as $number => $message) {
						switch ($message->getMessage()) {
							case 'text':
								$output[] = ['text' => $message->getText()->getText()->offsetGet(0)];
								break; 
							case 'card':
								$card = $message->getCard();
								$buttons = [];
								foreach ($card->getButtons() as $button) {
									 $buttons[] = [
										 'text' => $button->getText(),
										 'postback' => $button->getPostback()
									 ];
								 }
								 $output[] = ['card' => [
									'title' => $card->getTitle(),
									'subtitle' => $card->getSubTitle(),
									'image' => $card->getImageUri(),
									'buttons' => $buttons
								 ]];
								 break;
						  }
					}
       

		$sessionsClient->close();
		return $output;
	}
	
	public function prueba(){
		$retorno=$this->detect_intent_texts('vicky-cbuqyy-1435ccc17680.json','vicky-cbuqyy','hola','123456');
		$texto_='';
		foreach ($retorno as $key) 
		{
			//print_r($key['text']."\n" .chr(10));
			$texto_ .=$key['text']."\n" .chr(10);
		}
		//dd($texto_);
	
	}
	/* public function apidialog2($url,$mensaje,$para,$companieId){
        $botApi=Integracionbotflow::where('companie_id',$companieId)->get();
		$token=$botApi[0]->token;
		
		$json_d=[
			'lang'=>'en',
			'query'=>$mensaje,
			'sessionId'=>$para,
			'timezone'=>'America/Panama'
			
		];
		//dd($token);

        $client = new GuzzleHttp\Client();
        $res= $client->request('POST',$url,[
            'headers' => [
                'authorization'=>'Bearer '.$token,
                'cache-control'=>'no-cache',
                'content-type'=>'application/json'

            ],
            'json'=>$json_d
    
          ]);
        $response=$res->getBody();
        return $response;

	} */

}
