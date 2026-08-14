<?php

namespace App\Http\Middleware;

class AdministradorMiddleware extends RoleMiddleware
{
    protected function allowedRoles(): array
    {
        return ['1'];
    }
}
