<?php

namespace App\Http\Middleware;

class RepartoMiddleware extends RoleMiddleware
{
    protected function allowedRoles(): array
    {
        return ['15', '16'];
    }
}
