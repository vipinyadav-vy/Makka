<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\WebForm;
use App\Models\Programs;
use App\Models\ProgramTask;
use App\Models\Diary;
use App\Models\DiaryEmploye;
use App\Models\DiaryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Validator;

class ProgramController extends BaseController {
        public function __construct() {
            //
        }
        
        public function addProgram(Request $request) {
            $validator = Validator:: make($request -> all(), [
                'project' => 'required',
                'program_date' => 'required',
                'note' => 'required',
                'task' => 'required',
            ]);
            if ($validator->fails()) {
              return $this->sendFailed($validator -> errors() -> first());
            }
            $programRecord = Programs::where('project_id', $request->project)->whereDate('program_date', $request->program_date)->first();
            if($programRecord){
                return $this -> sendFailed('Already Created program with this date.');
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
                return $this->sendSuccess('Created Successfully');
            } else {
                  return $this -> sendFailed('Something Went wrong. Please Try again.');
            }
        }

        public function programDetails(Request $request) {
            $validator = Validator:: make($request -> all(), [
                'project' => 'required',
                'program_date' => 'required',
            ]);
            if ($validator->fails()) {
              return $this->sendFailed($validator -> errors() -> first());
            }
            $projectReq = $request->project;
            $program_date = $request->program_date;
            // Run the query to get program with tasks
            $programWithTasks = DB::table('programs')
                ->leftJoin('program_task', 'programs.id', '=', 'program_task.program_id')
                ->where('programs.project_id', $projectReq)
                ->whereDate('programs.program_date', $program_date)
                ->select(
                    'programs.*',
                    'program_task.id as task_id',
                    'program_task.task',
                    'program_task.task_status'
                )
                ->get();
                // If no records found, return 404
                if ($programWithTasks->isEmpty()) {
                    return $this -> sendFailed('No program found for this project on this date.');
                }
                // Initialize response structure
                $programData = [
                    'id' => $programWithTasks->first()->id,
                    'project_id' => $programWithTasks->first()->project_id,
                    'program_date' => $programWithTasks->first()->program_date,
                    'note' => $programWithTasks->first()->note,
                    'tasks' => []
                ];
                // Collect tasks into the 'tasks' array
                foreach ($programWithTasks as $row) {
                    if ($row->task_id) {
                        $programData['tasks'][] = [
                            'id' => $row->task_id,
                            'task' => $row->task,
                            'task_status' => $row->task_status
                        ];
                    }
                }
                if($programData){
                    return $this->sendSuccess('Programs List',$programData);
                } else {
                  return $this -> sendFailed('Something Went wrong. Please Try again.');
                }
            }
            
            
            
        public function programUpdate(Request $request) {
            
            // print_r($request->all());
            // exit;
            $validator = Validator:: make($request -> all(), [
            'id' => 'required',
            'note' => 'required',
            'task' => 'required',
        ]);
        if ($validator->fails()) {
          return $this->sendFailed($validator -> errors() -> first());
        }
        $programRecord = Programs::where(['id' => $request->id])->first();
        if (empty($programRecord)) {
            return $this->sendFailed('Something went worng. Please try again');
        }
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
                            $programTaskData['program_id'] = $request->id;
                            $programTaskData['task'] = $taskArray[$i];
                            $programTaskData->save();
                            }
                        }
                    }
                    return $this->sendSuccess('Updated Successfully');
                    }else{
                    return $this->sendFailed('Something went worng. Please try again');
                    }

            
        }
            
            
            
        public function addDiary(Request $request) {
            
            
            // $validator = Validator:: make($request -> all(), [
            //     'project' => 'required',
            //     'program_date' => 'required',
            //     'note' => 'required',
            //     'task' => 'required',
            // ]);
            // if ($validator->fails()) {
            //   return $this->sendFailed($validator -> errors() -> first());
            // }
            
                        $diaryRecord = Diary::where('project_id', $request->project)->whereDate('program_diary_date', $request->program_diary_date)->first();

        if($diaryRecord){
                return $this -> sendFailed('Already Created Diary with this date.');
            }
        $diaryData = new Diary();
            $diaryData['project_id'] = $request->project_id;
            //$diaryData['program_id'] = $request->program_id;
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
            
            if($request->images){
            $img = $request->images;
            $folderPath = public_path('/images/diaryImage'); // path location
            $image_parts = explode(";base64,", $img);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $uniqid = uniqid();
            $file = $folderPath . '/' . $uniqid . '.' . $image_type;
            $imageName = '/public/images/diaryImage/'. $uniqid .'.'.$image_type;
            file_put_contents($file, $image_base64);
            
             $diaryImageData = new DiaryImage();
                            $diaryImageData['diary_id'] = $diaryData->id;
                            $diaryImageData['images'] = $imageName;
                            $diaryImageData->save();
            
            }
            return $this->sendSuccess('Created Successfully');

        } else {
            return $this->sendFailed('Something went worng. Please try again');

        }
        }

        public function diaryDetails(Request $request) {
    $validator = Validator::make($request->all(), [
        'project' => 'required|integer',
        'program_diary_date' => 'required|date',
    ]);

    if ($validator->fails()) {
        return $this->sendFailed($validator->errors()->first());
    }

    $projectReq = $request->project;
    $program_diary_date = $request->program_diary_date;

    // Run the query to get diary with employees
    $diariesWithEmp = DB::table('diaries')
        ->leftJoin('diary_employes', 'diaries.id', '=', 'diary_employes.diary_id')
        ->leftJoin('diary_images', 'diaries.id', '=', 'diary_images.diary_id')
        ->where('diaries.project_id', $projectReq)
        ->whereDate('diaries.program_diary_date', $program_diary_date)
        ->select(
            'diaries.*',
            'diary_images.images',
            'diary_employes.id as emp_id',
            'diary_employes.empName',
            'diary_employes.empType',
            'diary_employes.empHours'
        )
        ->get();

    if ($diariesWithEmp->isEmpty()) {
        return $this->sendFailed('No Diary found for this project on this date.');
    }

    // Initialize response structure from the first record
    $firstDiary = $diariesWithEmp->first();

    $diaryData = [
        'id' => $firstDiary->id,
        'project_id' => $firstDiary->project_id,
        'program_diary_date' => $firstDiary->program_diary_date,
        'empTotalHrs' => $firstDiary->empTotalHrs,
        'bins_removed' => $firstDiary->bins_removed,
        'bins_delivered' => $firstDiary->bins_delivered,
        'bins_description' => $firstDiary->bins_description,
        'comments' => $firstDiary->comments,
        'images' => $firstDiary->images,
        'employes' => []
    ];

    // Collect employees into the 'employes' array
    foreach ($diariesWithEmp as $row) {
        if ($row->emp_id) {
            $diaryData['employes'][] = [
                'id' => $row->emp_id,
                'empName' => $row->empName,
                'empType' => $row->empType,
                'empHours' => $row->empHours,
            ];
        }
    }

    return $this->sendSuccess('Diary List', $diaryData);
}

            
            
        public function diaryUpdate(Request $request) {
            
            $validator = Validator:: make($request -> all(), [
            'id' => 'required'
        ]);
        if ($validator->fails()) {
          return $this->sendFailed($validator -> errors() -> first());
        }

        $diaryRecord = Diary::where(['id' => $request->id])->first();
        if (empty($diaryRecord)) {
            return $this->sendFailed('Something went worng. Please try again');
        }
        $diaryRecord['comments'] = $request->comments;
        $diaryRecord['empTotalHrs'] = $request->empTotalHrs;
        $diaryRecord['bins_removed'] = $request->bins_removed;
        $diaryRecord['bins_delivered'] = $request->bins_delivered;
        $diaryRecord['bins_description'] = $request->bins_description;
                    if ($diaryRecord->save()) {
                    
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
                                $diaryEmployeData['diary_id'] = $diaryRecord->id;
                                $diaryEmployeData['empName'] = $empNameval;
                                $diaryEmployeData['empType'] = $empTypeval;
                                $diaryEmployeData['empHours'] = $empHoursval;
                                $diaryEmployeData->save();
                            }
                        }
                        
                    if($request->images){
                        $img = $request->images;
                        $folderPath = public_path('/images/diaryImage'); // path location
                        $image_parts = explode(";base64,", $img);
                        $image_type_aux = explode("image/", $image_parts[0]);
                        $image_type = $image_type_aux[1];
                        $image_base64 = base64_decode($image_parts[1]);
                        $uniqid = uniqid();
                        $file = $folderPath . '/' . $uniqid . '.' . $image_type;
                        $imageName = '/public/images/diaryImage/'. $uniqid .'.'.$image_type;
                        file_put_contents($file, $image_base64);
                        
                         $diaryImageData = new DiaryImage();
                                        $diaryImageData['diary_id'] = $diaryRecord->id;
                                        $diaryImageData['images'] = $imageName;
                                        $diaryImageData->save();
                        
                        }
                    return $this->sendSuccess('Updated Successfully');
                    }else{
                    return $this->sendFailed('Something went worng. Please try again');
                    }

            
        }
            
            
            
        }




