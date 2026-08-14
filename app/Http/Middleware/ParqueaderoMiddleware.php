<?php

namespace App\Http\Middleware;

class ParqueaderoMiddleware extends RoleMiddleware
{
    protected function allowedRoles(): array
    {
        return ['6'];
    }
}
