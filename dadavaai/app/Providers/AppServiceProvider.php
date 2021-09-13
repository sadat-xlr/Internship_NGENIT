<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Validator;
use GuzzleHttp\Client;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Validator::extend('reCaptcha', function($attribute, $value, $parameters) {

            // Validate ReCaptcha
            $client = new Client([
                'base_uri' => 'https://google.com/recaptcha/api/'
            ]);

            $response = $client->post('siteverify', [
                'query' => [
                    'secret' => '6LdsZcMZAAAAAPVh4jkBo6-Rplhpv_Ed8KydnUdK',
                    'response' => $value
                ]
            ]);

            return json_decode($response->getBody())->success;




            // return substr($value, 0, 3) == '+91';
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
