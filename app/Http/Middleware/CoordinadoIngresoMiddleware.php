<?php

namespace App\Http\Middleware;

class CoordinadoIngresoMiddleware extends RoleMiddleware
{
    protected function allowedRoles(): array
    {
        return ['10'];
    }
}
