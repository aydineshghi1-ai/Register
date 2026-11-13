<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle( Request $request,  Closure $next,  string ...$roles): Response
    {
        $user = $request->user('api');

        if(! $user)
        {
            abort(401, 'Unauthorized access.');
        }

        if(! $user->hasAnyRole($roles))
        {
            abort(403, 'Forbidden.');
        }

        return $next($request);


    }
}
