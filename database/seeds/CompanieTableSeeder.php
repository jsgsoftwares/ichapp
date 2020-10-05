<?php

use Illuminate\Database\Seeder;
use App\Companie;
class CompanieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Companie::create(
        [

        'name'=>'userIn'
        ]
        );
        Companie::create(
        [

        'name'=>'Jsgsoftware'
        ]
        );
        Companie::create(
            [
    
            'name'=>'mbgpanama'
            ]
            );

    }
}
