<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\Models\User;
use GuzzleHttp;
use Session;
use Cookie;
class LoginController extends Controller
{


    use AuthenticatesUsers;


    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }





    public function LoginUser(Request $request){

        $email = $request->input('email');
        $password = $request->input('password');
        $usuario=User::where('email',$email)->first();


        $compare=Hash::check($password,$usuario->password);
        if($compare){
            auth()->login($usuario);
            $client = new GuzzleHttp\Client();

            $res = $client->request('POST','http://vps-d9d562a9.vps.ovh.ca/oauth/token', [
                'auth' => ['angularapp', '12345'],
                'form_params' => [
                    'username' => $email,
                    'password' => $password,
                    'grant_type' => 'password'
                ]
            ]);
            $response=json_decode($res->getBody());
          
            
            $cookie = Cookie::make('token', $response->access_token);
          
            
            return redirect()->route('home')->withCookie($cookie);
         
        }
        else
        {
            
            return back()->withErrors('These credentials do not match our records.');
        }
       
    }


    public function ProviderFacebook()
    {
        
        return Socialite::driver('facebook')->redirect();
    }


    public function CallbackFacebook(){
        $userFacebook = Socialite::driver('facebook')->user();
        $user=User::where('email',$userFacebook->getEmail())->first();
        if(!$user){

            $user = User::create([
                'name'=>$userFacebook->getName(),
                'email'=>$userFacebook->getEmail(),
                'password'=>'',
                'create_at'=>date("Y-m-d"),
                'facebook_id'=>$userFacebook->getId(),
                'avatar'=>$userFacebook->getAvatar(),
                'nick'=>$userFacebook->getNickname(),
            ]);
        }
        

        auth()->login($user);
        $client = new GuzzleHttp\Client();

        $res = $client->request('POST','http://vps-d9d562a9.vps.ovh.ca/oauth/token', [
            'auth' => ['angularapp', '12345'],
            'form_params' => [
                'username' => $email,
                'password' => $password,
                'grant_type' => 'password'
            ]
        ]);
        $response=json_decode($res->getBody());
      
        
        $cookie = Cookie::make('token', $response->access_token);
      
        
        return redirect()->route('home')->withCookie($cookie);
       


        /*
        // All Providers
            $user->getId();
            $user->getNickname();
            $user->getName();
            $user->getEmail();
            $user->getAvatar();
        */
    }


    public function ProviderTwitter(){
        return Socialite::driver('twitter')->redirect();
    }


    public function CallbackTwitter(){
        $userTwitter = Socialite::driver('twitter')->user();
        $user=User::where('email',$userTwitter->getEmail())->first();
        if(!$userTwitter->getEmail()){
           
            $email=($userTwitter->getNickname()."@gmail.com");
        }
        $email=$userTwitter->getEmail();
        if(!$user){

            $user = User::create([
                'name'=>$userTwitter->getName(),
                'email'=>$email,
                'password'=>'',
                'create_at'=>date("Y-m-d"),
                'twitter_id'=>$userTwitter->getId(),
                'avatar'=>$userTwitter->getAvatar(),
                'nick'=>$userTwitter->getNickname(),
            ]);
        }

        auth()->login($user);
        $client = new GuzzleHttp\Client();

        $res = $client->request('POST','http://vps-d9d562a9.vps.ovh.ca/oauth/token', [
            'auth' => ['angularapp', '12345'],
            'form_params' => [
                'username' => $email,
                'password' => $password,
                'grant_type' => 'password'
            ]
        ]);
        $response=json_decode($res->getBody());
      
        
        $cookie = Cookie::make('token', $response->access_token);
      
        
        return redirect()->route('home')->withCookie($cookie);
       
    }


    public function ProviderGoogle(){
        return Socialite::driver('google')->redirect();
    }


    public function CallbackGoogle(){
        $userGoogle = Socialite::driver('google')->user();
        $user=User::where('email',$userGoogle->getEmail())->first();

        if(!$user){

            $user = User::create([
                'name'=>$userGoogle->getName(),
                'email'=>$userGoogle->getEmail(),
                'password'=>'',
                'create_at'=>date("Y-m-d"),
                'google_id'=>$userGoogle->getId(),
                'avatar'=>$userGoogle->getAvatar(),
                'nick'=>$userGoogle->getNickname(),
            ]);
        }

        auth()->login($user);
        $client = new GuzzleHttp\Client();

        $res = $client->request('POST','http://vps-d9d562a9.vps.ovh.ca/oauth/token', [
            'auth' => ['angularapp', '12345'],
            'form_params' => [
                'username' => $email,
                'password' => $password,
                'grant_type' => 'password'
            ]
        ]);
        $response=json_decode($res->getBody());
      
        
        $cookie = Cookie::make('token', $response->access_token);
      
        
        return redirect()->route('home')->withCookie($cookie);
       
    }

    public function ProviderGithub(){
        return Socialite::driver('github')->redirect();
    }


    public function CallbackGithub(){
        $userGithub = Socialite::driver('github')->user();
        if(!$userGithub->getEmail()){
           
            $email=$userGithub->getNickname()."@gmail.com";
        }
        $email=$userGithub->getEmail();
        $user=User::where('email',$userGithub->getEmail())->first();
        if(!$user){


            $user = User::create([
                'name'=>$userGithub->getName(),
                'email'=>$email,
                'password'=>'',
                'create_at'=>date("Y-m-d"),
                'github_id'=>$userGithub->getId(),
                'avatar'=>$userGithub->getAvatar(),
                'nick'=>$userGithub->getNickname(),
            ]);
        }

        auth()->login($user);
        $client = new GuzzleHttp\Client();

        $res = $client->request('POST','http://vps-d9d562a9.vps.ovh.ca/oauth/token', [
            'auth' => ['angularapp', '12345'],
            'form_params' => [
                'username' => $email,
                'password' => $password,
                'grant_type' => 'password'
            ]
        ]);
        $response=json_decode($res->getBody());
      
        
        $cookie = Cookie::make('token', $response->access_token);
      
        
        return redirect()->route('home')->withCookie($cookie);
       
    }

}
