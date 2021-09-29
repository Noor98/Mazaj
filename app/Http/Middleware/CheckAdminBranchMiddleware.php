<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdminBranchMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->user_type=='admin' || auth()->user()->user_type=='branch')
        return $next($request);
    else
       return redirect()->route('admin.dashboard')->withSuccess("لا يوجد لك صلاحية على الرابط المطلوب"); 
   }
}
