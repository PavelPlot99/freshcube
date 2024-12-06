<?php

namespace App\Providers;

use App\Services\AmoCrmService\AmoCrmService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(
            AmoCrmService::class,
            function (){
               return new AmoCrmService(
                    (string)config('services.amocrm.url'),
                    (string)config('services.amocrm.token')
            );
            }
        );
    }


    public function boot()
    {
        //
    }
}
