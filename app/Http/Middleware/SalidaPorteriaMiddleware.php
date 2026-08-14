<?php

namespace App\Http\Middleware;

class SalidaPorteriaMiddleware extends RoleMiddleware
{
    protected function allowedRoles(): array
    {
        return ['9'];
    }
}
