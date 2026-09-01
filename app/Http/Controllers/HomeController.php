<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Projects;
use App\Models\WebForm;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
 
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {       
        $projectsCount = projects::count();
        $usersCount = User::where(['role'=>1])->count();
        $webformCount = WebForm::count();    
        return view('dashboard',compact('usersCount','projectsCount', 'webformCount'));
       
    }
    public function userEdit()
    {
        $user = auth()->user()->id;
        $users = User::where('id',$user)->first();
        return view('admin.Users.userProfile',compact('users'));
    }

    public function usersUpdate(Request $request)
    {          
        $user_id = $request->user_id;
        $data = User::where('id',$user_id)->first();
        $data->name  = $request->name;
        $data->email = $request->email;
        $data->mobile = $request->mobile;
        if(!empty($request->password))
        {
            $data->password = Hash::make($request->password);
        }else{
            $data->password = Hash::make($request->password_old);
        }
       
        if($data->save()){
            return redirect()->route('userProfile')->with('success','User Profile Updated successfully');
        } else {
            return redirect()->back()->with('failed','User Added Faild successfully');
        }
    }


  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
    */

}
