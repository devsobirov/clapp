<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->id()) return redirect()->route('login');
        abort_if(!auth()->user()->is_admin, 404);
        return $next($request);
    }
}
