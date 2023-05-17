<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MustBeAdmin
{
    public function handle(Request $request, Closure $next): mixed
    {
        if (auth()->user()?->username !== 'suredrope') {
            abort(Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
