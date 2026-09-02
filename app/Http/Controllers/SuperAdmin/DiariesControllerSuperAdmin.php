<?php
namespace App\Http\Controllers\SuperAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WebForm;
use App\Models\SiteSafetyInspection;
use App\Models\ToolBoxTalkRecords;
use App\Models\ToolBoxTalkAction;
use App\Models\ToolBoxTalkAttendance;
use App\Models\Projects;
use App\Models\Programs;
use App\Models\ProgramTask;
use App\Models\Diary;
use App\Models\DiaryEmploye;
use App\Models\DiaryImage;
use App\Http\Controllers\SuperAdmin\Mediakit;
use Illuminate\Support\Facades\Mail;
use App\Mail\SiteInductionRecordMail;
use Hash;
use DB;
use Auth;
use Validator;
use PDF;
class DiariesControllerSuperAdmin extends Controller
{
    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {    
        $projects = Projects::where('status',1)->orderBy('id','DESC')->get();
        return view('superadmin.diary.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $projects = Projects::orderBy('id','DESC')->get();
        return view('superadmin.toolboxTalkRecord.create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        
        $diaryData = new Diary();
            $diaryData['project_id'] = $request->project_id;
            $diaryData['program_id'] = $request->program_id;
            $diaryData['comments'] = $request->comments;
            $diaryData['program_diary_date'] = $request->program_diary_date;
            $diaryData['empTotalHrs'] = $request->empTotalHrs;
            $diaryData['bins_removed'] = $request->bins_removed;
            $diaryData['bins_delivered'] = $request->bins_delivered;
            $diaryData['bins_description'] = $request->bins_description;

        if($diaryData->save()){
            $empNameArray = $request->empName;
            $empTypeArray = $request->empType;
            $empHoursArray = $request->empHours;
            for ($i = 0; $i < count($empNameArray); $i++) {
                $empNameval = $empNameArray[$i];
                $empTypeval = $empTypeArray[$i];
                $empHoursval = $empHoursArray[$i];
                $diaryEmployeData = new DiaryEmploye();
                $diaryEmployeData['diary_id'] = $diaryData->id;
                $diaryEmployeData['empName'] = $empNameval;
                $diaryEmployeData['empType'] = $empTypeval;
                $diaryEmployeData['empHours'] = $empHoursval;
                $diaryEmployeData->save();
            }

            $images = $request->file('images');
            if ($images) {
                $targetDirectory = public_path('/images/diaryImage/');
                foreach ((array) $images as $file) {
                    $stored = store_uploaded_file_safe($file, $targetDirectory, '/public/images/diaryImage');
                    if ($stored) {
                        $diaryImageData = new DiaryImage();
                        $diaryImageData['diary_id'] = $diaryData->id;
                        $diaryImageData['images'] = $stored['public'];
                        $diaryImageData->save();
                    }
                }
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
       
       $diaryRecord = Diary::where(['id' => $id])->first();

       if (empty($diaryRecord)) {
        return redirect()->back()->with('error', 'Something Worng');
    } else {
        $diaryRecord['comments'] = $request->comments;
        $diaryRecord['empTotalHrs'] = $request->empTotalHrs;
        $diaryRecord['bins_removed'] = $request->bins_removed;
        $diaryRecord['bins_delivered'] = $request->bins_delivered;
        $diaryRecord['bins_description'] = $request->bins_description;
        if ($diaryRecord->save()) {


            $taskArrayId = $request->taskId;
            for ($i = 0; $i < count($taskArrayId); $i++) {
                $taskStatus = "task_status".$taskArrayId[$i];
                $programTaskRec = ProgramTask::where(['id' => $taskArrayId[$i]])->first();
                if ($programTaskRec) {
                    $programTaskRec = ProgramTask::find($taskArrayId[$i]);
                    $programTaskRec->task_status = $request->$taskStatus;
                    $programTaskRec->save();
                } 
            }
            
           
            //existing record updationn
            $existEmpIdArray = $request->existEmpId;
            $existEmpNameArray = $request->existEmpName;
            $existEmpTypeArray = $request->existEmpType;
            $existEmpHoursArray = $request->existEmpHours;
            for ($i = 0; $i < count($existEmpIdArray); $i++) {
                $existEmpIdVal = $existEmpIdArray[$i];
                $existEmpNameval = $existEmpNameArray[$i];
                $existEmpTypeval = $existEmpTypeArray[$i];
                $existEmpHoursval = $existEmpHoursArray[$i];
                $diaryEmployeData = DiaryEmploye::where(['id' => $existEmpIdVal])->first();
                $diaryEmployeData['empName'] = $existEmpNameval;
                $diaryEmployeData['empType'] = $existEmpTypeval;
                $diaryEmployeData['empHours'] = $existEmpHoursval;
                $diaryEmployeData->save();
            }


            // if new record 
            $empNameArray = $request->empName;
            $empTypeArray = $request->empType;
            $empHoursArray = $request->empHours;
           
                for ($i = 0; $i <  count($empNameArray); $i++) {

                    if (!empty($empNameArray[$i])) {
                        $empNameval = $empNameArray[$i];
                        $empTypeval = $empTypeArray[$i];
                        $empHoursval = $empHoursArray[$i];
                        $diaryEmployeData = new DiaryEmploye();
                        $diaryEmployeData['diary_id'] = $id;
                        $diaryEmployeData['empName'] = $empNameval;
                        $diaryEmployeData['empType'] = $empTypeval;
                        $diaryEmployeData['empHours'] = $empHoursval;
                        $diaryEmployeData->save();
                    }
                }
           

            $images = $request->file('images');
            if ($images) {
                $targetDirectory = public_path('/images/diaryImage/');
                foreach ((array) $images as $file) {
                    $stored = store_uploaded_file_safe($file, $targetDirectory, '/public/images/diaryImage');
                    if ($stored) {
                        $diaryImageData = new DiaryImage();
                        $diaryImageData['diary_id'] = $diaryRecord->id;
                        $diaryImageData['images'] = $stored['public'];
                        $diaryImageData->save();
                    }
                }
            }
            return redirect()->back()->with('success','Successfully Updated');
        } else {
            return redirect()->back()->with('error','Something went wrong. Please Try Again.');
        }
    
    }

    }


    public function destroyImage($id){
    $diaryImg = DiaryImage::find($id);
    if (!$diaryImg) {
        return response()->json(['message' => 'Resource not found'], 404);
    }
    $diaryImg->delete();
    return response()->json(['message' => 'Resource deleted'], 200);
    }


    public function destroyEmp($id){
        $diaryEmploye = DiaryEmploye::find($id);
        if (!$diaryEmploye) {
            return response()->json(['message' => 'Record not found'], 404);
        }
        $diaryEmploye->delete();
        return response()->json(['message' => 'Record deleted'], 200);
        }
    


    public function fetch_diary_program(Request $request){

        if($request->get('project')){

        $projects = Projects::orderBy('id','DESC')->get();
        $projectReq = $request->get('project');
        $program_date = $request->get('program_date');
        $programData = Programs::where('project_id',$projectReq)->whereDate('program_date', $program_date)->first();
        $programTaskData = '';
        $diaryData = Diary::where('project_id',$projectReq)->whereDate('program_diary_date', $program_date)->first();

        if(!empty($programData)){
            $programTaskData = ProgramTask::where('program_id',$programData->id)->get();
        }
        $diaryImageRec = array();
        $diaryEmployeRec = array();
        if(!empty($diaryData)){
            $diaryImageRec = DiaryImage::where('diary_id',$diaryData->id)->get();
            $diaryEmployeRec = DiaryEmploye::where('diary_id',$diaryData->id)->get();
        }
        return view('superadmin.diary.index', compact('programData','programTaskData','projects','diaryData','diaryImageRec','diaryEmployeRec'))->render();
    }else{
        return redirect()->route('diaries.index')->with('error','Something went wrong. Please Try Again.');    }
    }



    
}
