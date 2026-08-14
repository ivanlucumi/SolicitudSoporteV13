<?php

namespace App\Http\Middleware;

class TecnicoMiddleware extends RoleMiddleware
{
    protected function allowedRoles(): array
    {
        return ['2'];
    }
}
