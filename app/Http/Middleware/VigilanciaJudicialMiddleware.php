<?php

namespace App\Http\Middleware;

class VigilanciaJudicialMiddleware extends RoleMiddleware
{
    protected function allowedRoles(): array
    {
        return ['24'];
    }
}
