<?php

namespace App\Http\Controllers;
use App\TipoConsultas;
use DB;
use Storage;
use Illuminate\Http\Request;

class TipoConsultasController extends Controller
{
    public function index(Request $request)
    {
        $userId=auth()->id();
        $contactId=$request->contact_id;
        if(isset($userId))
        {
            return TipoConsultas::select('id','detalle','created_at')
            ->get();

        }
        return json_encode(array('message'=>"error:no hay ningun usuario autenticado"));



    }
}
