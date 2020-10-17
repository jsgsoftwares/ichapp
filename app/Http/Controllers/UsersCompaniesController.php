<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Companie;
use App\User;
use App\Rol;
class UsersCompaniesController extends Controller
{
    //

    function getUsers($user_id){

        

            $usuario=User::where('id',$user_id)->first();
            $companie=Companie::where('id',$usuario->companie_id)->first();

            $usuarios_compania=User::where('companie_id',$companie->id)
            ->where('state_id','!=',9)
            ->join('rols', 'users.rol_id', '=', 'rols.id')
            ->join('companies', 'users.companie_id', '=', 'companies.id')
            ->join('states','users.state_id','=','states.id')
            ->select('users.*', 'companies.name as companie', 'rols.detalle as rol','states.detalle as state')
            ->get();

            return $usuarios_compania;
    }

    function getcompanie($user_id){
        $usuario=User::where('id',$user_id)->first();
        $companie=Companie::where('id',$usuario->companie_id)->first();
        return $companie;
    }
    function getRoles(){

        $roles=Rol::where("enabled",1,)->get();
        return $roles;
    }
    
    function crearUsuario(Request $request){

        $existe=User::where('email',$request->username)->first();
        
        if(!$existe){
            $newuser=new User;
            $newuser->name=$request->name;
            $newuser->email=$request->username;
            $newuser->password=bcrypt($request->password);
            $newuser->companie_id=$request->companie_id;
            $newuser->rol_id=$request->rol_id;
            $newuser->canal_id=1;
            $newuser->state_id=2;
            $newuser->enabled=1;
            $newuser->inmessage=1;
            $newuser->creator=0;
            $newuser->save();
        }
        else{
            return ["message"=>"el usuario ya existe"];
        }

    }

    function obtenerUsuario($user_id){
        $existe=User::where('users.id',$user_id)
        ->join('rols', 'users.rol_id', '=', 'rols.id')
        ->join('states','users.state_id','=','states.id')
        ->select('users.*', 'rols.detalle as rol','states.detalle as state')
        ->first();
        return $existe;
    }

    function editUsuario(Request $request){
        if($request->password=='nochange'){
            User::where('id',$request->id)
            ->update([
                'name'=>$request->name,
                'rol_id'=>$request->rol_id,
                    ]); 
                    return ["message"=>"update"];
        }else{
            User::where('id',$request->id)
            ->update([
                'name'=>$request->name,
                'rol_id'=>$request->rol_id,
                'password'=>bcrypt($request->password),
                    ]); 
                    return ["message"=>"update"];
        }


    }

    function DeleteUsuario(Request $request){
      
        if(date("d")=="01" || date("d")=="02" || date("d")=="03" || date("d")=="04" || date("d")=="05")
        {
            User::where('id',$request->user_id)
            ->update([
              
                'state_id'=>9,
                    ]); 
                    return ["message"=>"pending"];
        }
        else{
            User::where('id',$request->user_id)
            ->update([
              
                'state_id'=>8,
                    ]); 
                    return ["message"=>"close"];
        }

    }


}
