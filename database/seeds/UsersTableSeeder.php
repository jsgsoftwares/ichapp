<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*  User::create(
            [
                'name'=>'Cholo madungandi',
                'email'=>'cesar@voixbot.com',
                'password'=>bcrypt('123456'),
                'canal_id'=>1,
                'rol_id'=>4,
                'state_id'=>2
            ]
            ); */
            User::create(
                [
                    'name'=>'Johnny',
                    'email'=>'johnny@voixbot.com',
                    'password'=>bcrypt('123456'),
                    'canal_id'=>1,
                    'rol_id'=>2,
                    'state_id'=>2,
                    'inmessage'=>1,
                    'enabled'=>1,
                    'companie_id'=>2,
                    'creator'=>1
                ]
                );
                User::create(
                    [
                        'name'=>'Mbgpanama',
                        'email'=>'mbgpanama@voixbot.com',
                        'password'=>bcrypt('123456'),
                        'canal_id'=>1,
                        'rol_id'=>2,
                        'state_id'=>2,
                        'inmessage'=>1,
                        'enabled'=>1,
                        'companie_id'=>3,
                        'creator'=>1
                    ]
                    );
                /*  User::create(
                    [
                        'name'=>'Aguacate',
                        'email'=>'jorge@voixbot.com',
                        'password'=>bcrypt('123456'),
                        'canal_id'=>1,
                        'rol_id'=>5,
                        'state_id'=>2,
                        'inmessage'=>1
                    ]
                    ); 
                 User::create(
                    [
                        'name'=>'Pulpa negra',
                        'email'=>'orlando@voixbot.com',
                        'password'=>bcrypt('123456'),
                        'canal_id'=>1,
                        'rol_id'=>5,
                        'state_id'=>2,
                        'inmessage'=>1
                    ]
                    );
                User::create(
                    [
                        'name'=>'Gargola',
                        'email'=>'luis@voixbot.com',
                        'password'=>bcrypt('123456'),
                        'canal_id'=>1,
                        'rol_id'=>5,
                        'state_id'=>2,
                        'inmessage'=>1
                    ]
                    ); */
                    /*
                User::create(
                    [
                        'name'=>'Ramon',
                        'email'=>'ramon@voixbot.com',
                        'password'=>bcrypt('123456'),
                        'canal_id'=>1,
                        'rol_id'=>5,
                        'state_id'=>2,
                        'inmessage'=>1
                    ]
                    ); */
    }
}
