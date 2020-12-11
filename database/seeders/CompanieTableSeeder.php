<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Companie;
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
