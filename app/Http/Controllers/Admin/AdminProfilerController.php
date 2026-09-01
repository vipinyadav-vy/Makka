<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CreateUser;
use Yajra\DataTables\Facades\DataTables;
use Hash;
use Illuminate\Validation\Rule;

class AdminProfilerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('superadmin.userprofiler.edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
  

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_profiler()
    {   
        $user_id = auth()->user()->id;
        $admin_edit = User::where(['id'=>$user_id])->first();

        return view('admin.userprofiler.edit',compact('admin_edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function update_profiler(Request $request, $id)
     {
         $user = auth()->user();
     
         $validatedData = $request->validate([
             'user_name' => 'required|string|max:255',
             'email' => 'required|email|unique:users,email,'.$user->id,
            // 'mobile' => 'required|string|max:255',
         ]);
     
         $user->user_name = $validatedData['user_name'];
         $user->email = $validatedData['email'];
        // $user->mobile = $validatedData['mobile'];
         
         if ($user->save()) {
             return redirect()->back()->with('success', 'User Profile updated successfully');
         } else {
             return redirect()->back()->with('failed', 'Failed to update User Profile');
         }
     }
    public function change_password_Profile(Request $request, $id)
    {
        $user = auth()->user();
        
        $this->validate($request, [
            'old_password' => [
                'required',
                function ($attribute, $value, $fail) use ($user) {
                    if (!Hash::check($value, $user->password)) {
                        $fail('The old password is incorrect.');
                    }
                },
            ],
            'new_password' => 'required|min:8', // Add any other validation rules for the new password if needed
        ]);
        // Update the password if it's not empty
        if (!empty($request->new_password)) {
            $user->password = bcrypt($request->input('new_password'));
        }
    
        if ($user->save()) {
            return redirect()->back()->with('success', 'User Password Change Successful');
        } else {
            return redirect()->back()->with('failed', 'Failed to update User Profile');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

}
