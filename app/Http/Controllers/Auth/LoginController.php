<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\CreateUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class LoginController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = "superadmin/home";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        
        $this->validateLogin($request);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        $email = request()->input("email");
        // check exists in database or not.
        // if(!User::where("email",$email)->count() && !CreateUser::where([["email",$email],["is_deleted",0]])->count()){
        //     return $this->sendFailedLoginResponse($request,$this->username(),ucfirst($this->username())." does'nt exists in our records.");
        // }

        if ($this->attemptLogin($request)) {
            
            $this->redirectTo = "superadmin/home";
            if(auth()->user()->role == 1 || auth()->user()->role == 2 || auth()->user()->role == 3){
                $this->redirectTo = "admin/dashboard";
            }
           
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }

            return $this->sendLoginResponse($request);
        }
        
        // if($this->attemptLogin($request,"createuser")){
            
        //     $this->redirectTo = "admin/dashboard-admin";
        //     if ($request->hasSession()) {
        //         $request->session()->put('auth.password_confirmed_at', time());
        //     }
            
        //     return $this->sendLoginResponse($request,"createuser");
        // }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request,"password","Password didn't matched.");
    }

    public function logout(Request $request)
    {   

        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/login');
    }

    protected function sendLoginResponse(Request $request,$guard="web")
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if ($response = $this->authenticated($request, auth()->guard($guard)->user())) {
            return $response;
        }

        return $request->wantsJson()
                    ? new JsonResponse([], 204)
                    : redirect()->intended($this->redirectPath());
    }

    protected function attemptLogin(Request $request,$guard="web")
    {
        return Auth::guard($guard)->attempt(
            $this->credentials($request), $request->boolean('remember')
        );
    }

    protected function guard()
    {
        return Auth::guard($this->activeGuard());
    }


    function activeGuard(){

        foreach(array_keys(config('auth.guards')) as $guard){
        
            if(auth()->guard($guard)->check()) return $guard;
        
        }

        return null;

    }

    protected function sendFailedLoginResponse(Request $request,$key=false,$msg=false)
    {
        $key = $key?$key:$this->username();
        $msg = $msg?$msg:trans('auth.failed');
        throw ValidationException::withMessages([
            $key => [$msg],
        ]);
    }

}
