<?php

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

Auth::routes();
//CONVERSACIONES

Route::get('/dashboard', 'ChatController@dashboard')->name('dashboard');

Route::get('api/Dashcantusers', 'DashboardController@CantUser');
Route::get('api/Dashconsultas', 'DashboardController@tipoConsultas');
Route::get('api/DashMensajes', 'DashboardController@MensajesRecibidos');



Route::get('/chat/{conversationId}', 'ChatController@index');
Route::get('/chat', 'ChatController@index')->name('chat');
//pruebas
Route::get('/prueba', function () {
    return view('prueba');
});
Route::get('/consult', function () {
    return view('consultas');
});
Route::get('api/servicios', 'MensajesPredeterminadosController@servicioinicial');
//CANALES
Route::get('get-me', 'TelegramController@getMe');
Route::get('set-hook', 'TelegramController@setWebHook');

Route::post('668803720/pruebaTel', 'FlujosController@index');

Route::post('668803720/telegram', 'TelegramController@handleRequest');
Route::post('668803720/facebook','FacebookController@handleRequest');

/* Route::post('Seguros/facebook','FacebookController@handleRequest'); */


/* Route::post('668803720/twitter','ChatController@handleRequest'); */

Route::post('668803720/webhook','WebhookController@receptor');
Route::get('668803720/index','WebhookController@index');
Route::post('668803720/twitter', 'TwitterController@webhook');

Route::post('668803720/fullfillment','FullfillmentController@Fulfillment');




//TWITTE
Route::get('api/twitter/getMessageDm', 'TwitterController@getMessageDm');
Route::get('api/twitter/sendmessage/{user}/{content}', 'TwitterController@sendMessage');
Route::get('api/twitter/delete/{id}','TwitterController@delete');
Route::get('api/twitter/test','TwitterController@test');
//USER
Route::get('api/user', 'CanalesController@user');
Route::get('api/mensajespre', 'MensajesPredeterminadosController@index');

//BUSCAR CONVERSACIONES
Route::get('api/search_conversation','SessionController@conversations');

//pruebas
Route::get('api/conversations/3', 'ConversationController@prueba');


//SERIVICIOS INICIALES

Route::get('api/agentes', 'TranferenciasController@searchAgent');


Route::get('api/conversations', 'ConversationController@index');

Route::get('api/canalesclientes', 'ClientesCanalController@canales_p');

//PAISES
Route::get('api/paises', 'PaisesController@index');
//GENEROS
Route::get('api/generos', 'GeneroController@index');
//Documentos
Route::get('api/documentos', 'DocumentoController@index');

//MENSAJES
Route::get('api/messages', 'MessageController@index');
Route::post('api/messages', 'MessageController@store');
//CONSULTAS
Route::get('api/consultas', 'ConsultasController@index');
Route::get('api/typeconsultas', 'TipoConsultasController@index');
Route::post('api/consultas', 'ConsultasController@store');
//CLIENTES
Route::get('api/clientes', 'ClienteschatController@index');
Route::post('api/clientes', 'ClienteschatController@update');
Route::post('api/enlazarclientes', 'ClienteschatController@enlazar');
Route::post('api/addClienteNew', 'ClienteschatController@addClienteNew');

//CLIENTES_CANAL
Route::post('api/clientesinformacion', 'ClientesCanalController@index');
Route::post('api/canalescliente', 'ClientesCanalController@canales');



Route::post('api/transferir_chat', 'TranferenciasController@transfer');

Route::get('/api/search_messages', 'MessageController@buscar_conversation');


Route::post('668803720/api/webhook','WebhookController@entradas');
Route::get('668803720/api/webhook','WebhookController@entradas');

Route::get('668803720/api/chagestate','SessionController@chagestate');

Route::post('668803720/api/insta','InstagramController@index');

Route::get('668803720/api/instaSendmessage/{user}/{mensaje}','InstagramController@sendMessage');
Route::get('668803720/api/instagetMessage','InstagramController@getMessage');


Route::post('api/upload','WaboxappController@prueba');
Route::post('api/validate','WaboxappController@validar');
Route::post('pusher/auth','WaboxappController@pusher');

//pruebas de waping server
Route::post('api/waping','WaboxappController@waping');

//Route::post('668803720/waboxapp','WaboxappController@handleRequest');
Route::post('668803720/waboxapp','WapingController@entrada');
Route::post('668803720/waping','WapingController@entrada');

Route::post('api/upload','MessageController@upload');
//Route::post('api/v1/upload/json','IntegracioneswebhookController@upload');

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

Route::get('get/usuarios/companie/{user_id}','UsersCompaniesController@getUsers');
Route::get('get/companie/{user_id}','UsersCompaniesController@getcompanie');
Route::get('get/rol','UsersCompaniesController@getRoles');