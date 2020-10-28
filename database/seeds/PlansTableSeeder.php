<?php

use Illuminate\Database\Seeder;
use App\Plan;
class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            Plan::create(
            [
                'name'=>'Trial',
                'plan_code'=>'trial',
                'status'=>'active',
                'total_cycles'=>1,
                'monthly_price'=>0,
                'yearly_price'=>0
                ]
            );
            Plan::create(
                [
                    'name'=>'Basic',
                    'plan_code'=>'P-2VE29307G7174983GL6HFKFA',
                    'status'=>'active',
                    'total_cycles'=>1,
                    'monthly_price'=>10,
                    'yearly_price'=>120
                ]
            );
            Plan::create(
                [
                    'name'=>'Estandar 1',
                    'plan_code'=>'P-5NT58939E4882334XL6HQL6Y',
                    'status'=>'active',
                    'total_cycles'=>1,
                    'monthly_price'=>20,
                    'yearly_price'=>120
                ]
            );
            Plan::create(
                [
                    'name'=>'Estandar 2',
                    'plan_code'=>'P-4D477988SV4694438L6HQR4Y',
                    'status'=>'active',
                    'total_cycles'=>1,
                    'monthly_price'=>30,
                    'yearly_price'=>120
                ]
            );
/*             $table->string('name');
            $table->string('plan_code');
            $table->string('status');
            $table->string('total_cycles');
            $table->integer('monthly_price');
            $table->integer('yearly_price');  */

    }
}

