<?php

        require __DIR__.'../vendor/autoload.php';
     
        use GuzzleHttp\Client;








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
                    $res= $client->request('POST','http://voixbot.bot:8190/668803720/api/insta',[
                    'headers' => ['content-type'=>'application/json'],
                    'json'=>['id'=>$id,'username'=>$username,'fullname'=>$fullname,'item_id'=>$item_id,'timestamp'=>$timestamp,'item_type'=>$item_type,'text'=>$text]
                    ]);
		          }
                   
                  // $data["message"]=array($message);
		     }
         }
            
             
                    


        
           // envio("http://voixbot.bot:8190/668803720/api/insta",$data);
             function envio($URL, $fieldString) 
            {
                $curl = curl_init();

                    curl_setopt_array($curl, array(
                    CURLOPT_URL => $URL,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS =>$fieldString,
                    CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json"
                     ),
                     ));

                $response = curl_exec($curl);

                curl_close($curl);

            }