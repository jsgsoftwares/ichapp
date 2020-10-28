<?php

use Illuminate\Database\Seeder;
use App\Products;
class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Products::create(
            [
                'tipo'=>'user',
                'description'=>'User',
                'price'=>'10',
                'status'=>'active',
                'enabled'=>1
                ]
            );
        Products::create(
            [
                'tipo'=>'canal',
                'description'=>'DialogFlow',
                'price'=>'10',
                'status'=>'active',
                'enabled'=>1
                ]
            );
        Products::create(
            [
                'tipo'=>'canal',
                'description'=>'whatsapp with waping',
                'price'=>'30',
                'status'=>'active',
                'enabled'=>1
                ]
            );
        Products::create(
            [
                'tipo'=>'canal',
                'description'=>'Telegram',
                'price'=>'0',
                'status'=>'active',
                'enabled'=>1
                ]
            );
        Products::create(
            [
                'tipo'=>'canal',
                'description'=>'Facebook',
                'price'=>'0',
                'status'=>'active',
                'enabled'=>1
                ]
            );

    }
}
