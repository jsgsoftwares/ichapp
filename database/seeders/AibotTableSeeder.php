<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\aibot;
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
