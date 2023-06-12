<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class roleUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, string $role)
    {
        // Si $role n'est pas nul, convertissez-le en tableau
        $roles = !is_null($role) ? (is_array($role) ? $role : explode('|', $role)) : [];

        // Vérifiez si l'utilisateur authentifié a l'un des rôles spécifiés
        if (in_array($request->user()->type, $roles)) {
            return $next($request);
        }

        // Si l'utilisateur n'a pas le rôle requis, interrompez la requête avec une erreur 403 Forbidden
        abort(403);
    }

}

