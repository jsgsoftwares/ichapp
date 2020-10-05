<?php

namespace App\Providers;

use Storage;
use League\Flysystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use Spatie\Dropbox\Client as DropboxClient;
use Spatie\FlysystemDropbox\DropboxAdapter;
class DropboxServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
            // Extendemos el Storage de Laravel agregando nuestro nuevo driver.
            Storage::extend('dropbox', function ($app, $config) { 
                $client = new DropboxClient(
                    $config['authorizationToken'] // Hacemos referencia al hash
                );
     
                return new Filesystem(new DropboxAdapter($client)); 
            });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
