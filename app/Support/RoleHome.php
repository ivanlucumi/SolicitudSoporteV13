<?php

namespace App\Support;

use Illuminate\Contracts\Auth\Authenticatable;

class RoleHome
{
    public const CHANGE_PASSWORD_PATH = '/cambiarPassword/nueva/contrasena';

    private const PATHS = [
        '1'  => 'administrador/',
        '2'  => 'tecnicos/',
        '3'  => 'usuarios/',
        '4'  => 'reservas/',
        '5'  => 'monitoreo/',
        '6'  => 'parqueadero/',
        '7'  => 'inpec/',
        '8'  => 'porteria/ingreso',
        '9'  => 'porteria/salida',
        '10' => 'coordinador/ingresos',
        '11' => 'revision/proceso/digitalizacion',
        '12' => 'servisoft/',
        '13' => 'mantenimiento/reporte/incidentes',
        '14' => 'reporte/incidentes/operario/',
        '15' => 'oficina/reparto',
        '16' => 'oficina/reparto',
        '17' => 'tecnico/soporte',
        '19' => 'registro/expedientes',
        '20' => 'notificaciones',
        '21' => '/administracion/reserva/salas',
        '23' => '/administracion/solicitud/fichas',
        '24' => '/vigilancia/judicial/solicitudes',
        '25' => '/almacen',
        '27' => 'conductores',
        '28' => 'encuestas-llamadas',
    ];

    public static function pathFor(mixed $rol): string
    {
        return self::PATHS[(string) $rol] ?? 'administrador/';
    }

    public static function has(mixed $rol): bool
    {
        return array_key_exists((string) $rol, self::PATHS);
    }

    public static function requiresPasswordChange(Authenticatable $user): bool
    {
        return (int) ($user->cambiopassword ?? 0) !== 1;
    }

    public static function changePasswordPath(): string
    {
        return self::CHANGE_PASSWORD_PATH;
    }

    /**
     * @param  array<int|string>  $roles
     * @return array<string>
     */
    public static function normalizeRoles(array $roles): array
    {
        return array_map('strval', $roles);
    }
}
