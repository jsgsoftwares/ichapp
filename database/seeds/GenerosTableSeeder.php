<?php

use Illuminate\Database\Seeder;
use App\Genero;
class GenerosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Genero::create([
            'genero'=>'Masculino',
            ]);
        
        Genero::create([
            'genero'=>'Femenino',
            ]);
        Genero::create([
            'genero'=>'No definido',
            ]);
    }
}
