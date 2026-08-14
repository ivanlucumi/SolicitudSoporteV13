<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\RegistroCorreo;
use App\Services\CorreoService;

class ReintentarCorreosFallidos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'correos:reintentar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reintenta el envio de correos fallidos de la tabla registro_correos';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Iniciando reintento de correos fallidos...');

        // Buscar correos fallidos con menos de 3 intentos
        $correosFallidos = RegistroCorreo::where('estado', 'FALLIDO')
            ->where('intentos', '<', 3)
            ->get();

        if ($correosFallidos->isEmpty()) {
            $this->info('No hay correos fallidos para reintentar.');
            return 0;
        }

        foreach ($correosFallidos as $registro) {
            $this->info("Reintentando correo ID {$registro->id} a {$registro->destinatario}...");
            $exito = CorreoService::enviarDesdeRegistro($registro);
            
            if ($exito) {
                $this->info("Correo ID {$registro->id} reenviado con EXITO.");
            } else {
                $this->error("Correo ID {$registro->id} VOLVIO A FALLAR.");
            }
        }

        $this->info('Proceso finalizado.');
        return 0;
    }
}
