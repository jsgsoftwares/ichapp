<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\acciones_modulo;
class AccionesModulosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

       acciones_modulo::create(
            [
                'intento'=>'c4250f11-3f9a-4c3b-af0c-ca8e138abf75',
                'num'=>'1',
                'accion'=>'function',
                'execute'=>'Datoscliente',
                'true'=>2,
                'false'=>3
            ]
            ); 

        acciones_modulo::create(
            [
                'intento'=>'',
                'num'=>'2',
                'accion'=>'function',
                'execute'=>'SolicitarPiezas',
                'true'=>0,
                'false'=>0
            ]
            ); 
        acciones_modulo::create(
            [
                'intento'=>'',
                'num'=>'2',
                'accion'=>'function',
                'execute'=>'SolicitarPlaca',
                'true'=>0,
                'false'=>3
            ]
            ); 

    }
}
