<?php

use Illuminate\Database\Seeder;
use App\Subscripcion;
class SubscripcionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subscripcion::create(
                [
                'companie_id'=>2,
                'plan_id'=>1,
                'started_at'=>'2020-09-25',
                'finish_at'=>'2020-10-25',
                'renewal_cancelled_at'=>'2020-10-25'
                ]
            );
        Subscripcion::create(
                [
                    'companie_id'=>3,
                    'plan_id'=>2,
                    'started_at'=>'2020-09-25',
                    'finish_at'=>'2020-10-25',
                    'renewal_cancelled_at'=>'2020-10-28'
                ]
            );
/*                        $table->increments('id');
            $table->unsignedBigInteger('companie_id');
            $table->foreign('companie_id')->references('id')->on('companies');
            $table->unsignedInteger('plan_id');
            $table->foreign('plan_id')->references('id')->on('plans');
            $table->dateTime('started_at');
            $table->dateTime('finish_at');
            $table->dateTime('renewal_cancelled_at'); */

    }
}

