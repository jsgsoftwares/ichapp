<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use GuzzleHttp;
use Storage;
use App\instagram;
class InstagramController extends Controller
{
    //

    public function index(Request $request)
    {
       

        
       
        $existe=DB::table('instagrams')->where('item_id',$request->item_id)->get();
        if(count($existe)<1)
        {
         
            $insta=new instagram();
            $insta->user_id=$request->id;
            $insta->username=$request->username;
            $insta->fullname=$request->fullname;
            $insta->item_id=$request->item_id;
            $insta->timestamp=$request->timestamp;
            $insta->typemessage=$request->item_type;
            $insta->message=$request->text;
            $insta->save();
            return 'true';
        }
        
       
        
          //  Storage::disk('local')->put(date("YmdHisuv").'instagram_.txt',($request));
        
        
        
    }

    public function sendMessage($user,$mensaje)
    {
         /////// CONFIG ///////
        $username = 'voixbot';
        $password = 'An1od3lc0n3j0';
        $debug = true;
        $truncatedDebug = false;
        //////////////////////
         //////////////////////
         \InstagramAPI\Instagram::$allowDangerousWebUsageAtMyOwnRisk = true;
        $ig = new \InstagramAPI\Instagram($debug, $truncatedDebug);
        
        try {
            $ig->login($username, $password);
        } catch (\Exception $e) {
            echo 'Something went wrong: '.$e->getMessage()."\n";
            exit(0);
        }
		
		$directs = $ig->direct->sendText(['users'=>array($user)],$mensaje);
    }

    public function getMessage()
    {
          /////// CONFIG ///////
          $username = 'voixbot';
          $password = 'An1od3lc0n3j0';
          $debug = true;
          $truncatedDebug = false;
          //////////////////////
           //////////////////////
          print_r('******************************************************************');
          print_r('******************************************************************');
          print_r('******************************************************************');
          print_r('******************************************************************');
          print_r('******************************************************************');
          \InstagramAPI\Instagram::$allowDangerousWebUsageAtMyOwnRisk = true;
          $ig = new \InstagramAPI\Instagram($debug, $truncatedDebug);
          
          try {
              $ig->login($username, $password);
          } catch (\Exception $e) {
              echo 'Something went wrong: '.$e->getMessage()."\n";
              exit(0);
          }
          print_r('--------------------------------------------------------------------');
          print_r('--------------------------------------------------------------------');
          print_r('--------------------------------------------------------------------');
          print_r('--------------------------------------------------------------------');
          print_r('--------------------------------------------------------------------');
          $data=[];
          $user=[];
          $message=[];
          $id;
          $username;
          $fullname;
          $item_id;
          $timestamp;
          $item_type;
          $text;
  
          $directs = $ig->direct->getInbox();
          $threads=$directs->getInbox()->getThreads();
          
          foreach($threads as $thread) {
               $threadItems = $thread->getItems();
              
  
                  $key= $thread->getUsers()[0];
                  $id=$key->getPk();
                  $username=$key->getUsername();
                  $fullname=$key->getFull_name();
  
                  //array_push($user,array('id'=>$key->getPk(),'username'=>$key->getUsername(),'fullname'=>$key->getFull_name()));
                  //print_r($threadItems);
                foreach($threadItems as $threadItem) {
                    if ($threadItem->getText() !== null && $id==$threadItem->getUser_id()) {
  
                     $item_id=$threadItem->getItem_id();
                     $timestamp=$threadItem->getTimestamp();
                     $item_type=$threadItem->getItem_type();
                     $text=$threadItem->getText();
  
                      array_push($data,array('id'=>$id,'username'=>$username,'fullname'=>$fullname,'item_id'=>$item_id,'timestamp'=>$timestamp,'item_type'=>$item_type,'text'=>$text));
                      
                      $client = new GuzzleHttp\Client();
                      $res= $client->request('POST',env('APP_URL').'668803720/api/insta',[
                      'headers' => ['content-type'=>'application/json'],
                      'json'=>['id'=>$id,'username'=>$username,'fullname'=>$fullname,'item_id'=>$item_id,'timestamp'=>$timestamp,'item_type'=>$item_type,'text'=>$text]
                      ]);
                    }
                     
                    // $data["message"]=array($message);
               }
           }
    }
    
}