<?php

use Illuminate\Database\Seeder;
use App\Fullfillment;
class FullfillmantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Fullfillment::create([

            'flujo_id'=>3,
            'intentId'=>'686d8683-9954-4712-802d-60eec07cee8d',
            'state_id'=>2,
            'companie_id'=>2,
        ]);
        Fullfillment::create([

            'flujo_id'=>3,
            'intentId'=>'8e71a8a8-af1e-4fa3-8eae-93c240ef1144',
            'state_id'=>2,
            'companie_id'=>2,
        ]);
        Fullfillment::create([

            'flujo_id'=>2,
            'intentId'=>'8e71a8a8-af1e-4fa3-8eae-93c240ef1144',
            'state_id'=>2,
            'companie_id'=>2,
        ]);

        Fullfillment::create([

            'flujo_id'=>3,
            'intentId'=>'c2d16a58-0433-460a-b0b8-a25a94b11ece',
            'state_id'=>2,
            'companie_id'=>2,
        ]);

        Fullfillment::create([

            'flujo_id'=>2,
            'intentId'=>'c4250f11-3f9a-4c3b-af0c-ca8e138abf75',
            'state_id'=>2,
            'companie_id'=>2,
        ]);
        
        Fullfillment::create([

            'flujo_id'=>3,
            'intentId'=>'3e078de7-a710-4821-b277-d26cf4aa7ec4',
            'state_id'=>2,
            'companie_id'=>2,
        ]);
        Fullfillment::create([

            'flujo_id'=>3,
            'intentId'=>'ca1a8438-6a1e-4fa5-aad7-22186934ba2b',
            'state_id'=>2,
            'companie_id'=>2,
        ]);
        Fullfillment::create([

            'flujo_id'=>2,
            'intentId'=>'432d2436-a45b-4cf2-9477-905aedc1166c',
            'state_id'=>2,
            'companie_id'=>3,
        ]);
        Fullfillment::create([

            'flujo_id'=>2,
            'intentId'=>'6a3965d5-f83b-4f96-946c-313eeb058211',
            'state_id'=>2,
            'companie_id'=>3,
        ]);
            Fullfillment::create([

            'flujo_id'=>3,
            'intentId'=>'2f1f108d-ab9c-4760-9b82-f27cde3f2996',
            'state_id'=>2,
            'companie_id'=>3,
        ]);
        Fullfillment::create([

            'flujo_id'=>3,
            'intentId'=>'a19472d0-8118-444e-971f-a5996440ed24',
            'state_id'=>2,
            'companie_id'=>3,
        ]);
        
        
        
        

        

    }
}
