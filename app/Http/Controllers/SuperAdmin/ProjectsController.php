<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Projects;
use App\Models\WebForm;
use App\Models\ProjectWebform;
use Auth;
use DB;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $projects = Projects::orderBy('id', 'DESC')->paginate(10)->withQueryString();
        return view('superadmin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $webforms = WebForm::where('status', 1)->orderBy('id','DESC')->get();
        return view('superadmin.projects.create', compact('webforms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user_id = auth()->id();
        $this->validate($request, [
                'name' => 'required|unique:projects,name',
            ], [
                'name.required' => 'Project name is required',
                'name.unique' => 'Project name already exists'
            ]
        );

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
            return redirect()->route('projects.index')->with('success', 'Project created successfully');
        } else {
            return redirect()->back()->with('failed', 'Project could not create');
        }
    }
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
    public function edit($id)
    {
        $record = Projects::find($id);
        if(!$record){
            return redirect()->back()->with('danger', 'Something Worng');
        }
        $webforms = WebForm::orderBy('id','DESC')->get();
        $linkedWebforms = ProjectWebform::select('webform_id')->where('project_id', $id)->orderBy('id','DESC')->get();
        $webformIds = $linkedWebforms->pluck('webform_id')->toArray();
        return view('superadmin.projects.edit', compact('record', 'webforms', 'webformIds'));
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
        $record = Projects::find($id);
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
            return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
            } else {
                return redirect()->route('projects.edit')->with('error', 'Somthing Wrong.');
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
        $questions = Projects::where(['is_deleted' => 0])->find($id);
        if (empty($questions)) {
            return redirect()->back()->with('danger', 'Something Worng');
        } else {
            $questions['is_deleted'] = 1;
            if ($questions->save()) {
                return redirect()->route('questions.index')->with('success', 'Questions Centre deleted successfully');
            }
        }
        return redirect()->route('questions.index')
            ->with('success', 'Questions deleted successfully');
    }

    public function update_status_project(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        $page = Projects::find($id);
        $page->status = $status;
        $page->save();

        if ($page->status == '1') {
            return response()->json(['code' => 200, 'success' => true, 'message' => 'Status Activated successfully.']);
        } else {
            return response()->json(['code' => 200, 'error' => true, 'message' => 'Status Deactivated successfully.']);
        }
    }
}
