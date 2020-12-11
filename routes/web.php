<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/', function () {
    if (Auth::user()){
        if(Auth::user()->rol_id>3){
            return redirect('chat');
        }else{
            return redirect('dashboard');
        }
        
         

     }else{
        return view('welcome');
     }
   
})->name('inicio');

Route::get('/home', function () {
    if (Auth::user()){
        if(Auth::user()->rol_id>3){
            return redirect('chat');
        }else{
            return redirect('dashboard');
        }
        
         

     }else{
        return view('welcome');
     }
   
})->name('inicio');



Auth::routes();

/* Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home'); */
Route::get('/dashboard', [App\Http\Controllers\ChatController::class, 'dashboard'])->name('dashboard');


Route::get('api/Dashcantusers', [App\Http\Controllers\DashboardController::class,'CantUser']);
Route::get('api/Dashconsultas', [App\Http\Controllers\DashboardController::class,'tipoConsultas']);
Route::get('api/DashMensajes', [App\Http\Controllers\DashboardController::class,'MensajesRecibidos']);



Route::get('/chat/{conversationId}', [App\Http\Controllers\ChatController::class,'index']);
Route::get('/chat', [App\Http\Controllers\ChatController::class,'index'])->name('chat');
//pruebas
Route::get('/prueba', function () {
    return view('prueba');
});
Route::get('/consult', function () {
    return view('consultas');
});
Route::get('api/servicios', [App\Http\Controllers\MensajesPredeterminadosController::class,'servicioinicial']);
//CANALES
Route::get('get-me', [App\Http\Controllers\TelegramController::class,'getMe']);
Route::get('set-hook', [App\Http\Controllers\TelegramController::class,'setWebHook']);

Route::post('668803720/pruebaTel', [App\Http\Controllers\FlujosController::class,'index']);

Route::post('668803720/telegram', [App\Http\Controllers\TelegramController::class,'handleRequest']);
Route::post('668803720/facebook',[App\Http\Controllers\FacebookController::class,'handleRequest']);

/* Route::post('Seguros/facebook',[App\Http\Controllers\FacebookController::class,'handleRequest'); */


/* Route::post('668803720/twitter','ChatController::class,'handleRequest'); */

Route::post('668803720/webhook',[App\Http\Controllers\WebhookController::class,'receptor']);
Route::get('668803720/index',[App\Http\Controllers\WebhookController::class,'index']);
Route::post('668803720/twitter', [App\Http\Controllers\vTwitterController::class,'webhook']);

Route::post('668803720/fullfillment',[App\Http\Controllers\FullfillmentController::class,'Fulfillment']);




//TWITTE
Route::get('api/twitter/getMessageDm', [App\Http\Controllers\TwitterController::class,'getMessageDm']);
Route::get('api/twitter/sendmessage/{user}/{content}', [App\Http\Controllers\TwitterController::class,'sendMessage']);
Route::get('api/twitter/delete/{id}',[App\Http\Controllers\TwitterController::class,'delete']);
Route::get('api/twitter/test',[App\Http\Controllers\TwitterController::class,'test']);
//USER
Route::get('api/user', [App\Http\Controllers\CanalesController::class,'user']);
Route::get('api/mensajespre', [App\Http\Controllers\MensajesPredeterminadosController::class,'index']);

//BUSCAR CONVERSACIONES
Route::get('api/search_conversation',[App\Http\Controllers\SessionController::class,'conversations']);

//pruebas
Route::get('api/conversations/3', [App\Http\Controllers\ConversationController::class,'prueba']);


//SERIVICIOS INICIALES

Route::get('api/agentes', [App\Http\Controllers\TranferenciasController::class,'searchAgent']);


Route::get('api/conversations', [App\Http\Controllers\ConversationController::class,'index']);

Route::get('api/canalesclientes', [App\Http\Controllers\ClientesCanalController::class,'canales_p']);

//PAISES
Route::get('api/paises', [App\Http\Controllers\PaisesController::class,'index']);
//GENEROS
Route::get('api/generos', [App\Http\Controllers\GeneroController::class,'index']);
//Documentos
Route::get('api/documentos', [App\Http\Controllers\DocumentoController::class,'index']);

//MENSAJES
Route::get('api/messages', [App\Http\Controllers\MessageController::class,'index']);
Route::post('api/messages', [App\Http\Controllers\MessageController::class,'store']);
//CONSULTAS
Route::get('api/consultas', [App\Http\Controllers\ConsultasController::class,'index']);
Route::get('api/typeconsultas', [App\Http\Controllers\TipoConsultasController::class,'index']);
Route::post('api/consultas', [App\Http\Controllers\ConsultasController::class,'store']);
//CLIENTES
Route::get('api/clientes', [App\Http\Controllers\ClienteschatController::class,'index']);
Route::post('api/clientes', [App\Http\Controllers\ClienteschatController::class,'update']);
Route::post('api/enlazarclientes', [App\Http\Controllers\ClienteschatController::class,'enlazar']);
Route::post('api/addClienteNew', [App\Http\Controllers\ClienteschatController::class,'addClienteNew']);

//CLIENTES_CANAL
Route::post('api/clientesinformacion', [App\Http\Controllers\ClientesCanalController::class,'index']);
Route::post('api/canalescliente', [App\Http\Controllers\ClientesCanalController::class,'canales']);



Route::post('api/transferir_chat', [App\Http\Controllers\TranferenciasController::class,'transfer']);

Route::get('/api/search_messages', [App\Http\Controllers\MessageController::class,'buscar_conversation']);


Route::post('668803720/api/webhook',[App\Http\Controllers\WebhookController::class,'entradas']);
Route::get('668803720/api/webhook',[App\Http\Controllers\WebhookController::class,'entradas']);

Route::get('668803720/api/chagestate',[App\Http\Controllers\SessionController::class,'chagestate']);

Route::post('668803720/api/insta',[App\Http\Controllers\InstagramController::class,'index']);

Route::get('668803720/api/instaSendmessage/{user}/{mensaje}',[App\Http\Controllers\InstagramController::class,'sendMessage']);
Route::get('668803720/api/instagetMessage',[App\Http\Controllers\InstagramController::class,'getMessage']);


Route::post('api/upload',[App\Http\Controllers\WaboxappController::class,'prueba']);
Route::post('api/validate',[App\Http\Controllers\WaboxappController::class,'validar']);
Route::post('pusher/auth',[App\Http\Controllers\WaboxappController::class,'pusher']);

//pruebas de waping server
Route::post('api/waping',[App\Http\Controllers\WaboxappController::class,'waping']);

//Route::post('668803720/waboxapp','WaboxappController::class,'handleRequest');
Route::post('668803720/waboxapp',[App\Http\Controllers\WapingController::class,'entrada']);
Route::post('668803720/waping',[App\Http\Controllers\WapingController::class,'entrada']);

Route::post('api/upload',[App\Http\Controllers\MessageController::class,'upload']);
//Route::post('api/v1/upload/json','IntegracioneswebhookController::class,'upload');

Route::get('storage/{filename}', function ($filename)
{
    $path = storage_path('app/public/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});

Route::get('get/usuarios/companie/{user_id}',[App\Http\Controllers\UsersCompaniesController::class,'getUsers']);
Route::get('get/usuario/{user_id}',[App\Http\Controllers\UsersCompaniesController::class,'obtenerUsuario']);
Route::get('get/companie/{user_id}',[App\Http\Controllers\UsersCompaniesController::class,'getcompanie']);
Route::get('get/rol',[App\Http\Controllers\UsersCompaniesController::class,'getRoles']);



//LOGIN POR REDES SOCIALES

//FACEBOOK
Route::get('login/facebook', [App\Http\Controllers\Auth\LoginController::class,'ProviderFacebook'])->name('login.facebook');
Route::get('login/facebook/callback', [App\Http\Controllers\Auth\LoginController::class,'CallbackFacebook']);
//TWITTER
Route::get('login/twitter', [App\Http\Controllers\Auth\LoginController::class,'ProviderTwitter'])->name('login.twitter');
Route::get('login/twitter/callback', [App\Http\Controllers\Auth\LoginController::class,'CallbackTwitter']);
//GOOGLE
Route::get('login/google', [App\Http\Controllers\Auth\LoginController::class,'ProviderGoogle'])->name('login.google');
Route::get('login/google/callback', [App\Http\Controllers\Auth\LoginController::class,'CallbackGoogle']);
//GITHUB
Route::get('login/github', [App\Http\Controllers\Auth\LoginController::class,'ProviderGithub'])->name('login.github');
Route::get('login/github/callback', [App\Http\Controllers\Auth\LoginController::class,'CallbackGithub']);
