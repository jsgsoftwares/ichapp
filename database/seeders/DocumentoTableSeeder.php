<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Documento;
class DocumentoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Documento::create([
            'detalle'=>'Cedula',
        ]);
        
        Documento::create([
            'detalle'=>'Pasaporte',
        ]);
    }
}
