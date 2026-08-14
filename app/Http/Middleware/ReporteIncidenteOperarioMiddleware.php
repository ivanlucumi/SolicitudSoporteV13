<?php

namespace App\Http\Middleware;

class ReporteIncidenteOperarioMiddleware extends RoleMiddleware
{
    protected function allowedRoles(): array
    {
        return ['14'];
    }
}
