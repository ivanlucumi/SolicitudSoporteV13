<?php

namespace App\Http\Middleware;

class AlmacenMiddleware extends RoleMiddleware
{
    protected function allowedRoles(): array
    {
        return ['25'];
    }
}
