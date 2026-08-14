<?php

namespace App\Http\Middleware;

class ReservaMiddleware extends RoleMiddleware
{
    protected function allowedRoles(): array
    {
        return ['4'];
    }
}
