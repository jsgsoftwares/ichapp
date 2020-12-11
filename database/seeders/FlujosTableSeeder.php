<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Flujos;
class FlujosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Flujos::create(
        [
            'detalle'=>'Dialog'
        ]
        );
        Flujos::create(
        [
            'detalle'=>'Bot'
        ]
        );
        Flujos::create(
        [
            'detalle'=>'Agente'
        ]
        );
    }
}
