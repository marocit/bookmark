<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
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
        $user = $request->user();

        if( $user && $user->isAdmin == 1 ) {
            return $next($request);
        }
        // if (Auth::user()->isAdmin == true) {
        //     return $next($request);
        //  }

        // return back()->withInput();
        return redirect()->route('login');
        // return redirect('/login');
         // abort(404, 'No way');
    }
}
