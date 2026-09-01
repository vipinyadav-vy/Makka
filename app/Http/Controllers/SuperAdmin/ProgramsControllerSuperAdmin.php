<?php
namespace App\Http\Controllers\SuperAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteSafetyInspection;
use App\Models\ToolBoxTalkRecords;
use App\Models\ToolBoxTalkAction;
use App\Models\ToolBoxTalkAttendance;
use App\Models\Projects;
use App\Models\Programs;
use App\Models\ProgramTask;
use App\Http\Controllers\SuperAdmin\Mediakit;
use Illuminate\Support\Facades\Mail;
use App\Mail\SiteInductionRecordMail;
use Hash;
use DB;
use Auth;
use Validator;
use PDF;
class ProgramsControllerSuperAdmin extends Controller
{
    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {    
        $projects = Projects::where('status',1)->orderBy('id','DESC')->get();

        return view('superadmin.programs.index', compact( 'projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $projects = Projects::where('status',1)->orderBy('id','DESC')->get();
        return view('superadmin.programs.create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

        $programRecord = Programs::where('project_id', $request->project)->whereDate('program_date', $request->program_date)->first();
            if($programRecord){
                return redirect()->back()->with('error','Already Created program with this date.');
            }
        $programData = new Programs();
            $programData['project_id'] = $request->project;
            $programData['program_date'] = $request->program_date;
            $programData['note'] = $request->note;
        if($programData->save()){
            $taskArray = $request->task;
            for ($i = 0; $i < count($taskArray); $i++) {
                $programTaskData = new ProgramTask();
                $programTaskData['program_id'] = $programData->id;
                $programTaskData['task'] = $taskArray[$i];
                $programTaskData->save();
            }
           return redirect()->back()->with('success','Successfully Created');
        } else {
            return redirect()->back()->with('error','Something went wrong. Please Try Again.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     
     public function update(Request $request,$id){
         
         print_r($request->all());
         
         exit;
       
        $programRecord = Programs::where(['id' => $id])->first();
        if (empty($programRecord)) {
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
                if($request->task){
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
                return redirect()->back()->with('success','Successfully Updated');
            }
        }
    }

    public function fetch_program(Request $request){
        $projects = Projects::where(['status' => 1])->orderBy('id','DESC')->get();
        $projectReq = $request->get('project');
        $program_date = $request->get('program_date');
        $programData = Programs::where('project_id',$projectReq)->whereDate('program_date', $program_date)->first();
        $programTaskData = array();
        if(!empty($programData)){
            $programTaskData = ProgramTask::where('program_id',$programData->id)->get();

        }
        return view('superadmin.programs.index', compact('programData','programTaskData','projects'))->render();
    }


    public function destroyTask($id){
        $programTask = ProgramTask::find($id);
        if (!$programTask) {
            return response()->json(['message' => 'Record not found'], 404);
        }
        $programTask->delete();
        return response()->json(['message' => 'Record deleted'], 200);
        }

    
}
