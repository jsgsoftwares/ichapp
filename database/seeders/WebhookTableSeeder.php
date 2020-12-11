<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Webhook;
class WebhookTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Webhook::create(
            [
                'canal_id'=>'1',
                'cliente_id'=>'1',
                'mensaje'=>'hola',
                'mytoken'=>'1AAHx7pPe88qNdiT2AKKXgmOydRjrFi1V3Ec'
            ]
            );

    }
}
