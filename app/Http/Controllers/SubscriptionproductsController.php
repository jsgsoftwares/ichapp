<?php

namespace App\Http\Controllers;


use DB;
use App\Models\Plan;
use App\Models\User;
use App\Models\Companie;
use Carbon\Carbon;
use App\Models\Subscripcion;
use App\Models\planesmigraciones;
use App\Models\subscriptionproducts;

use Illuminate\Http\Request;

class SubscriptionproductsController extends Controller
{
    //

    function subscriptions($userid){
        $usuario=User::where('id',$userid)->first();
        $companie=Companie::where('id',$usuario->companie_id)->first();
            $sub=subscriptionproducts::where('companie_id',$companie->id)->get();
            return($sub);
    }

    function planes(){

        return Plan::where('status','active')->get();
    }
    function planSubscrito(Request $request){

        $chat = User::where('id', $request->user_id)->first();
        $productos=subscriptionproducts::where('companie_id',$chat->companie_id)
        ->where('enabled',1)
        ->get();
        
        return ($productos);

    }
    function planCompanie(Request $request){

        $date= Carbon::today();

        $chat = User::where('id', $request->user_id)->first();
        $productos=DB::table('subscripcions')
        ->join('plans','subscripcions.plan_id', '=', 'plans.id')
        ->select('subscripcions.*','plans.name','plans.plan_code','plans.monthly_price')
        ->where('companie_id',$chat->companie_id)
        ->where('migrate',0)
        ->get();
        return ($productos);

    }
    function cancelarSubscription(Request $request){
       


        $date= Carbon::today();

        $chat = User::where('id', $request->user_id)->first();//obtener datos de usuario y compania
        $subcription=DB::table('subscripcions')
        ->join('plans','subscripcions.plan_id', '=', 'plans.id')
        ->select('subscripcions.*','plans.name','plans.plan_code','plans.monthly_price')
        ->where('companie_id',$chat->companie_id)
        ->where('migrate',0)
        ->first();//subscripcion actual


        $token=json_decode($this->obtenerTokenPaypal());

        $dtsupc = Carbon::parse($subcription->started_at);
        $diaSub=$dtsupc->day;
        $mesSub=$dtsupc->month;
        $anioSub=$dtsupc->year;
        $dtsupc->hour=0;
        $dtsupc->minute=0;
        $dtsupc->second=0;

        $mainfecha=Carbon::now();
        $mainfecha->hour=0;
        $mainfecha->minute=0;
        $mainfecha->second=0;


        $verif=Carbon::now();
     
        $verif->day=$diaSub;
        $verif->hour=0;
        $verif->minute=0;
        $verif->second=0;
        if($mainfecha<=$verif){
            if($mainfecha==$verif){
                $verif=Carbon::now();
                $verif->month=$verif->month+1;
                $verif->day=$diaSub;
                $verif->hour=0;
                $verif->minute=0;
                $verif->second=0;
                $cancelacion=$this->cancelpaypalsubscription($subcription->subscription_id,$token->access_token);
                $sub=Subscripcion::where('id',$subcription->id)
                ->update(['renewal_cancelled_at'=>$date,'finish_at'=>$verif]);
                $this->crearSubscriptionesCrontab();
                return ['states' => 'susccessfully']; 
              
                //print_r($mainfecha.' -- se elimna hoy-- '.$verif.'  fecha en base  '.$dtsupc);
            }
            else{
                $cancelacion=$this->cancelpaypalsubscription($subcription->subscription_id,$token->access_token);
                $sub=Subscripcion::where('id',$subcription->id)
                ->update(['renewal_cancelled_at'=>$date,'finish_at'=>$verif]);
                return ['states' => 'susccessfully']; 
                //print_r($mainfecha.' -- se elimna este mes-- '.$verif.'  fecha en base  '.$dtsupc);

            }
            
        }
        else{
            $verif=Carbon::now();
            $verif->month=$verif->month+1;
            $verif->day=$diaSub;
            $verif->hour=0;
            $verif->minute=0;
            $verif->second=0;
            $cancelacion=$this->cancelpaypalsubscription($subcription->subscription_id,$token->access_token);
            $sub=Subscripcion::where('id',$subcription->id)
                ->update(['renewal_cancelled_at'=>$date,'finish_at'=>$verif]);
            return ['states' => 'susccessfully']; 
        }
        


        

       /*  $cancelacion=$this->cancelpaypalsubscription($subcription->subscription_id,$token->access_token);

        print_r($cancelacion);

        $sub=Subscripcion::where('id',$subcription->id)
        ->update(['renewal_cancelled_at'=>$date]);
        $this->crearSubscriptionesCrontab();
        return ['states' => 'susccessfully']; */




    }

    function crearSubscriptionesCrontab()
    {        
        $date= Carbon::today();
  
        $subscription=Subscripcion::where('finish_at',$date)
        ->where('migrate',0)
        ->get();

        foreach($subscription as $item){

            $sub=Subscripcion::where('id',$item->id)
            ->update(['migrate_at' => $date,'migrate'=>1]);
            

            $m=new planesmigraciones;
            $m->companie_id=$item->companie_id;
            $m->from_plan_id=$item->plan_id;
            $m->to_plan_id=2;
            $m->requested_at=$item->renewal_cancelled_at;
            $m->execution_at=$date;
            $m->save();

            $subscription_new=new Subscripcion;
            $subscription_new->companie_id=$item->companie_id;
            $subscription_new->plan_id=2;
            $subscription_new->started_at=$date;
            $subscription_new->finish_at=$date->addMonth();
            $subscription_new->save();

            $sub=subscriptionproducts::where('companie_id',$item->companie_id)
            ->update(['enabled' => 0,'request_cancelled_at'=>$item->renewal_cancelled_at]);

            DB::table('subscriptionproducts')->insert([
                ['companie_id' => $item->companie_id,'plan_id'=>2, 'product_id' => 1,'cantidad'=>1,'enabled'=>1,'request_add_at'=>$date],
                ['companie_id' => $item->companie_id,'plan_id'=>2, 'product_id' => 4,'cantidad'=>1,'enabled'=>1,'request_add_at'=>$date],
                ['companie_id' => $item->companie_id,'plan_id'=>2, 'product_id' => 5,'cantidad'=>1,'enabled'=>1,'request_add_at'=>$date],             
            ]);

            $this->deshabilitarUsuariosRestantes($item->companie_id);

           //$date->addMonth()
           // $mig=planesmigraciones::where()
          



        }


        return ($subscription);
    }

    function crearSubscritionUsuario(Request $request){
 
        $date= Carbon::today();
        $mes_siguiente=Carbon::now();
        $mes_siguiente->month=$mes_siguiente->month+1;

        $iddialog=0;
        $idwaping=0;
        $contador_usuarios=0;
        
        $chat = User::where('id', $request->body["user_id"])->first();//obtener datos de usuario y compania
        
        $subcription=DB::table('subscripcions')
        ->join('plans','subscripcions.plan_id', '=', 'plans.id')
        ->select('subscripcions.*','plans.name','plans.plan_code','plans.monthly_price')
        ->where('companie_id',$chat->companie_id)
        ->where('migrate',0)
        ->first();//subscripcion actual
        
        

        $plan=Plan::where('status','active')->where('plan_code',$request->body['plan_actual'])->first();

        if($plan->id!=$subcription->plan_id){
                $sub=Subscripcion::where('id',$subcription->id)
                ->update(['migrate_at' => $date,'migrate'=>1,'renewal_cancelled_at'=>$date]);


                $m=new planesmigraciones;
                $m->companie_id=$subcription->companie_id;
                $m->from_plan_id=$subcription->plan_id;
                $m->to_plan_id=$plan->id;
                $m->requested_at=$date;
                $m->execution_at=$date;
                $m->save();

                $subscription_new=new Subscripcion;
                $subscription_new->companie_id=$subcription->companie_id;
                $subscription_new->plan_id=$plan->id;
                $subscription_new->started_at=$date;
                $subscription_new->subscription_id=$request->subscritor;
                $subscription_new->finish_at=$mes_siguiente;
                $subscription_new->save();

                $productDisable=subscriptionproducts::where('companie_id',$chat->companie_id)
                ->where('enabled',1)
                ->update(['enabled' => 0,'request_cancelled_at'=>$date]);

                $creacompra=[];
                for($i=$contador_usuarios; $i<$request->body['cant_users']; $i++)
                {
                    array_push($creacompra,[
                    'companie_id' => $chat->companie_id, 
                    'product_id' => 1,
                    'cantidad'=>1,
                    'plan_id'=>$plan->id,
                    'enabled'=>1,
                    'request_add_at'=>$date,
                    'created_at'=>$date
                    ]
                    );
                }
                array_push($creacompra,[
                'companie_id' => $chat->companie_id, 
                'product_id' => 4,
                'cantidad'=>1,
                'plan_id'=>$plan->id,
                'enabled'=>1,
                'request_add_at'=>$date,
                'created_at'=>$date
                ]);
                array_push($creacompra,[
                'companie_id' => $chat->companie_id, 
                'product_id' => 5,
                'cantidad'=>1,
                'plan_id'=>$plan->id,
                'enabled'=>1,
                'request_add_at'=>$date,
                'created_at'=>$date
                ]);

                if($request->body['dialogflow']==1){
                array_push($creacompra,[
                'companie_id' => $chat->companie_id, 
                'product_id' => 2,
                'cantidad'=>1,
                'plan_id'=>$plan->id,
                'enabled'=>1,
                'request_add_at'=>$date,
                'created_at'=>$date
                ]);

                }
                if($request->body['waping']==1){
                array_push($creacompra,[
                'companie_id' => $chat->companie_id, 
                'product_id' => 3,
                'cantidad'=>1,
                'plan_id'=>$plan->id,
                'enabled'=>1,
                'request_add_at'=>$date,
                'created_at'=>$date
                ]);

                }

                DB::table('subscriptionproducts')->insert($creacompra);



                return $subscription_new;
        }
        else{

            $productDisable=subscriptionproducts::where('companie_id',$chat->companie_id)
            ->where('enabled',1)
            ->update(['enabled' => 0,'request_cancelled_at'=>$date]);

            $creacompra=[];
            for($i=$contador_usuarios; $i<$request->body['cant_users']; $i++)
            {
                array_push($creacompra,[
                'companie_id' => $chat->companie_id, 
                'product_id' => 1,
                'cantidad'=>1,
                'plan_id'=>$plan->id,
                'enabled'=>1,
                'request_add_at'=>$date,
                'created_at'=>$date
                ]
                );
            }
            array_push($creacompra,[
            'companie_id' => $chat->companie_id, 
            'product_id' => 4,
            'cantidad'=>1,
            'plan_id'=>$plan->id,
            'enabled'=>1,
            'request_add_at'=>$date,
            'created_at'=>$date
            ]);
            array_push($creacompra,[
            'companie_id' => $chat->companie_id, 
            'product_id' => 5,
            'cantidad'=>1,
            'plan_id'=>$plan->id,
            'enabled'=>1,
            'request_add_at'=>$date,
            'created_at'=>$date
            ]);

            if($request->body['dialogflow']==1){
            array_push($creacompra,[
            'companie_id' => $chat->companie_id, 
            'product_id' => 2,
            'cantidad'=>1,
            'plan_id'=>$plan->id,
            'enabled'=>1,
            'request_add_at'=>$date,
            'created_at'=>$date
            ]);

            }
            if($request->body['waping']==1){
            array_push($creacompra,[
            'companie_id' => $chat->companie_id, 
            'product_id' => 3,
            'cantidad'=>1,
            'plan_id'=>$plan->id,
            'enabled'=>1,
            'request_add_at'=>$date,
            'created_at'=>$date
            ]);

            }

            DB::table('subscriptionproducts')->insert($creacompra);

            $this->deshabilitarUsuariosRestantes($chat->companie_id);

            return ["State"=>"update","message"=>"Product update successfully"];
        }
        

    }

    function ActualizarProductos(){

    }


    function planTrialAdd($companie){
                
        $date= Carbon::today();
        $iddialog=0;
        $idwaping=0;
        $idtelegram=0;
        $idfacebook=0;
        $contador_usuarios=0;
        $sub=subscriptionproducts::where('companie_id',$companie)
        ->where('enabled',1)
        ->get();


        //id=1 usuarios ,id=2 dialogflow, id=3 waping.
        foreach($sub as $items){
            if($items->product_id==1)
            {
                $contador_usuarios+=1;
            } 
            elseif($items->product_id==2){
                $iddialog=$items->id;
            }
            elseif($items->product_id==3){
                $idwaping=$items->id;
            }
            elseif($items->product_id==4){
                $idtelegram=$items->id;
            }
            elseif($items->product_id==5){
                $idfacebook=$items->id;
            }
        }

       
        // ['companie_id' => $item->companie_id, 'product_id' => 1,'cantidad'=>1,'enabled'=>1,'request_add_at'=>$date],
        $creacompra=[];
        for($i=$contador_usuarios; $i<$request->cant_users; $i++)
        {
            array_push($creacompra,['companie_id' => $chat->companie_id, 'product_id' => 1,'cantidad'=>1,'enabled'=>1,'request_add_at'=>$date]
        );
        }
        if($request->dialogflow==1 and $iddialog==0){
            array_push($creacompra,['companie_id' => $chat->companie_id, 'product_id' => 2,'cantidad'=>1,'enabled'=>1,'request_add_at'=>$date]);
      
        }
        elseif ($request->dialogflow==0 and $iddialog!=0 ) {
            $sub=subscriptionproducts::where('id',$iddialog)
            ->update(['enabled' => 0]);

        }
        if($request->waping==1 and $idwaping==0){
            array_push($creacompra,['companie_id' => $chat->companie_id, 'product_id' => 3,'cantidad'=>1,'enabled'=>1,'request_add_at'=>$date]);
      
        }
        elseif ($request->waping==0 and $iddialog!=0 ) {
            $sub=subscriptionproducts::where('id',$iddialog)
            ->update(['enabled' => 0]);

        }
        if($request->telegram==1 and $idtelegram==0){
            array_push($creacompra,['companie_id' => $chat->companie_id, 'product_id' => 3,'cantidad'=>1,'enabled'=>1,'request_add_at'=>$date]);
      
        }
        elseif ($request->telegram==0 and $idtelegram!=0 ) {
            $sub=subscriptionproducts::where('id',$iddialog)
            ->update(['enabled' => 0]);

        }
      dd($creacompra);
    }


    function creaPlanTrial(){
            $chat = User::where('id', $request->user_id)->first();
            $date= Carbon::today();
            DB::table('subscriptionproducts')->insert([
                ['companie_id' => $chat->companie_id, 'product_id' => 1,'cantidad'=>1,'enabled'=>1,'request_add_at'=>$date],
                ['companie_id' => $chat->companie_id, 'product_id' => 2,'cantidad'=>1,'enabled'=>1,'request_add_at'=>$date],
                ['companie_id' => $chat->companie_id, 'product_id' => 3,'cantidad'=>1,'enabled'=>1,'request_add_at'=>$date],             
                ['companie_id' => $chat->companie_id, 'product_id' => 4,'cantidad'=>1,'enabled'=>1,'request_add_at'=>$date],
                ['companie_id' => $chat->companie_id, 'product_id' => 5,'cantidad'=>1,'enabled'=>1,'request_add_at'=>$date],             
            ]);

        }


    function obtenerTokenPaypal(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.sandbox.paypal.com/v1/oauth2/token",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "grant_type=client_credentials",
        CURLOPT_HTTPHEADER => array(
            "Authorization: Basic QWQxT0ZoNmZOemRFcVB2S3FSSEdMNXFfNzBLN0NjRDVHV2dRWW8yVGthWHRQM1ZJX0Q3Y3J6RkhtRWZ5RkNnYjIwWDZHZ2ZLYUptblRpc0c6RVBDMHJBd0hEaEFnQTM3TUZndEFhc1pyb3p0RFZ4djhhQlpGelI5STRvTHZwd1JldWl4cnh5ak9ON3lucnVBNFRzSmhxRE5ZY2lmMTMtS3c=",
            "Content-Type: application/x-www-form-urlencoded",
            "Cookie: enforce_policy=ccpa; ts_c=vr%3D46b22d391750a48f13e6d21afde9208f%26vt%3D46b22d391750a48f13e6d21afde9208e; cookie_check=yes; cookie_prefs=P%3D1%2CF%3D1%2Ctype%3Dimplicit; ts=vreXpYrS%3D1699692143%26vteXpYrS%3D1605023166%26vr%3D46b22d391750a48f13e6d21afde9208f%26vt%3Db2ba7a54175ac120001c8c81fff4fa9d%26vtyp%3Dnew"
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return ($response);
    }

    function cancelpaypalsubscription($subscriptor,$token){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api-m.sandbox.paypal.com/v1/billing/subscriptions/".$subscriptor."/cancel",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "Authorization: Bearer ".$token,
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

//MODIFICACION DE USUARIOS
    function CantUsuariosSubscritos(Request $request){
    
        $chat = User::where('id', $request->user_id)->first();
        $this->deshabilitarUsuariosRestantes($chat->companie_id);
        $productos=subscriptionproducts::where('companie_id',$chat->companie_id)
        ->where('enabled',1)
        ->where('product_id',1)
        ->get();

        $usuarios=User::where('companie_id',$chat->companie_id)
        ->where('enabled',1)
        ->get();
        $status=count($productos);
        if(count($productos)>count($usuarios)){
            
            $status=count($productos)-count($usuarios);
           // return $this->habilitarUsuariosRestantes($chat->companie_id,$status);
      
            //
        }
        else {
            
            $status=count($productos)-count($usuarios);
            $this->deshabilitarUsuariosRestantes($chat->companie_id);
        }
      
         return array(
            'status'=>'success',
            'CantusuariosSubscrito'=>count($productos),
            'usuarioActivos'=>count($usuarios),
            'usuariosPendientes'=>$status
        ); 
    
    }

    function deshabilitarUsuariosRestantes($companie_id){
        $productos=subscriptionproducts::where('companie_id',$companie_id)
        ->where('enabled',1)
        ->where('product_id',1)
        ->get();

        $usuarios=User::where('companie_id',$companie_id)
        ->where('enabled',1)
        ->orderBy('id', 'DESC')
        ->get();
        
        if(count($productos)<count($usuarios)){
            $contador=0;
            $sobreusuarios=count($productos)-count($usuarios);

            foreach($usuarios as $valor){
                $contador++;
                if($contador<=($sobreusuarios*-1)){

                 
                   $sub=User::where('id',$valor->id)
                    ->update(['enabled' => 0,'state_id'=>10]);
    
                }

            }
           // $status=count($productos)-count($usuarios);
            
        }



    }
    function habilitarUsuariosRestantes($companie_id,$cantidad){


        $usuarios=User::where('companie_id',$companie_id)
        ->where('enabled',0)
        ->orderBy('id', 'ASC')
        ->get();

        $contador=0;
        foreach($usuarios as $valor){
            $contador++;
            if($contador<=$cantidad){

               
               $sub=User::where('id',$valor->id)
                ->update(['enabled' => 1,'state_id'=>2]); 

            }

        }

    }

    function deshabilitarUsuario(Request $request){

        $sub=User::where('id',$request->user_id)
        ->update(['enabled' => 0,'state_id'=>10]);
        return array("status"=>$sub);
    }

    function habilitarUsuario(Request $request){

        $sub=User::where('id',$request->user_id)
        ->update(['enabled' => 1,'state_id'=>2]);
        return array("status"=>$sub);
    }

}


