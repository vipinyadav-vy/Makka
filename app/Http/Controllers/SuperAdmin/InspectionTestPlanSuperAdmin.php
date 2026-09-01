<?php
namespace App\Http\Controllers\SuperAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WebForm;
use App\Models\PreStartMeeting;
use App\Models\PreMeetingTopics;
use App\Models\PreMeetingCorrective;
use App\Models\PreMeetingAttendance;
use App\Models\InspectionTestPlan;
use App\Models\InspectionTrade;
use App\Models\InspectionRepresentative;
use App\Models\Projects;
use App\Http\Controllers\SuperAdmin\Mediakit;
use Illuminate\Support\Facades\Mail;
use App\Mail\SiteInductionRecordMail;

use Hash;
use DB;
use Auth;
use Validator;
use PDF;
class InspectionTestPlanSuperAdmin extends Controller
{
    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $from_date = $request->get('from_date');
        $to_date = date('Y-m-d', strtotime($request->get('to_date') . ' + 1 days'));
        $queryPreMeeting = InspectionTestPlan::query();
        $queryPreMeeting->select('inspectiontestplans.*', 'projects.name as projectname', 'projects.id as projectId')
            ->join('projects', 'projects.id', '=', 'inspectiontestplans.project')
            ->orderBy('inspectiontestplans.id', 'DESC')
            ->when(!empty($from_date) && !empty($to_date), function ($query) use ($from_date, $to_date) {
                $query->whereBetween('inspectiontestplans.revision_date', [$from_date, $to_date]);
            });
        $inscpectionRecords = $queryPreMeeting->paginate(10)->withQueryString();
        return view('superadmin.inspectionTestPlan.index', compact('inscpectionRecords'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $projects = Projects::where(['status' => 1])->orderBy('id','DESC')->get();
        return view('superadmin.inspectionTestPlan.create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $formData = WebForm::find(9);
        if(!$formData){
            return redirect()->back()->with('error', 'Somthing went wrong.');
        }
        $validate = Validator::make($request->all(), [
            'project' => 'required',
            'itp_refrence_no' => 'required',
            'revision_no' => 'required',
            'revision_date' => 'required',
            'work_scope' => 'required',
            'work_area' => 'required',
            'level' => 'required',
            'item_no' => 'required',
            'quality_standard' => 'required',
            'stage' => 'required',
            'method' => 'required',
            'completed_date' => 'required',
            'record' => 'required',
            'subcontractor_sign_off' => 'required',
            'pc_sign_off' => 'required',
            'discussion' => 'required',
        ], [
            'project.required' => 'Project is Required',
            'itp_refrence_no.required' => 'ITP Refrence No is Required',
            'revision_no.required' => 'Revision No is Required',
            'revision_date.required' => 'Revision Date is Required',
            'work_scope.required' => 'Work Scope is Required',
            'work_area.required' => 'Work Area is Required',
            'level.required' => 'Level is Required',
            'item_no.required' => 'Item No is Required',
            'quality_standard.required' => 'Quality Standard is Required',
            'stage.required' => 'Stage is Required',
            'method.required' => 'Method is Required',
            'completed_date.required' => 'Completed Date is Required',
            'record.required' => 'Record is Required',
            'subcontractor_sign_off.required' => 'Subcontractor Sign Off is Required',
            'pc_sign_off.required' => 'Pc Sign Off is Required',
            'discussion.required' => 'Discussion is Required',
            
        ]);
        if ($validate->fails()) {
            return back()->withErrors($validate->errors())->withInput();
        }
        
            $inspectionData = new InspectionTestPlan();
            $inspectionData['webFormId'] = 9;
            $inspectionData['project'] = $request->project;
            $inspectionData['itp_refrence_no'] = $request->itp_refrence_no;
            $inspectionData['revision_no'] = $request->revision_no;
            $inspectionData['revision_date'] = $request->revision_date;
            $inspectionData['work_scope']  = $request->work_scope;
            $inspectionData['work_area']  = $request->work_area;
            $inspectionData['level']  = $request->level;
            $inspectionData['item_no']  = $request->item_no;
            $inspectionData['quality_standard']  = $request->quality_standard;
            $inspectionData['stage']  = $request->stage;
            $inspectionData['method']  = $request->method;
            $inspectionData['completed_date']  = $request->completed_date;
            $inspectionData['record']  = $request->record;
            $inspectionData['subcontractor_sign_off']  = $request->subcontractor_sign_off;
            $inspectionData['pc_sign_off']  = $request->pc_sign_off;
            $inspectionData['discussion']  = $request->discussion;
            
        if($inspectionData->save()){ 
            $subcontractorNameArray = $request->subcontractor_name;
            $representativeArray = $request->representative;
            $tradePhoneArray = $request->trade_phone;
            for ($i = 0; $i < count($subcontractorNameArray); $i++) {
                $subcontractorNameVal = $subcontractorNameArray[$i];
                $representativeval = $representativeArray[$i];
                $tradePhoneval = $tradePhoneArray[$i]; 
                $inspectionTradeData = new InspectionTrade();
                $inspectionTradeData['inspection_id'] = $inspectionData->id;
                $inspectionTradeData['subcontractor_name'] = $subcontractorNameVal;
                $inspectionTradeData['representative'] = $representativeval;
                $inspectionTradeData['trade_phone'] = $tradePhoneval;
                $inspectionTradeData->save();
            }
            
           
        
        $queryInspection = InspectionTestPlan::query();
        $queryInspection->select('inspectiontestplans.*', 'projects.name as projectname', 'projects.id as projectId')
            ->join('projects', 'projects.id', '=', 'inspectiontestplans.project')
            ->where('inspectiontestplans.id',$inspectionData->id);
        $inspectionrecord = $queryInspection->first();
        $inspectionTrade = InspectionTrade::where('inspection_id',$inspectionData->id)->get();
        $inspectionRepresentative = InspectionRepresentative::where('inspection_id',$inspectionData->id)->get();
        $pdf = PDF::loadView('superadmin.webforms.inspection_test_recordsPdf',compact('inspectionrecord', 'inspectionTrade','inspectionRepresentative'));
            
            // Define the path where you want to save the PDF
            $savePath = public_path('webformInvoice'); // Change 'pdfs' to your desired folder name
            // Make sure the folder exists, create it if not
            if (!file_exists($savePath)) {
                mkdir($savePath, 0755, true);
            }
            // Save the PDF to the specified path
            $attachmentPath = $savePath . '/' . 'inspection_test_record_' . $inspectionData->id . '.pdf';
            $pdf->save($attachmentPath);
            $ccmail = $formData->ccMail;
            Mail::to($formData->toMail)->send(new SiteInductionRecordMail($inspectionrecord, $attachmentPath, $ccmail));
            unlink($attachmentPath); // Delete the file
            
            return redirect()->route('inspectionTestPlan.index')->with('success','Successfully Created');
        } else {
            return redirect()->back()->with('failed','Something went wrong. Please Try Again.');
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
        
        $queryInspection = InspectionTestPlan::query();
        $queryInspection->select('inspectiontestplans.*', 'projects.name as projectname', 'projects.id as projectId')
            ->join('projects', 'projects.id', '=', 'inspectiontestplans.project')
            ->where('inspectiontestplans.id',$id);
        $inspectionrecord = $queryInspection->first();
        $inspectionTrade = InspectionTrade::where('inspection_id',$id)->get();
        $inspectionRepresentative = InspectionRepresentative::where('inspection_id',$id)->get();
        $pdf = PDF::loadView('superadmin.inspectionTestPlan.show',compact('inspectionrecord', 'inspectionTrade','inspectionRepresentative'));
        return $pdf->stream('inspection_test_plan.pdf');
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
       
       //

    }

    
}
