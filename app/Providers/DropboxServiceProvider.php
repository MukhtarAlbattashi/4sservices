<?php

namespace App\Providers;

use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;
use Spatie\Dropbox\Client as DropboxClient;
use Spatie\FlysystemDropbox\DropboxAdapter;
use Illuminate\Contracts\Foundation\Application;
use GuzzleHttp\Client;


class DropboxServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
//        Storage::extend('dropbox', function ($app, $config) {
//            $client = new DropboxClient(
//                $config['authorization_token']
//            );
//
//            $adapter = new DropboxAdapter($client);
//            $driver = new Filesystem($adapter, ['case_sensitive' => false]);
//
//            return new FilesystemAdapter($driver, $adapter);
//        });
        Storage::extend('dropbox', function (Application $app, array $config) {
            $resource = (new Client())->post($config['token_url'], [
                'form_params' => [
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $config['refresh_token']
                ]
            ]);

            $accessToken = json_decode($resource->getBody(), true)['access_token'];

            $adapter = new DropboxAdapter(new DropboxClient($accessToken));

            return new FilesystemAdapter(new Filesystem($adapter, $config), $adapter, $config);
        });
    }
}
