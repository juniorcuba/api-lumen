<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

    'name' => env('APP_NAME', 'Lumen'),

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services your application utilizes. Set this in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),

    // Otras configuraciones ...

    /*
    |--------------------------------------------------------------------------
    | Facades
    |--------------------------------------------------------------------------
    |
    | Facades provide a "static" interface to classes that are available in
    | the application's service container. Laravel ships with many facades
    | which provide access to almost all of Laravel's features.
    |
    */
    'providers' => [
		Jenssegers\Mongodb\MongodbServiceProvider::class,
        PHPOpenSourceSaver\JWTAuth\Providers\LaravelServiceProvider::class,
        
	],

    'aliases' => [
        'App' => Illuminate\Support\Facades\App::class,
        'DB' => Illuminate\Support\Facades\DB::class,
        'Route' => Illuminate\Support\Facades\Route::class,
        'Storage' => Illuminate\Support\Facades\Storage::class,
    ],
    
];
