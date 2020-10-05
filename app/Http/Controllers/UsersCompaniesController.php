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
            ->join('rols', 'users.rol_id', '=', 'rols.id')
            ->join('companies', 'users.companie_id', '=', 'companies.id')
            ->select('users.*', 'companies.name as companie', 'rols.detalle as rol')
            ->get();

            return $usuarios_compania;
    }

    function getcompanie($user_id){
        $usuario=User::where('id',$user_id)->first();
        $companie=Companie::where('id',$usuario->companie_id)->first();
        return $companie;
    }
    function getRoles(){

        $roles=Rol::get();
        return $roles;
    }
    
    function crearUsuario(Request $request){
/*         $request->validate([
            'user_id'=>'required',
            'companie_id' => 'required',
            'name' => 'required',
            'rol_id' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]); */
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
            $newuser->save();
        }
        else{
            return ["message"=>"el usuario ya existe"];
        }

    }
}
