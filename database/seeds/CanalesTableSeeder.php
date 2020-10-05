<?php

use Illuminate\Database\Seeder;
use App\Canales;
class CanalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            Canales::create(
            [
                'detalle'=>'interno',
                'icon'=>'/assets/icons/interno.png',
                'fondo'=>'/assets/icons/interno.png'
            ]
            );

            Canales::create(
            [
                'detalle'=>'telegram',
                'icon'=>'/assets/icons/telegram.png',
                'fondo'=>'/assets/icons/telegram.png'
            ]
            );
            Canales::create(
                [
                    'detalle'=>'whatsapp',
                    'icon'=>'/assets/icons/whatsapp.png',
                    'fondo'=>'/assets/icons/whatsapp.png'
                ]
                );
            Canales::create(
                [
                    'detalle'=>'facebook',
                    'icon'=>'/assets/icons/facebook.png',
                    'fondo'=>'/assets/icons/facebook.png'
                ]
                );

            Canales::create(
                [
                    'detalle'=>'twitter',
                    'icon'=>'/assets/icons/twitter.png',
                    'fondo'=>'/assets/icons/twitter.png'
                ]
                );
            Canales::create(
                [
                    'detalle'=>'instagram',
                    'icon'=>'/assets/icons/instagram.png',
                    'fondo'=>'/assets/icons/instagram.png'
                ]
                );
                Canales::create(
                    [
                        'detalle'=>'dialogflow',
                        'icon'=>'/assets/icons/dialogflow.png',
                        'fondo'=>'/assets/icons/dialogflow.png'
                    ]
                    );

    }
}
