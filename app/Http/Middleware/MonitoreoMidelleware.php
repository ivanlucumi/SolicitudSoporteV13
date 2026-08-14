<?php

namespace App\Http\Middleware;

class MonitoreoMidelleware extends RoleMiddleware
{
    protected function allowedRoles(): array
    {
        return ['5'];
    }
}
