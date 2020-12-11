<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Integracionwaping;
class IntegrationswapingTableSeeder extends Seeder
{

    public function run()
    {
     
        Integracionwaping::create(
        [

            'token'=>'1cea1c9b02c4447588a8a91e1935c950',
            'phone'=>'50766233431',
            'enabled'=>1,
            'companie_id'=>2,
            'mytoken'=>'23sea1c9b02c431217588fdsssa91e33qwe20',
            'createBy'=>1
        ]
        );
      

    }
}
