<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Integracioneswebhook;
class IntegrationswebhookTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     
        Integracioneswebhook::create(
        [

            'token'=>'1320988779:AAHx7pPe88qNdiT2AKKXgmOydRjrFi1V3Ec',
            'enabled'=>1,
            'start'=>1,
            'companie_id'=>3,
            'phone'=>0,
            'pais_id'=>0,
            'canal'=>2,
            'verify'=>'',
            'mytoken'=>'1AAHx7pPe88qNdiT2AKKXgmOydRjrFi1V3Ec',
            'createBy'=>1
        ]
        );
        Integracioneswebhook::create(
            [
    
                'token'=>'1cea1c9b02c4447588a8a91e1935c950',
                'enabled'=>1,
                'start'=>1,
                'companie_id'=>3,
                'phone'=>66233431,
                'phone_code'=>50766233431,
                'pais_id'=>165,
                'canal'=>3,
                'verify'=>'',
                'mytoken'=>'1AAHx7pPe88qNdiT2AKKXgmOyd22Tr85t1V3Ec',
                'createBy'=>1
            ]
            );
        Integracioneswebhook::create(
            [
    
                'token'=>'EAAG3oVZCYl3UBANRQpXpKUCVbSSjqDWWHVk6twrLalDQZCeYRZApEaQ9dnc00yz7xJIw0a6WNUhSCHdub68OonmdHDtOjJLKaObsXRqrla5Lc0lvRlnHTtbZAdZBYxxzYQ42DCKZAxg0b78P0nz4woqkw22ewL77qZAdJ9Sv9Q10wZDZD',
                'enabled'=>1,
                'start'=>1,
                'companie_id'=>3,
                'phone'=>0,
                'pais_id'=>0,
                'canal'=>4,
                'verify'=>'testtoken',
                'mytoken'=>'mA0f6O7I8oCndPm1Paj1ZhmAtwuUne8N0eaM57hZmsj73WlE8e',
                'createBy'=>1
            ]
            );

    }
}
