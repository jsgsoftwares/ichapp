<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\State;
class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        State::create([
            'detalle'=>'canceled',
        ]);
        State::create([
            'detalle'=>'online',
        ]);
        State::create([
            'detalle'=>'waiting',
        ]);
        State::create([
            'detalle'=>'ending',
        ]);
        State::create([
            'detalle'=>'hold',
        ]);
        State::create([
            'detalle'=>'offline',
        ]);
        State::create([
            'detalle'=>'transfer',
        ]);
        State::create([
            'detalle'=>'Pending close',
        ]);
        State::create([
            'detalle'=>'closed',
        ]);
        State::create([
            'detalle'=>'disabled',
        ]);


    }
}
