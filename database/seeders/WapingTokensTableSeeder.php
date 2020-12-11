<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\wapingtoken;
class WapingTokensTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        wapingtoken::create([
            'token'=>'3009810fb275633fe293e23e391e597d',
            'enabled'=>1,
            'disponible'=>1,
            'companie_id'=>1,

            ]);
        

    }
}
