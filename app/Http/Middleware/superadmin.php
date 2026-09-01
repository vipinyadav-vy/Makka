<?php
  
namespace App\Http\Middleware;
  
use Closure;
   
class superadmin
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
        if(auth()->check()) { // Check if user is authenticated

            if(auth()->user()->role == 0) {
                return $next($request);
            }
        
            auth()->logout();
            return redirect('login')->with("error", "You don't have admin access.");
        
        } else {
            // Handle the case when the user is not authenticated
            return redirect('login')->with("error", "You are not logged in.");
        }
        
        

    }
}