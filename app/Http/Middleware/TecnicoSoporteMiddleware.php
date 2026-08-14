<?php

namespace App\Http\Middleware;

class TecnicoSoporteMiddleware extends RoleMiddleware
{
    protected function allowedRoles(): array
    {
        return ['17'];
    }
}
