<?php

use Illuminate\Database\Seeder;
use App\subscriptionproducts;
class ProductsubscriptosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        subscriptionproducts::create(
            [
                'companie_id'=>3,
                'product_id'=>1,
                'cantidad'=>1,
                'enabled'=>1,
                'request_add_at'=>'2020-09-30',
                'request_cancelled_at'=>null,
            ]
            );
            subscriptionproducts::create(
                [
                    'companie_id'=>3,
                    'product_id'=>1,
                    'cantidad'=>1,
                    'enabled'=>1,
                    'request_add_at'=>'2020-09-30',
                    'request_cancelled_at'=>null,
                ]
                );
                subscriptionproducts::create(
                    [
                        'companie_id'=>3,
                        'product_id'=>1,
                        'cantidad'=>1,
                        'enabled'=>1,
                        'request_add_at'=>'2020-09-30',
                        'request_cancelled_at'=>'2020-10-25',
                    ]
                    );
                    subscriptionproducts::create(
                        [
                            'companie_id'=>3,
                            'product_id'=>2,
                            'cantidad'=>1,
                            'enabled'=>0,
                            'request_add_at'=>'2020-09-30',
                            'request_cancelled_at'=>'2020-10-25',
                        ]
                        );
                        subscriptionproducts::create(
                            [
                                'companie_id'=>3,
                                'product_id'=>3,
                                'cantidad'=>1,
                                'enabled'=>1,
                                'request_add_at'=>'2020-09-30',
                                'request_cancelled_at'=>null,
                            ]
                            );
                            subscriptionproducts::create(
                                [
                                    'companie_id'=>3,
                                    'product_id'=>4,
                                    'cantidad'=>1,
                                    'enabled'=>1,
                                    'request_add_at'=>'2020-09-30',
                                    'request_cancelled_at'=>null,
                                ]
                                );
                                subscriptionproducts::create(
                                    [
                                        'companie_id'=>3,
                                        'product_id'=>5,
                                        'cantidad'=>1,
                                        'enabled'=>1,
                                        'request_add_at'=>'2020-09-30',
                                        'request_cancelled_at'=>null,
                                    ]
                                    );
/*          
       $table->increments('id');
            $table->unsignedInteger('companie_id');
            $table->foreign('companie_id')->references('id')->on('companies');

            $table->unsignedInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->Integer('cantidad');
            $table->integer('enabled');
            $table->dateTime('request_add_at');
            $table->dateTime('request_cancelled_at');

*/

    }
}

