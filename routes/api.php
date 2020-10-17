<?php

use Illuminate\Http\Request;

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

Route::get('Endconversations', 'ConversationController@Endconversations');

//ACCIONES
Route::post('integrate/webhook', 'IntegracioneswebhookController@store')->name('integrate.webhook');
Route::post('update/telegram', 'IntegracioneswebhookController@UpdateTokenTelegram')->name('update.telegram');
Route::post('update/facebook', 'IntegracioneswebhookController@UpdateTokenFacebook')->name('update.facebook');
Route::post('update/waping', 'IntegracioneswebhookController@UpdateTokenWaping')->name('update.waping');
Route::post('update/dialogflow', 'IntegracioneswebhookController@UpdateDialogFlow')->name('update.dialog');

//HANDLERS
Route::post('v1/integrations/telegram/webhook/{companieId}/{mytoken}', 'TelegramController@getmessages')->name('getmessage.telegram');
Route::post('v1/integrations/waping/webhook/{companieId}/{mytoken}','WapingController@getmessages')->name('getmessage.waping');;
Route::post('v1/integrations/messenger/webhook/{companieId}/{mytoken}','FacebookController@getmessages')->name('getmessage.facebook');;
Route::get('v1/integrations/messenger/webhook/{companieId}/{mytoken}','FacebookController@verify')->name('verify.facebook');;
Route::post('v1/integrations/waping/ed332004b7574720bdaa86dd24aa2a97','WapingController@getmessagesWaping')->name('getmessage.wapingm');;



//PRUEBAS
Route::get('v1/facebook', 'FacebookController@enviarMensaje')->name('enviarMensaje.facebook');
Route::get('v1/prueba', 'DialogflowController@prueba')->name('dialogflow.prueba');



//DASHBOARD
Route::get('v1/listar/integraciones', 'IntegracionesController@listar')->name('listar.integraciones');
Route::post('v1/get/integraciones', 'IntegracioneswebhookController@getIntegracion')->name('listar.telegram');

Route::post('v1/upload/json','IntegracioneswebhookController@upload');
Route::post('v1/create/user','UsersCompaniesController@crearUsuario');
Route::post('v1/update/user','UsersCompaniesController@editUsuario');
Route::post('v1/close/user','UsersCompaniesController@DeleteUsuario');

Route::get('v1/get/paises','PaisesController@phonepaises');
Route::post('v1/get/token','IntegracioneswebhookController@obtenerTokenWaping');