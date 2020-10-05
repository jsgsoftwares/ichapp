<?php

use Illuminate\Database\Seeder;
use App\Rol;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rol::create(
            [
                "detalle"=>"SuperAdmin",
            ]);
        Rol::create(
            [
                "detalle"=>"Admin",
            ]);
        Rol::create(
            [
                "detalle"=>"TeamLeader",
            ]);

        Rol::create(
            [
                "detalle"=>"Leader",
            ]);
        Rol::create(
            [
                "detalle"=>"Agent",
            ]);
        Rol::create(
            [
                "detalle"=>"user",
            ]);
    }
}
