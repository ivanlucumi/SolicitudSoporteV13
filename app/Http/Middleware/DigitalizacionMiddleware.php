<?php

namespace App\Http\Middleware;

class DigitalizacionMiddleware extends RoleMiddleware
{
    protected function allowedRoles(): array
    {
        return ['11'];
    }
}
