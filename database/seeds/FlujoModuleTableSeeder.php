<?php

use Illuminate\Database\Seeder;
use App\flujomodule;
class FlujoModuleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        flujomodule::create([
            'companie_id'=>3,
            'webhook'=>'http://vps-a47c94ac.vps.ovh.ca/api/tempocargo',
            ]);
  
    }
}
