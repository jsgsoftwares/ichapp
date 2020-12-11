<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Plan;
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
                    'monthly_price'=>0,
                    'yearly_price'=>0
                ]
            );
            Plan::create(
                [
                    'name'=>'Estandar 1',
                    'plan_code'=>'P-91534868U2353433WL6VIDHY',
                    'status'=>'active',
                    'total_cycles'=>1,
                    'monthly_price'=>10,
                    'yearly_price'=>120
                ]
            );
            Plan::create(
                [
                    'name'=>'Estandar 2',
                    'plan_code'=>'P-4T79581039275152DL6VIEZY',
                    'status'=>'active',
                    'total_cycles'=>1,
                    'monthly_price'=>20,
                    'yearly_price'=>240
                ]
            );
            Plan::create(
                [
                    'name'=>'Estandar 3',
                    'plan_code'=>'P-1NL84278CH605914YL6VIFDA',
                    'status'=>'active',
                    'total_cycles'=>1,
                    'monthly_price'=>30,
                    'yearly_price'=>360
                ]
            );
            Plan::create(
                [
                    'name'=>'Estandar 4',
                    'plan_code'=>'P-076623350P119654HL6VIFLQ',
                    'status'=>'active',
                    'total_cycles'=>1,
                    'monthly_price'=>40,
                    'yearly_price'=>480
                ]
            );
            Plan::create(
                [
                    'name'=>'Estandar 5',
                    'plan_code'=>'P-4L710503HA255181LL6VIFWA',
                    'status'=>'active',
                    'total_cycles'=>1,
                    'monthly_price'=>50,
                    'yearly_price'=>600
                ]
            );
            Plan::create(
                [
                    'name'=>'Estandar 6',
                    'plan_code'=>'P-78K025465Y294684PL6VIGEI',
                    'status'=>'active',
                    'total_cycles'=>1,
                    'monthly_price'=>60,
                    'yearly_price'=>720
                ]
            );
            Plan::create(
                [
                    'name'=>'Estandar 7',
                    'plan_code'=>'P-7F890485MJ917315SL6VIGMI',
                    'status'=>'active',
                    'total_cycles'=>1,
                    'monthly_price'=>70,
                    'yearly_price'=>840
                ]
            );
            Plan::create(
                [
                    'name'=>'Estandar 8',
                    'plan_code'=>'P-3E0162177H198734LL6VIGXA',
                    'status'=>'active',
                    'total_cycles'=>1,
                    'monthly_price'=>80,
                    'yearly_price'=>960
                ]
            );
            Plan::create(
                [
                    'name'=>'Estandar 9',
                    'plan_code'=>'P-531937295M0406214L6VIHAA',
                    'status'=>'active',
                    'total_cycles'=>1,
                    'monthly_price'=>90,
                    'yearly_price'=>1080
                ]
            );
            Plan::create(
                [
                    'name'=>'Estandar 10',
                    'plan_code'=>'P-692752926B696351FL6VIHKY',
                    'status'=>'active',
                    'total_cycles'=>1,
                    'monthly_price'=>100,
                    'yearly_price'=>1200
                ]
            );
    }
}

