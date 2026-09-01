<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Projects;
use App\Models\Programs;
use App\Models\ProgramTask;
use App\Models\Diary;
use App\Models\DiaryEmploye;
use App\Models\DiaryImage;

class AdminDiariesController extends Controller
{
    public function index(Request $request)
    {
        $user_id = auth()->user()->id;
        $projects = Projects::select('projects.*')
            ->join('user_projects', 'projects.id', '=', 'user_projects.project_id')
            ->where('user_projects.user_id', $user_id)
            ->where('user_projects.diary_access', 1)
            ->where('status', 1)
            ->orderBy('projects.id', 'DESC')
            ->get();

        return view('admin.diary.index', compact('projects'));
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

        return view('admin.toolboxTalkRecord.create', compact('projects'));
    }

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

        if ($diaryData->save()) {
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
                // $targetDirectory = '/images/diaryImage/'; // path location
                $targetDirectory = public_path('/images/diaryImage/'); // path location
                foreach ($_FILES['images']['name'] as $key => $name) {

                    $uniqid = uniqid();
                    $targetFile = $targetDirectory . $uniqid . basename($_FILES['images']['name'][$key]);

                    $imageName = "/public/images/diaryImage/" . $uniqid . basename($_FILES['images']['name'][$key]);

                    // Check if the file is an actual image or a fake image
                    if (getimagesize($_FILES['images']['tmp_name'][$key]) !== false) {
                        if (move_uploaded_file($_FILES['images']['tmp_name'][$key], $targetFile)) {

                            $diaryImageData = new DiaryImage();
                            $diaryImageData['diary_id'] = $diaryData->id;
                            $diaryImageData['images'] = $imageName;
                            $diaryImageData->save();
                        } else {
                            echo "Sorry, there was an error uploading $name.<br>";
                        }
                    } else {
                        echo "Invalid file: $name is not an image.<br>";
                    }
                }
            }
            return redirect()->back()->with('success', 'Successfully Created');
        } else {
            return redirect()->back()->with('error', 'Something went wrong. Please Try Again.');
        }
    }

    public function update(Request $request, $id)
    {
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
                    // $targetDirectory = '/images/diaryImage/'; // path location
                    $targetDirectory = public_path('/images/diaryImage/'); // path location
                    foreach ($_FILES['images']['name'] as $key => $name) {

                        $uniqid = uniqid();
                        $targetFile = $targetDirectory . $uniqid . basename($_FILES['images']['name'][$key]);

                        $imageName = "/public/images/diaryImage/" . $uniqid . basename($_FILES['images']['name'][$key]);

                        // Check if the file is an actual image or a fake image
                        if (getimagesize($_FILES['images']['tmp_name'][$key]) !== false) {
                            if (move_uploaded_file($_FILES['images']['tmp_name'][$key], $targetFile)) {
                                $diaryImageData = new DiaryImage();
                                $diaryImageData['diary_id'] = $diaryRecord->id;
                                $diaryImageData['images'] = $imageName;
                                $diaryImageData->save();
                            } else {
                                echo "Sorry, there was an error uploading $name.<br>";
                            }
                        } else {
                            echo "Invalid file: $name is not an image.<br>";
                        }
                    }
                }
                return redirect()->back()->with('success', 'Successfully Updated');
            } else {
                return redirect()->back()->with('error', 'Something went wrong. Please Try Again.');
            }
        }
    }

    public function destroyImage($id)
    {
        $diaryImg = DiaryImage::find($id);
        if (!$diaryImg) {
            return response()->json(['message' => 'Resource not found'], 404);
        }
        $diaryImg->delete();
        return response()->json(['message' => 'Resource deleted'], 200);
    }

    public function destroyEmp($id)
    {
        $diaryEmploye = DiaryEmploye::find($id);
        if (!$diaryEmploye) {
            return response()->json(['message' => 'Record not found'], 404);
        }
        $diaryEmploye->delete();
        return response()->json(['message' => 'Record deleted'], 200);
    }

    public function fetch_diary_program(Request $request)
    {
        if ($request->get('project')) {

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
            $programTaskData = '';
            $diaryData = Diary::where('project_id', $projectReq)->whereDate('program_diary_date', $program_date)->first();

            if (!empty($programData)) {
                $programTaskData = ProgramTask::where('program_id', $programData->id)->get();
            }
            $diaryImageRec = array();
            $diaryEmployeRec = array();
            if (!empty($diaryData)) {
                $diaryImageRec = DiaryImage::where('diary_id', $diaryData->id)->get();
                $diaryEmployeRec = DiaryEmploye::where('diary_id', $diaryData->id)->get();
            }
            return view('admin.diary.index', compact('programData', 'programTaskData', 'projects', 'diaryData', 'diaryImageRec', 'diaryEmployeRec'))->render();
        } else {
            return redirect()->route('user_diaries.index')->with('error', 'Something went wrong. Please Try Again.');
        }
    }
}
