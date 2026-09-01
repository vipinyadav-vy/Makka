<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Mail;
use App\Models\WebForm;
use App\Models\Projects;
use App\Models\UserProject;
use App\Models\UserWebform;
use App\Mail\Register;
use Hash;
use DB;
use Auth;
use Validator;

class UserControllerSuperAdmin extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function index(Request $request)
    {
        $users = User::orderBy('id', 'DESC')->where(['role' => 1])->paginate(10)->withQueryString();
        return view('superadmin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = Projects::where(['status' => 1])->orderBy('id','DESC')->get();
        $webforms = WebForm::orderBy('id','DESC')->get();
        return view('superadmin.users.create', compact('projects', 'webforms'));
    }

    public function userChangeStatus(Request $request)
    {

        $user = CreateUser::find($request->user_id);
        $user->status = $request->status;
        $user->save();
        return response()->json(['success' => 'Status change successfully.']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $createupassword = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength1 = strlen($createupassword);

        $passwordnew = '';

        for ($i = 0; $i < 8; $i++) {
            $passwordnew .= $createupassword[rand(0, $charactersLength1 - 1)];
        }

        $validate = Validator::make($request->all(), [
            'user_name' => 'required',
            'email' => 'required|unique:users,email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            // 'signature' => 'required',
            // 'qualification' => 'required',

        ], [
            'user_name.required' => 'user_name Name is Required',
            'email.required' => 'User E-mail is Required',
            // 'signature.required' => 'User signature is Required',
            // 'qualification.required' => 'User Qualification is Required',
        ]);
        if ($validate->fails()) {
            return back()->withErrors($validate->errors())->withInput();
        }

        $createuser = new User();
        $createuser['user_name'] = $request->user_name;
        $createuser['email'] = $request->email;
        // $createuser['signature'] = $request->signature;
        // $createuser['qualification'] = $request->qualification;
        $createuser->role = 1;
        $createuser['password']  = Hash::make($passwordnew);

        if ($createuser->save()) {
            Mail::to($request->email)->send(new Register($request->user_name, $request->email, $passwordnew, $createuser->role));
            if(isset($request->projects)) {
                foreach ($request->projects as $project) {
                    if(isset($project["project"])){
                        $assignProject = new UserProject();
                        $assignProject["user_id"] = $createuser->id;
                        $assignProject["project_id"] = $project["project"];
                        $assignProject["program_access"] = $project["program"] ?? 0;
                        $assignProject["diary_access"] = $project["diary"] ?? 0;
                        $assignProject["webforms_access"] = $project["webforms"] ?? 0;
                        $assignProject->save();

                        if(isset($project["webforms"])){
                            if(isset($project["webform_ids"]) && count($project["webform_ids"]) > 0){

                                foreach ($project["webform_ids"] as $webform) {
                                    $assignWebform = new UserWebform();
                                    $assignWebform["user_id"] = $createuser->id;
                                    $assignWebform["project_id"] = $project["project"];
                                    $assignWebform["webform_id"] = $webform;
                                    $assignWebform->save();
                                }

                            }
                        }
                    }
                }
            }
            return redirect()->route('users.index')->with('success', 'User Created successfully');
        } else {
            return redirect()->back()->with('failed', 'Something went wrong. Please Try Again.');
        }
    }

    public function updateStatus(Request $request)
    {

        $user = User::find($request->id);

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not found.']);
        }

        // Update the user status
        $user->is_active = ($request->status === 'Active') ? 1 : 0;
        $user->save();

        return response()->json(['success' => true, 'message' => 'User status updated successfully.']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $createuser_edit = User::where(['is_deleted' => 0])->with('userProjects')->with('userWebforms')->find($id);
        $projects = Projects::where(['status' => 1])->orderBy('id','DESC')->get();
        $webforms = WebForm::orderBy('id','DESC')->get();
        return view('superadmin.users.edit', compact('createuser_edit', 'projects', 'webforms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        // echo "<pre>";
        // print_r($request->all());
        // exit;
        $validate = Validator::make($request->all(), [
            'user_name' => 'required',
        ], [
            'user_name.required' => 'user_name Name is Required',
        ]);
        if ($validate->fails()) {
            return back()->withErrors($validate->errors())->withInput();
        }

        $createuser_up = User::where(['id' => $id])->first();

        if (empty($createuser_up)) {
            return redirect()->back()->with('danger', 'Something Worng');
        } else {

            $createuser_up['user_name'] = $request->user_name;
            if ($createuser_up->save()) {

                // UserProject::where('user_id', $id)->delete();
                // UserWebform::where('user_id', $id)->delete();
                if (isset($request->projects)) {
            
                    foreach ($request->projects as $project) {
                        if(isset($project["project"])){

                            $existProject = UserProject::where('user_id', $id)->where('project_id', $project["project"])->first();

                            if($existProject){
                                $existProject["program_access"] = $project["program"] ?? 0;
                                $existProject["diary_access"] = $project["diary"] ?? 0;
                                $existProject["webforms_access"] = $project["webforms"] ?? 0;
                                $existProject->save();
                            }else{
                            $assignProject = new UserProject();
                            $assignProject["user_id"] = $id;
                            $assignProject["project_id"] = $project["project"];
                            $assignProject["program_access"] = $project["program"] ?? 0;
                            $assignProject["diary_access"] = $project["diary"] ?? 0;
                            $assignProject["webforms_access"] = $project["webforms"] ?? 0;
                            $assignProject->save();
                            }

                            if(isset($project["webforms"])){
                                if(isset($project["webform_ids"]) && count($project["webform_ids"]) > 0){

                                    
                                    $WformIDsArrayForDelete = array();
                                   
                                    foreach ($project["webform_ids"] as $webform) {

                                        $WformIDsArrayForDelete[] = $webform;
                                        $existWebform = UserWebform::where('user_id', $id)->where('project_id', $project["project"])->where('webform_id', $webform)->first();
                                        if(!$existWebform){
                                            $assignWebform = new UserWebform();
                                            $assignWebform["user_id"] = $id;
                                            $assignWebform["project_id"] = $project["project"];
                                            $assignWebform["webform_id"] = $webform;
                                            $assignWebform->save();
                                        }
                                    }
                                    
                                    UserWebform::where('user_id', $id)
                                                ->where('project_id', $project["project"])
                                                ->whereNotIn('webform_id', $WformIDsArrayForDelete)
                                                ->delete();
                                    

                                }
                            }
                        }
                    }
                }
                return redirect()->route('users.index')->with('success', 'User updated successfully.');
            } else {
                return redirect()->route('users.edit')->with('error', 'Somthing went wrong.');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $createuser = CreateUser::where(['is_deleted' => 0])->find($id);
        if (empty($createuser)) {
            return redirect()->back()->with('danger', 'Something Worng');
        } else {
            $createuser['is_deleted'] = 1;
            if ($createuser->save()) {
                return redirect()->route('users.index')->with('success', 'User Deleted Successfully');
            }
        }
        return redirect()->route('users.index')
            ->with('success', 'Createuser deleted successfully');
    }

    public function update_status_user(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        $page = User::find($id);
        $page->status = $status;
        $page->save();

        if ($page->status == '1') {
            return response()->json(['code' => 200, 'success' => true, 'message' => 'Status Activated successfully.']);
        } else {
            return response()->json(['code' => 200, 'error' => true, 'message' => 'Status Deactivated successfully.']);
        }
    }

    public static function getProjectWebForms($project_id){
        $webforms = DB::table('webforms')
            ->select('webforms.*')
            ->join('project_webforms', 'webforms.id', '=', 'project_webforms.webform_id')
            ->where('project_webforms.project_id', $project_id)
            ->get();
        return $webforms;
    }

    public function getUserFormAccess($id){

        $webforms = DB::table('user_webforms')
        ->select('user_webforms.id', 'user_webforms.form_view', 'projects.name as pname', 'webforms.title as fname')
        ->join('projects', 'projects.id', '=', 'user_webforms.project_id')
        ->join('webforms', 'webforms.id', '=', 'user_webforms.webform_id')
        ->where('user_webforms.user_id', $id)->paginate(20)->withQueryString();

        return view('superadmin.users.webforms_access', compact('webforms'));
    }

    public function updateUserFormAccess(Request $request)
    {
        $id = $request->id;
        $form_view = $request->form_view;
        $page = UserWebform::find($id);
        $page->form_view = $form_view;
        $page->save();

        if ($page->form_view == '1') {
            return response()->json(['code' => 200, 'success' => true, 'message' => 'View permission granted successfully.']);
        } else {
            return response()->json(['code' => 200, 'error' => true, 'message' => 'View permission revoked successfully.']);
        }
    }

}
