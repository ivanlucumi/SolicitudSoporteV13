<?php

namespace App\Http\Middleware;

class usuarioMiddleware extends RoleMiddleware
{
    protected function allowedRoles(): array
    {
        return ['3'];
    }
}
