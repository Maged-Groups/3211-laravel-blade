<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Traits\FunctionsTrait;

class HasRolesMiddleware
{

    use FunctionsTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $roles): Response // handle($request, 'show')
    {
        $hasRoles = $this->hasRoles($roles);

        if ($hasRoles)
            return $next($request); // show($request)

        throw new Exception('You are not authorized to do this action!!!');

    }
}