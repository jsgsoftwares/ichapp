<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('Endconversations',[App\Http\Controllers\ConversationController::class,'Endconversations']);

//ACCIONES
Route::post('integrate/webhook',[App\Http\Controllers\IntegracioneswebhookController::class,'store'])->name('integrate.webhook');
Route::post('update/telegram',[App\Http\Controllers\IntegracioneswebhookController::class,'UpdateTokenTelegram'])->name('update.telegram');
Route::post('update/facebook',[App\Http\Controllers\IntegracioneswebhookController::class,'UpdateTokenFacebook'])->name('update.facebook');
Route::post('update/waping',[App\Http\Controllers\IntegracioneswebhookController::class,'UpdateTokenWaping'])->name('update.waping');
Route::post('update/dialogflow',[App\Http\Controllers\IntegracioneswebhookController::class,'UpdateDialogFlow'])->name('update.dialog');

//HANDLERS
Route::post('v1/integrations/telegram/webhook/{companieId}/{mytoken}',[App\Http\Controllers\TelegramController::class,'getmessages'])->name('getmessage.telegram');
Route::post('v1/integrations/waping/webhook/{companieId}/{mytoken}',[App\Http\Controllers\WapingController::class,'getmessages'])->name('getmessage.waping');
Route::post('v1/integrations/messenger/webhook/{companieId}/{mytoken}',[App\Http\Controllers\FacebookController::class,'getmessages'])->name('getmessage.facebook');
Route::get('v1/integrations/messenger/webhook/{companieId}/{mytoken}',[App\Http\Controllers\FacebookController::class,'verify'])->name('verify.facebook');
Route::post('v1/integrations/waping/ed332004b7574720bdaa86dd24aa2a97',[App\Http\Controllers\WapingController::class,'getmessagesWaping'])->name('getmessage.wapingm');



//PRUEBAS
Route::get('v1/facebook',[App\Http\Controllers\FacebookController::class,'enviarMensaje'])->name('enviarMensaje.facebook');
Route::get('v1/prueba',[App\Http\Controllers\DialogflowController::class,'prueba'])->name('dialogflow.prueba');



//DASHBOARD
Route::get('v1/listar/integraciones',[App\Http\Controllers\IntegracionesController::class,'listar'])->name('listar.integraciones');
Route::post('v1/get/integraciones',[App\Http\Controllers\IntegracioneswebhookController::class,'getIntegracion'])->name('listar.telegram');

Route::post('v1/upload/json',[App\Http\Controllers\IntegracioneswebhookController::class,'upload']);
Route::post('v1/create/user',[App\Http\Controllers\UsersCompaniesController::class,'crearUsuario']);
Route::post('v1/update/user',[App\Http\Controllers\UsersCompaniesController::class,'editUsuario']);
Route::post('v1/close/user',[App\Http\Controllers\UsersCompaniesController::class,'DeleteUsuario']);

Route::get('v1/get/paises',[App\Http\Controllers\PaisesController::class,'phonepaises']);
Route::post('v1/get/token',[App\Http\Controllers\IntegracioneswebhookController::class,'obtenerTokenWaping']);



//subscriptions
Route::get('v1/get/subscription/{userid}',[App\Http\Controllers\SubscriptionproductsController::class,'subscriptions']);
Route::get('v1/get/planes/subscripcion',[App\Http\Controllers\SubscriptionproductsController::class,'planes']);
Route::post('v1/get/subscripcion/plan',[App\Http\Controllers\SubscriptionproductsController::class,'planSubscrito']);
Route::post('v1/get/subscrito/plan',[App\Http\Controllers\SubscriptionproductsController::class,'planCompanie']);


//Route::put('v1/put/cancel/plan',[App\Http\Controllers\SubscriptionproductsController::class,'cancelarSubscription']);


Route::get('v1/crontab/planes',[App\Http\Controllers\SubscriptionproductsController::class,'crearSubscriptionesCrontabs']);
Route::post('v1/user/planes',[App\Http\Controllers\SubscriptionproductsController::class,'crearSubscritionUsuario']);
Route::post('v1/cancelar/subscription',[App\Http\Controllers\SubscriptionproductsController::class,'cancelarSubscription']);
//usuarios
Route::post('v1/obtener/usuarios/subscritos',[App\Http\Controllers\SubscriptionproductsController::class,'CantUsuariosSubscritos']);
Route::get('v1/obtener/usuarios/subscritos/{companie_id}',[App\Http\Controllers\SubscriptionproductsController::class,'deshabilitarUsuariosRestantes']);
Route::post('v1/disabled/usuario',[App\Http\Controllers\SubscriptionproductsController::class,'deshabilitarUsuario']);
Route::post('v1/enabled/usuario',[App\Http\Controllers\SubscriptionproductsController::class,'habilitarUsuario']);