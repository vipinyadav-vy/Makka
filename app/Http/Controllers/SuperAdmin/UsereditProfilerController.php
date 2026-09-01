<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Hash;


class UsereditProfilerController extends Controller
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
        return view('superadmin.profiler.edit');
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
 
    public function edit()
    {
        $user_edit = User::where('role', '0')->first();
        $authenticatedUserId = auth()->user()->id;
        return view('superadmin.profiler.edit', compact('user_edit', 'authenticatedUserId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
 
     public function update_profile_super(Request $request, $id)
     {
         $user = User::find(auth()->user()->id);
      
         $validatedData = $request->validate([
             'name' => 'required|string|max:255',
             'email' => 'required|email|unique:users,email,'.$user->id,
             'mobile' => 'required|string|max:255',
         ]);
     
         $user->name = $validatedData['name'];
         $user->email = $validatedData['email'];
         $user->mobile = $validatedData['mobile'];
          
         if ($user->save()) {
             return redirect()->back()->with('success', 'Profile updated successfully');
         } else {
             return redirect()->back()->with('failed', 'Failed to update User Profile');
         }
     }
     public function change_password_Profile_super(Request $request, $id)
     {
         $user = User::find(auth()->user()->id);
         
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
             return redirect()->back()->with('success', 'Password Change Successful');
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
