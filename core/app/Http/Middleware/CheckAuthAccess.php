<?php

namespace App\Http\Middleware;

use App\Utility\AuthHelper;
use Closure;
use Illuminate\Http\Request;

class CheckAuthAccess
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $accesses)
    {
        $user = AuthHelper::getUser();

       
        if($user['user']->role === 'admin')
            return $next($request);

        if(!empty(array_intersect($user['roles'], explode( ',', $accesses))))
            return $next($request);

        return response()->view('admin.shared.401', [], 403);
    }
}
