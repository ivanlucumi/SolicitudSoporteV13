<?php

namespace App\Http\Middleware;

class NotificacionMiddleware extends RoleMiddleware
{
    protected function allowedRoles(): array
    {
        return ['20'];
    }
}
