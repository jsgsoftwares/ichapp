<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Integraciones;
class IntegrationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Integraciones::create(
            [
            'canal_id'=>7,
            'name'=>'DialogFlow',
            'description'=>'Intuitive omnichannel conversational AI.',
            'avatar'=>'/assets/icons/dialogflow.jpg',
            'enabled'=>1
            ]
            );
        Integraciones::create(
        [
        'canal_id'=>3,
        'name'=>'Waboxapp',
        'description'=>'Message from whatsapp',
        'avatar'=>'/assets/icons/whatsapp.png',
        'enabled'=>0
        ]
        );
        Integraciones::create(
        [
        'canal_id'=>3,
        'name'=>'Waping',
        'description'=>'Integrate Waping With Your favorite services.',
        'avatar'=>'/assets/icons/waping.jpg',
        'enabled'=>1
        ]
        );
        Integraciones::create(
        [
        'canal_id'=>3,
        'name'=>'Whatsapp Business api ',
        'description'=>'Message from whatsapp',
        'avatar'=>'/assets/icons/whatsapp.png',
        'enabled'=>1
        ]
        );
        Integraciones::create(
        [
        'canal_id'=>3,
        'name'=>'messagebird',
        'description'=>'Api ',
        'avatar'=>'/assets/icons/whatsapp.png',
        'enabled'=>0
        ]
        );
        Integraciones::create(
        [
        'canal_id'=>3,
        'name'=>'twilio',
        'description'=>'Message from whatsapp',
        'avatar'=>'/assets/icons/whatsapp.png',
        'enabled'=>0
        ]
        );

        Integraciones::create(
        [
        'canal_id'=>5,
        'name'=>'twitter',
        'description'=>'',
        'avatar'=>'/assets/icons/whatsapp.png',
        'enabled'=>0
        ]
        );
        Integraciones::create(
        [
        'canal_id'=>2,
        'name'=>'Telegram',
        'description'=>'>Instant messaging in its purest form.',
        'avatar'=>'/assets/icons/telegram.png',
        'enabled'=>1
        ]
        );
        Integraciones::create(
        [
        'canal_id'=>4,
        'name'=>'Facebook',
        'description'=>'Connect With Your Friends Online.',
        'avatar'=>'/assets/icons/facebook.jpg',
        'enabled'=>1
        ]
        );
        Integraciones::create(
        [
        'canal_id'=>6,
        'name'=>'Instagram',
        'description'=>'',
        'avatar'=>'/assets/icons/instagram.png',
        'enabled'=>0
        ]
        );

    }
}
