<?php

namespace App\Http\Middleware;

class ReporteIncidenteMiddleware extends RoleMiddleware
{
    protected function allowedRoles(): array
    {
        return ['13'];
    }
}
