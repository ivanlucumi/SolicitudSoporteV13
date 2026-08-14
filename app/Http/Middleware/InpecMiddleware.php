<?php

namespace App\Http\Middleware;

class InpecMiddleware extends RoleMiddleware
{
    protected function allowedRoles(): array
    {
        return ['7'];
    }
}
