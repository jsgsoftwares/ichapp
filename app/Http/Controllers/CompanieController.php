<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanieController extends Controller
{
    

    
    function buscar(){

    }

    function store(Request $request){

        $compania=new Companie();
        $compania->name=$request->name;
        $compania->save();
    }
}
