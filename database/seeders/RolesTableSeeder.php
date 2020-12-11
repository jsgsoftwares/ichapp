<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Rol;
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
                "enabled"=>0,
            ]);
        Rol::create(
            [
                "detalle"=>"Admin",
                "enabled"=>1,
            ]);
        Rol::create(
            [
                "detalle"=>"TeamLeader",
                "enabled"=>0,
            ]);

        Rol::create(
            [
                "detalle"=>"Leader",
                "enabled"=>0,
            ]);
        Rol::create(
            [
                "detalle"=>"Agent",
                "enabled"=>1,
            ]);
        Rol::create(
            [
                "detalle"=>"user",
                "enabled"=>0,
            ]);
    }
}
