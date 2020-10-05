<?php

use Illuminate\Database\Seeder;
use App\TipoConsultas;
class TipoConsultasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoConsultas::create([
            'detalle'=>'Horarios',
        ]);
        TipoConsultas::create([
            'detalle'=>'Consulta de precios',
        ]);
        TipoConsultas::create([
            'detalle'=>'Cotizacion',
        ]);

    }
}
