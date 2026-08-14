<?php

namespace App\Http\Middleware;

use App\Support\RoleHome;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class RoleMiddleware
{
    public function __construct(
        protected Guard $auth
    ) {}

    /**
     * @return array<int|string>
     */
    abstract protected function allowedRoles(): array;

    protected function deniedMessage(): string
    {
        return 'Sin privilegios para Ingresar';
    }

    protected function unknownRoleMessage(): string
    {
        return 'Sin privilegios de administrador';
    }

    public function handle(Request $request, Closure $next): Response
    {
        if (! $this->auth->check()) {
            return redirect()->route('login');
        }

        $user = $this->auth->user();
        $rol = (string) $user->rol;

        if (in_array($rol, RoleHome::normalizeRoles($this->allowedRoles()), true)) {
            if (RoleHome::requiresPasswordChange($user)) {
                return redirect(RoleHome::changePasswordPath());
            }

            return $next($request);
        }

        session()->flash('message-error', $this->deniedMessage());

        if (RoleHome::requiresPasswordChange($user)) {
            return redirect(RoleHome::changePasswordPath());
        }

        if (RoleHome::has($rol)) {
            return redirect(RoleHome::pathFor($rol));
        }

        session()->flash('message-error', $this->unknownRoleMessage());

        return redirect()->route('login');
    }
}
