<?php

namespace App\Http\Middleware;

use Closure;

class AdminLogin {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
    	
			// 判断session中的登陆信息
			if (!session('users')) {
				return redirect('admins/login');
			}
      return $next($request);
    }
		
}
