<?php

namespace App\Http\Middleware;

class IngresoPorteriaMiddleware extends RoleMiddleware
{
    protected function allowedRoles(): array
    {
        return ['8'];
    }
}
