<?php

namespace App\Http\Middleware;

class EncuestaMiddleware extends RoleMiddleware
{
    protected function allowedRoles(): array
    {
        // 1 = Administrador general, 28 = Rol Encuesta
        return ['1', '28'];
    }
}
