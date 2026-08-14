<?php

namespace App\Http\Middleware;

class FichaMiddleware extends RoleMiddleware
{
    protected function allowedRoles(): array
    {
        return ['23'];
    }
}
