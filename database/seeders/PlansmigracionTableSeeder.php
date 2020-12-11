<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\planesmigraciones;
class PlansmigracionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        planesmigraciones::create(
            [
                'companie_id'=>2,
                'from_plan_id'=>4,
                'to_plan_id'=>3,
                'requested_at'=>'2020-10-21',
                'execution_at'=>'2020-10-25'
            ]
            );
            planesmigraciones::create(
                [
                    'companie_id'=>3,
                    'from_plan_id'=>3,
                    'to_plan_id'=>2,
                    'requested_at'=>'2020-09-30',
                    'execution_at'=>'2020-10-25'
                ]
            );
/*          
         $table->unsignedInteger('companie_id');
            $table->foreign('companie_id')->references('id')->on('companies');
    
            $table->unsignedInteger('from_plan_id');
            $table->foreign('from_plan_id')->references('id')->on('plans');
            
            $table->unsignedInteger('to_plan_id');
            $table->foreign('to_plan_id')->references('id')->on('plans');
           
            $table->dateTime('requested_at');
            $table->dateTime('execution_at');

*/

    }
}

