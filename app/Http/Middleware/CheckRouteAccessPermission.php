<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRouteAccessPermission
{
    public function handle(Request $request, Closure $next, $permission)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        if (!auth()->user()->can($permission)) {
            abort(403, 'Unauthorized - You do not have required permission: ' . $permission);
        }
        return $next($request);
    }
}