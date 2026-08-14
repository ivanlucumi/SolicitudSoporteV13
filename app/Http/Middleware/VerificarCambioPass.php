<?php

namespace App\Http\Middleware;

use App\Support\RoleHome;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerificarCambioPass
{
    public function __construct(
        protected Guard $auth
    ) {}

    public function handle(Request $request, Closure $next): Response
    {
        if (! $this->auth->check()) {
            return redirect()->route('login');
        }

        if (RoleHome::requiresPasswordChange($this->auth->user())) {
            return redirect(RoleHome::changePasswordPath());
        }

        return $next($request);
    }
}
