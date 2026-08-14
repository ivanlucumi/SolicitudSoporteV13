<?php

namespace App\Http\Middleware;

use App\Support\RoleHome;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ?string $guard = null): Response
    {
        if ( auth()->guard($guard)->check()) {
            $user =  auth()->guard($guard)->user();

            if (RoleHome::requiresPasswordChange($user)) {
                return redirect(RoleHome::changePasswordPath());
            }

            return redirect(RoleHome::pathFor($user->rol));
        }

        return $next($request);
    }
}
