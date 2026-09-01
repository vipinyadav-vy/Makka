<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseController as BaseController;

use App\Models\User;
use App\Models\UserProject;
use App\Models\UserWebform;
use App\Mail\Register;
use App\Models\Projects;
use App\Models\ProjectWebform;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends BaseController {
  public function __construct() {
    //
  }
  
    public function userList(Request $request) {
        $projects = User::orderBy('id','DESC')->get();
        if($projects){
            return $this->sendSuccess('User List',$projects);
        } else {
          return $this -> sendFailed('Something Went wrong. Please Try again.');
        }
    }
    
    
    
    public function addUser(Request $request){
        
        $validator = Validator:: make($request -> all(), [
                'user_name' => 'required',
                'email' => 'required|unique:users,email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            ]
        );
        if ($validator->fails()) {
            return $this->sendFailed($validator -> errors() -> first());
        }
        
        $createupassword = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength1 = strlen($createupassword);
        $passwordnew = '';

        for ($i = 0; $i < 8; $i++) {
            $passwordnew .= $createupassword[rand(0, $charactersLength1 - 1)];
        }
        
        
        $createuser = new User();
        $createuser['user_name'] = $request->user_name;
        $createuser['email'] = $request->email;
        $createuser->role = 1;
        $createuser['password']  = Hash::make($passwordnew);
        
        if ($createuser->save()) {
            //Mail::to($request->email)->send(new Register($request->user_name, $request->email, $passwordnew, $createuser->role));
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
            return $this->sendSuccess('User Created Successfully');
        } else {
            return $this -> sendFailed('Something Went wrong. Please Try again.');
        }
    }
    
    
    
    
        public function changeUserStatus(Request $request){
        $validator = Validator:: make($request -> all(), [
                'id' => 'required',
                'status'=> 'required',
            ]
        );
        if ($validator->fails()) {
            return $this->sendFailed($validator -> errors() -> first());
        }
        $data = User::find($request->id);
        if(empty($data)){
            return $this->sendFailed('Record Does not Exist');
        }
        $data->status = $request->status;
        if ($data->save()) {
            if ($data->status == '1') {
                return $this->sendSuccess('Status Activated successfully');
            } else {
                return $this->sendSuccess('Status Deactivated successfully');
            }
        } else {
            return $this -> sendFailed('Something Went wrong. Please Try again.');
        }
    }
    
    
     public function updateUser(Request $request)
    {
        $validator = Validator:: make($request -> all(), [
                'id' => 'required',
                'user_name'=> 'required',
            ]
        );
        if ($validator->fails()) {
            return $this->sendFailed($validator -> errors() -> first());
        }
        $id = $request->id;
        
        $createuser_up = User::where(['id' => $request->id])->first();
        if (empty($createuser_up)) {
            return $this -> sendFailed('Something Went wrong. Please Try again.');
        } else {
            $createuser_up['user_name'] = $request->user_name;
            if ($createuser_up->save()) {
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
                return $this->sendSuccess('User updated successfully');
            } else {
            return $this -> sendFailed('Something Went wrong. Please Try again.');
            }
        }
    }

    
    
}




