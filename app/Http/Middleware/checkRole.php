<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class checkRole
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
//        $role=Auth::user();
//        if(Auth::user()->role ==1 ){
//
////            $role=Auth::user()->role();
////            $aaa=Auth::check();
//            return response()->json(Auth::check());
////            return response()->json($aaa);
//            return redirect()->route('login')->with('message','Không có quyền truy cập');
//        }
        return $next($request);
    }
}
