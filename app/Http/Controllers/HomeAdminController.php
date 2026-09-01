<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Questions;
use App\Models\Shoping;
use App\Models\Location;
use App\Models\CreateUser;
use App\Models\IssueReport;
use App\Models\UserProject;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Auth;

class HomeAdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {       
        return view('dashboard');
     }

     public function adminHome(){

        $user_id = auth()->user()->id;
        $userData = User::find($user_id);
        $projectsCount = UserProject::where('user_id', $user_id)->count();

        return view('admin.dashboard', compact('projectsCount'));
    }


  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
    */

}
