<?php

namespace App\Http\Middleware;

class ServisoftMiddleware extends RoleMiddleware
{
    protected function allowedRoles(): array
    {
        return ['12'];
    }
}
