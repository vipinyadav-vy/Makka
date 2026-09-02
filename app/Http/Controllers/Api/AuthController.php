<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\CreateUser;
use App\Models\User;
use App\Models\UserWebform;
use App\Models\IssueReport;
use App\Models\IssueReportDetail;
use App\Models\CleanerLoginHistory;
use App\Models\Shoping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;

class AuthController extends BaseController {
  public function __construct() {
    // $this->middleware('auth:createuser');
  }

  public function userLogin(Request $request) {
        // Validate Request Data
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'password' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return $this->sendFailed($validator->errors()->first());
        }
        // Check if user exists with given role
        $user = User::where("email", $request->email)->where("role", 1)->first();
        if (!$user) {
            return $this->sendFailed('Invalid login credentials.');
        }
        // Check if password is correct
        if (!Hash::check($request->password, $user->password)) {
            return $this->sendFailed('Invalid login credentials.');
        }
        // Check if the account is active
        if ($user->status == 0) {
            return $this->sendFailed('Your account is deactivated. Please contact the Administrator.');
        }
        return $this->sendSuccess('User login successfully.', [$user]);
    }

    public function userWebFormAccess(Request $request){
        // Validate Request Data
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return $this->sendFailed($validator->errors()->first());
        }
        $webforms = DB::table('user_webforms')
        ->select('user_webforms.id', 'user_webforms.form_view', 'projects.name as pname', 'webforms.title as fname')
        ->join('projects', 'projects.id', '=', 'user_webforms.project_id')
        ->join('webforms', 'webforms.id', '=', 'user_webforms.webform_id')
        ->where('user_webforms.user_id', $request->user_id)->get();
        return $this->sendSuccess('User Web Form Access', $webforms);
    }
    
    
public function userWebFormAccessStatusUpdate(Request $request)
    {
        // Validate Request Data
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'form_view' => 'required|in:0,1',
        ]);
        if ($validator->fails()) {
            return $this->sendFailed($validator->errors()->first());
        }
        $id = $request->id;
        $form_view = $request->form_view;
        $data = UserWebform::find($id);
        if (empty($data)) {
            return $this->sendFailed('Record Does not Exist');
        }
        $data->form_view = $form_view;
        $data->save();

        if ($data->form_view == '1') {
            return $this -> sendSuccess('View permission granted successfully.');
        } else {
            return $this->sendFailed('View permission revoked successfully.');
        }
    }



function getShopingProfile() {
  $user_Shoping = Auth:: guard('users') -> user();
  return $this -> sendSuccess('User profile retrieved successfully.', ['user_data' => $user_Shoping]);
}

function getUserProfile() {
  $user = Auth:: guard('createuser') -> user();
  return $this -> sendSuccess('User login successfully.', ['user_data'=> $user]);

}

function updateUserProfile(Request $request) {
  try {
    $user = Auth:: guard('createuser') -> user();
    $user -> name = $request -> name;
    $user -> save();
    return $this -> sendSuccess('User register successfully.', ['user_data'=> $user]);
  } catch (\Throwable $e) {
    return $this -> sendFailed($e -> getMessage(). ' On Line '.$e -> getLine());
  }
}

}


