<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Documento;
use DB;
use Storage;
class DocumentoController extends Controller
{
    public function index(Request $request)
    {
        $userId=auth()->id();
        $contactId=$request->contact_id;
        if(isset($userId))
        {
            return Documento::select('id as value','detalle as text','created_at')
            ->get();

        }
        return json_encode(array('message'=>"error:no hay ningun usuario autenticado"));



    }
}
