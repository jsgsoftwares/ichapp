<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\subscriptionproducts;
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
            'plan_id'=>2,
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
                'plan_id'=>2,
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
                'plan_id'=>2,
                'enabled'=>1,
                'request_add_at'=>'2020-09-30',
                'request_cancelled_at'=>null,
            ]
            );
            subscriptionproducts::create(
                [
                    'companie_id'=>2,
                    'product_id'=>1,
                    'plan_id'=>2,
                    'cantidad'=>1,
                    'enabled'=>1,
                    'request_add_at'=>'2020-09-30',
                    'request_cancelled_at'=>null,
                ]
                );
        
                subscriptionproducts::create(
                [
                        'companie_id'=>2,
                        'product_id'=>4,
                        'cantidad'=>1,
                        'plan_id'=>2,
                        'enabled'=>1,
                        'request_add_at'=>'2020-09-30',
                        'request_cancelled_at'=>null,
                ]
                );
        
                subscriptionproducts::create(
                    [
                        'companie_id'=>2,
                        'product_id'=>5,
                        'cantidad'=>1,
                        'plan_id'=>2,
                        'enabled'=>1,
                        'request_add_at'=>'2020-09-30',
                        'request_cancelled_at'=>null,
                    ]
                    );

    }
}

