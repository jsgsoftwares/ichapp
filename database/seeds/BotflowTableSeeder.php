<?php

use Illuminate\Database\Seeder;
use App\Integracionbotflow;
class BotflowTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Integracionbotflow::create(
            [
                'token'=>'d6879a04614447fc8886db9f04899518',
                'filename'=>'',
                'project_id'=>'',
                'bot_id'=>'1',
                'companie_id'=>'3',
                'enabled'=>'0',
                'start'=>0,
                'createBy'=>2,
                'mytoken'=>'hasio238s8hsd80diin390o',
                'canal_id'=>7,
            ]
            );
            Integracionbotflow::create(
                [
                    'token'=>' ',
                    'filename'=>'tempocargo-9ahf-79f66bfd27bd.json',
                    'project_id'=>'tempocargo-9ahf',
                    'bot_id'=>'1',
                    'companie_id'=>'3',
                    'enabled'=>'1',
                    'start'=>1,
                    'createBy'=>2,
                    'mytoken'=>'hasio238s8hsd80diin390o4d890uw',
                    'canal_id'=>7,
                ]
                );

    }
}
