<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Subscripcion;
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
                'migrate'=>0,
                'subscription_id'=>'prueba',
                'migrate_at'=>null,
                'renewal_cancelled_at'=>null
                ]
        );
        Subscripcion::create(
                [
                    'companie_id'=>3,
                    'plan_id'=>2,
                    'started_at'=>'2020-09-25',
                    'finish_at'=>'2020-10-25',
                    'migrate'=>0,
                    'migrate_at'=>null,
                    'subscription_id'=>'prueba2',
                    'renewal_cancelled_at'=>null
                ]
        );

    }
}

