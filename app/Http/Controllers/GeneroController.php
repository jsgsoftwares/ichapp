<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genero;
use DB;
use Storage;
class GeneroController extends Controller
{
    public function index(Request $request)
    {
        $userId=auth()->id();
        $contactId=$request->contact_id;
        if(isset($userId))
        {
            return Genero::select('id as value','genero as text')
            ->get();

        }
        return json_encode(array('message'=>"error:no hay ningun usuario autenticado"));



    }
}
