<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class checkLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            if($request->ajax()){
                $res['status'] = false;
                $res['unlogin'] = true;
                return response()->json($res);
            }
            return redirect('/login');
        }
        return $next($request);
    }
}
