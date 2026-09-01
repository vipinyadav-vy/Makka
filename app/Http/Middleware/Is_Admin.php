<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Is_Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) { // Check if user is authenticated
            $user = auth()->user();
            if ($user->role == 1 || $user->role == 2 || $user->role == 3) {
                if($user->status == 1){
                    // User has role 1 and status 1
                    return $next($request);
                }else{
                    auth()->logout();
                    return redirect('login')->with("error", "Your Account has been deactived by admin.");
                }
              
            } else {
                // User does not have necessary role and status
                auth()->logout();
                return redirect('login')->with("error", "You don't have admin access.");
            }
        } else {
            // Handle the case when the user is not authenticated
            return redirect('login')->with("error", "You are not logged in.");
        }
    }


}
