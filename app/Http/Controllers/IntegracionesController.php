<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Integraciones;
class IntegracionesController extends Controller
{
    //
    public function listar(){
        $integracion=[];
        $integra=Integraciones::where('enabled',1)->get();
        $integracion=array('canales'=>$integra);
        return ($integra);
    }
}
