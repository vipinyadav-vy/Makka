<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Projects;
use App\Models\WebForm;
use App\Models\ProjectWebform;
use Auth;
use DB;

class AdminProjectsController extends Controller
{
    public function index(Request $request)
    {
        $user_id = auth()->user()->id;
        $projects = Projects::select('projects.*')
            ->join('user_projects', 'projects.id', '=', 'user_projects.project_id')
            ->where('user_projects.user_id', $user_id)
            ->orderBy('projects.id', 'DESC')
            ->paginate(10)
            ->withQueryString();
        return view('admin.projects.index', compact('projects'));
    }

    public function edit($id)
    {
        $record = Projects::select('projects.*')
            ->join('user_projects', 'projects.id', '=', 'user_projects.project_id')
            ->where('user_projects.user_id', auth()->id())
            ->where('projects.id', $id)
            ->first();

        if(!$record){
            return redirect()->back()->with('danger', 'Something Worng');
        }

        $webforms = WebForm::orderBy('id','DESC')->get();
        $linkedWebforms = ProjectWebform::select('webform_id')->where('project_id', $id)->orderBy('id','DESC')->get();
        $webformIds = $linkedWebforms->pluck('webform_id')->toArray();
        return view('admin.projects.edit', compact('record', 'webforms', 'webformIds'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:projects,name,' . $id,
            ], [
                'name.required' => 'Project name is required',
                'name.unique' => 'Project name already exists'
            ]
        );

        $record = Projects::select('projects.*')
            ->join('user_projects', 'projects.id', '=', 'user_projects.project_id')
            ->where('user_projects.user_id', auth()->id())
            ->where('projects.id', $id)
            ->first();

        if (empty($record)) {
            return redirect()->back()->with('danger', 'Something Worng');
        } else {
            $record->name = $request->name;
            if ($record->save()) {
                ProjectWebform::where('project_id', $id)->delete();
                if(isset($request->webforms) && count($request->webforms) > 0){
                    foreach ($request->webforms as $webform) {
                        $assignWebform = new ProjectWebform();
                        $assignWebform["project_id"] = $id;
                        $assignWebform["webform_id"] = $webform;
                        $assignWebform->save();
                    }
                }
                return redirect()->route('user_projects.index')->with('success', 'Project updated successfully.');
            } else {
                return redirect()->route('user_projects.edit')->with('error', 'Somthing Wrong.');
            }
        }
    }

    public function update_status_project(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        $page = Projects::select('projects.*')
            ->join('user_projects', 'projects.id', '=', 'user_projects.project_id')
            ->where('user_projects.user_id', auth()->id())
            ->where('projects.id', $id)
            ->first();
        if (!$page) {
            return response()->json(['code' => 404, 'error' => true, 'message' => 'Record not found']);
        }
        $page->status = $status;
        $page->save();

        if ($page->status == '1') {
            return response()->json(['code' => 200, 'success' => true, 'message' => 'Status Activated successfully.']);
        } else {
            return response()->json(['code' => 200, 'error' => true, 'message' => 'Status Deactivated successfully.']);
        }
    }

    public static function getProjectWebForms($user_id){
        return Projects::select('projects.*')
            ->join('user_projects', 'projects.id', '=', 'user_projects.project_id')
            ->where('user_projects.user_id', $user_id)
            ->orderBy('projects.id', 'DESC')->count();
    }
}
