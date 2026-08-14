<?php

namespace App\Http\Middleware;

/**
 * Middleware para el módulo de Conductores.
 * Permite acceso a:
 *   - Rol 6  → Personal de portería/parqueadero (supervisores que registran la inspección)
 *   - Rol 26 → Conductor (diligencia su propia inspección preoperativa)
 */
class ConductorMiddleware extends RoleMiddleware
{
    protected function allowedRoles(): array
    {
        return ['6', '10', '27'];
    }
}
