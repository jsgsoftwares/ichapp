<?php

use Illuminate\Database\Seeder;
use App\Waboxapp;
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