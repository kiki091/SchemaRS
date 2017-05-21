<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Session;
use Route;
use App\Services\Auth\PrivilegeChecker;

class UserPrivilege
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        try {
            $session            = Session::get('user_info');

            if (!isset($session['user_privilage'][0]['role_name']) && empty($session['user_privilage'][0]['role_name'])) {
                return response()->json(['message' => 'No Privilege', 'status' => false]);
            }

            $privilegeChecker   = new PrivilegeChecker($session['user_privilage'][0]['role_name']);

            if (!$privilegeChecker->isAuthorized()) {
                return response()->json(['message' => 'No Privilege', 'status' => false]);
            }

            return $next($request);


        } catch (\Exception $e) {
            return response()->json(['message' => 'Internal Server Error', 'status' => false]);
        }
    }
}
