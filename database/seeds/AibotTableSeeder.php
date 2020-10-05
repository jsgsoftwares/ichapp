<?php

use Illuminate\Database\Seeder;
use App\aibot;
class AibotTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        aibot::create(
            [
                'bot'=>'DialogFlow',
                'enabled'=>'1',

            ]
            );

    }
}
