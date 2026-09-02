<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Projects;
use App\Models\Programs;
use App\Models\ProgramTask;
use Validator;

class AdminProgramsController extends Controller
{
    public function index(Request $request)
    {
        $user_id = auth()->user()->id;
        $projects = Projects::select('projects.*')
            ->join('user_projects', 'projects.id', '=', 'user_projects.project_id')
            ->where('user_projects.user_id', $user_id)
            ->where('user_projects.program_access', 1)
            ->where('status', 1)
            ->orderBy('projects.id', 'DESC')
            ->get();

        return view('admin.programs.index', compact('projects'));
    }

    public function create()
    {
        $user_id = auth()->user()->id;
        $projects = Projects::select('projects.*')
            ->join('user_projects', 'projects.id', '=', 'user_projects.project_id')
            ->where('user_projects.user_id', $user_id)
            ->where('status', 1)
            ->orderBy('projects.id', 'DESC')
            ->get();

        return view('admin.programs.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'project' => 'required',
            'program_date' => 'required',
            'note' => 'required',
            'task' => 'required',
        ], [
            'project.required' => 'Project is Required',
            'program_date.required' => 'Program Date is Required',
            'note.required' => 'Note is Required',
            'task.required' => 'Task Topic is Required',
        ]);
        if ($validate->fails()) {
            return back()->withErrors($validate->errors())->withInput();
        }
        if (!admin_user_can_access_project($request->project)) {
            return redirect()->back()->with('error', 'Something went wrong. Please Try Again.');
        }

        $programRecord = Programs::where('project_id', $request->project)->whereDate('program_date', $request->program_date)->first();
        if ($programRecord) {
            return redirect()->back()->with('error', 'Already Created program with this date.');
        }
        $programData = new Programs();
        $programData['project_id'] = $request->project;
        $programData['program_date'] = $request->program_date;
        $programData['note'] = $request->note;
        if ($programData->save()) {
            $taskArray = $request->task;
            for ($i = 0; $i < count($taskArray); $i++) {
                $programTaskData = new ProgramTask();
                $programTaskData['program_id'] = $programData->id;
                $programTaskData['task'] = $taskArray[$i];
                $programTaskData->save();
            }
            return redirect()->back()->with('success', 'Successfully Created');
        } else {
            return redirect()->back()->with('error', 'Something went wrong. Please Try Again.');
        }
    }

    public function update(Request $request, $id) {
        $programRecord = Programs::where(['id' => $id])->first();
        if (empty($programRecord) || !admin_user_can_access_project($programRecord->project_id)) {
            return redirect()->back()->with('error', 'Something Worng');
        } else {
            $programRecord['note'] = $request->note;
            if ($programRecord->save()) {
                //existing record updationn
                $existTaskIdArray = $request->existTaskId;
                $existTaskArray = $request->existTask;
                for ($i = 0; $i < count($existTaskIdArray); $i++) {
                    $existTaskIdVal = $existTaskIdArray[$i];
                    $existTaskval = $existTaskArray[$i];
                    $programTaskData = ProgramTask::where(['id' => $existTaskIdVal])->first();
                    $programTaskData['task'] = $existTaskval;
                    $programTaskData->save();
                }
                // if new record
                if ($request->task) {
                    $taskArray = $request->task;
                    for ($i = 0; $i < count($taskArray); $i++) {
                        if (!empty($taskArray[$i])) {
                            $programTaskData = new ProgramTask();
                            $programTaskData['program_id'] = $id;
                            $programTaskData['task'] = $taskArray[$i];
                            $programTaskData->save();
                        }
                    }
                }
                return redirect()->back()->with('success', 'Successfully Updated');
            }
        }
    }

    public function fetch_program(Request $request)
    {
        $user_id = auth()->user()->id;
        $projects = Projects::select('projects.*')
            ->join('user_projects', 'projects.id', '=', 'user_projects.project_id')
            ->where('user_projects.user_id', $user_id)
            ->where('status', 1)
            ->orderBy('projects.id', 'DESC')
            ->get();

        $projectReq = $request->get('project');
        $program_date = $request->get('program_date');
        $programData = Programs::where('project_id', $projectReq)->whereDate('program_date', $program_date)->first();
        $programTaskData = array();
        if (!empty($programData)) {
            $programTaskData = ProgramTask::where('program_id', $programData->id)->get();
        }
        return view('admin.programs.index', compact('programData', 'programTaskData', 'projects'))->render();
    }


    public function destroyTask($id)
    {
        $programTask = ProgramTask::find($id);
        if (!$programTask) {
            return response()->json(['message' => 'Record not found'], 404);
        }
        $program = Programs::find($programTask->program_id);
        if (!$program || !admin_user_can_access_project($program->project_id)) {
            return response()->json(['message' => 'Record not found'], 404);
        }
        $programTask->delete();
        return response()->json(['message' => 'Record deleted'], 200);
    }
}
