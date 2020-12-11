<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Waboxapp;
class WaboxappTableSeeder extends Seeder
{
    
    public function run()
    {
        //
        Waboxapp::create(
            [
                'id'=>205,
                'user'=>'200',
                'mensaje'=>'200'
            ]);
    }
}