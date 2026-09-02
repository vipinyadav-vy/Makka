<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseController as BaseController;

use App\Models\Projects;
use App\Models\WebForm;
use App\Models\ProjectWebform;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Validator;

class ProjectController extends BaseController {
  public function __construct() {
    //
  }
  
    public function projectList(Request $request) {
        $projects = Projects::orderBy('id','DESC')->get();
        if($projects){
            return $this->sendSuccess('Project List',$projects);
        } else {
          return $this -> sendFailed('Something Went wrong. Please Try again.');
        }
    }
    
    
    
    public function createProject(Request $request){
        
        $validator = Validator:: make($request -> all(), [
                'name' => 'required|string|max:255|unique:projects,name',
                'webforms' => 'nullable|array',
                'webforms.*' => 'integer',
            ]
        );
        if ($validator->fails()) {
            return $this->sendFailed($validator -> errors() -> first());
        }
        $data = new Projects();
        $data->name = $request->name;
        if ($data->save()) {
            if(isset($request->webforms) && count($request->webforms) > 0){
                foreach ($request->webforms as $webform) {
                    $assignWebform = new ProjectWebform();
                    $assignWebform["project_id"] = $data->id;
                    $assignWebform["webform_id"] = $webform;
                    $assignWebform->save();
                }
            }
                  return $this->sendSuccess('Project Created Successfully');
        } else {
            return $this -> sendFailed('Something Went wrong. Please Try again.');
        }
    }
    
    
    
    
    
    public function editProject(Request $request)
    {
        
        $validator = Validator:: make($request -> all(), [
                'id' => 'required|integer',
            ]
        );
        if ($validator->fails()) {
            return $this->sendFailed($validator -> errors() -> first());
        }
        
        $projectDetails = Projects::find($request->id);
        if(!$projectDetails){
            return $this->sendFailed('Record Does not Exist');
        }
        $webforms = WebForm::orderBy('id','DESC')->get();
        $linkedWebforms = ProjectWebform::select('webform_id')->where('project_id', $request->id)->orderBy('id','DESC')->get();
        $webformIds = $linkedWebforms->pluck('webform_id')->toArray();
        
        return response()->json([
            'ResponseCode'=> 200,
            'status' => 'true',
            'message' => 'Project Details',
            'data' => [
                'projectDetails' => $projectDetails,
                'webforms' => $webforms,
                'webformIds' => $webformIds
            ]
        ]);
        
                 //   return $this->sendSuccess('Project Details',$projectDetails, $webforms, $webformIds);

    }
    
    
    public function updateProject(Request $request){
        $validator = Validator:: make($request -> all(), [
                'id' => 'required|integer',
                'name' => 'nullable|string|max:255',
                'webforms' => 'nullable|array',
                'webforms.*' => 'integer',
            ]
        );
        if ($validator->fails()) {
            return $this->sendFailed($validator -> errors() -> first());
        }
        $data = Projects::find($request->id);
        if(empty($data)){
            return $this->sendFailed('Record Does not Exist');
        }
        if($request->name){
            $data->name = $request->name;
        }else{
        $data->name = $data['name'];
        }
        if ($data->save()) {
            ProjectWebform::where('project_id', $request->id)->delete();
            if(isset($request->webforms) && count($request->webforms) > 0){
                foreach ($request->webforms as $webform) {
                    $assignWebform = new ProjectWebform();
                    $assignWebform["project_id"] = $data->id;
                    $assignWebform["webform_id"] = $webform;
                    $assignWebform->save();
                }
            }
            return $this->sendSuccess('Updated Successfully');
        } else {
            return $this -> sendFailed('Something Went wrong. Please Try again.');
        }
    }
    
    
    
    
    
    public function changeProjectStatus(Request $request){
        $validator = Validator:: make($request -> all(), [
                'id' => 'required|integer',
                'status'=> 'required|in:0,1',
            ]
        );
        if ($validator->fails()) {
            return $this->sendFailed($validator -> errors() -> first());
        }
        $data = Projects::find($request->id);
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
    
    
    
}




