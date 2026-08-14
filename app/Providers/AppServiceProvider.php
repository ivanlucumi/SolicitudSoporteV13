<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;


use SolicitudSoporte\Models\Ubicacion;
use SolicitudSoporte\Models\SalaAudiencia;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Cargar SDK de Google manualmente
       // require_once app_path('Libraries/google/autoload-google.php');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /* $this->app->bind('path.public', function(){
            return base_path().'/../../public_html';
        });*/
        
        \Illuminate\Pagination\Paginator::useBootstrap();
    }
}
