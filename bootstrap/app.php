<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
            'administrador' => \App\Http\Middleware\AdministradorMiddleware::class,
            'usuario' => \App\Http\Middleware\usuarioMiddleware::class,
            'tecnico' => \App\Http\Middleware\TecnicoMiddleware::class,
            'checarsesion' => \App\Http\Middleware\ChecarSesion::class,
            'reservas'       => \App\Http\Middleware\ReservaMiddleware::class,
            'cambiopass'       => \App\Http\Middleware\VerificarCambioPass::class,
            'monitoreo'     =>  \App\Http\Middleware\MonitoreoMidelleware::class,
            'inpec'     =>  \App\Http\Middleware\InpecMiddleware::class,
            'parqueadero'     =>  \App\Http\Middleware\ParqueaderoMiddleware::class,
            'ingresoporteria'     =>  \App\Http\Middleware\IngresoPorteriaMiddleware::class,
            'salidaporteria'     =>  \App\Http\Middleware\SalidaPorteriaMiddleware::class,
            'CoordinadorIngreso'     =>  \App\Http\Middleware\CoordinadoIngresoMiddleware::class,
            'Digitalizacion'     =>  \App\Http\Middleware\DigitalizacionMiddleware::class,
            'Servisoft'     =>  \App\Http\Middleware\ServisoftMiddleware::class,
            'Mantenimiento'     =>  \App\Http\Middleware\ReporteIncidenteMiddleware::class,
            'Operario'     =>  \App\Http\Middleware\ReporteIncidenteOperarioMiddleware::class,
            'Reparto'   =>  \App\Http\Middleware\RepartoMiddleware::class,
            'Mesa.Ayuda'   =>  \App\Http\Middleware\TecnicoSoporteMiddleware::class,
            'adminSalas'   =>  \App\Http\Middleware\AdministracionSalaMiddleware::class,
            'fichas'   =>  \App\Http\Middleware\FichaMiddleware::class,
            'vigilancia'   =>  \App\Http\Middleware\VigilanciaJudicialMiddleware::class,
            'almacen'   =>  \App\Http\Middleware\AlmacenMiddleware::class,
            'conductor'   =>  \App\Http\Middleware\ConductorMiddleware::class,
            'encuesta'    =>  \App\Http\Middleware\EncuestaMiddleware::class,
        ]);
        
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*'),
        );
    })->create();
