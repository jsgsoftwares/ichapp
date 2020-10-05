<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paises;
use DB;
use Storage;

class PaisesController extends Controller
{
    public function index(Request $request)
    {
        $userId=auth()->id();
        $contactId=$request->contact_id;
        if(isset($userId))
        {
            return Paises::select('id as value','nombre as text')
            ->get();

        }
        return json_encode(array('message'=>"error:no hay ningun usuario autenticado"));



    }
}
