<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>



## Learning voixbot

Voixbot es una herramienta creada para centralizar la mensajeria de los canales de comunicacion como:
whatsapp,facebook,instagram,twitter,telegram.

Esta creada con tecnologia php con framework laravel y Vuejs en el frontend.

## Voixbot Laravel

Pasos para instalacion de voixbot:
- Descargar app de https://gitlab.com/Firedeer/voixbots.git.
- ejecutar comando npm install para instalar complementos.
- ejecutar comando php artisan migrate para instalar base de datos.
- ejecutar comando php artisan db:seed para insertar datos de inicio al app
- Modificar .env.


## Laravel Sponsors

We would like to extend our thanks to the following sponsors for helping fund on-going Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell):

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**

- **[British Software Development](https://www.britishsoftware.co)**


## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


##Step by Step

Hello my name is Johnny From Panama,
 This document is a step by step for installation of the voixbot, in the document find dependecy librery of the npm, should have preinstall nodejs and composer.

 1. the first step is clone project 


 npm i vue-router --save
 npm i bootstrap-vue
 npm i vuex --save
 composer install
 composer require pusher/pusher-php-server "~3.0
 npm install --save laravel-echo pusher-js

 Bot telegram
 composer require irazasyed/telegram-bot-sdk

 Telegram\Bot\Laravel\TelegramServiceProvider::class,
Add the following entry in aliases array to setup facade.

'Telegram' => Telegram\Bot\Laravel\Facades\Telegram::class,
You do not need to add service provider and facade if you are using laravel version 5.5 or above.

Now, publish configuration file for the above package by running the command below.

php artisan vendor:publish --provider="Telegram\Bot\Laravel\TelegramServiceProvider"
