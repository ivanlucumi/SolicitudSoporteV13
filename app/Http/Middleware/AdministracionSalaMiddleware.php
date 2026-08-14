<?php

namespace App\Http\Middleware;

class AdministracionSalaMiddleware extends RoleMiddleware
{
    protected function allowedRoles(): array
    {
        return ['21'];
    }
}
