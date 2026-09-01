<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WebForm;
use App\Models\SiteSafetyInspection;
use App\Models\SiteInductionRecord;
use App\Models\ToolBoxTalkRecords;
use App\Models\PreStartMeeting;
use App\Models\PreMeetingTopics;
use App\Models\PreMeetingCorrective;
use App\Models\PreMeetingAttendance;
use App\Models\ToolBoxTalkAction;
use App\Models\ToolBoxTalkAttendance;
use App\Models\UserWebform;
use App\Models\InspectionTestPlan;
use App\Models\InspectionTrade;
use App\Models\InspectionRepresentative;
use App\Models\PreStartChecklist;
use App\Models\SupplierContractorCar;
use App\Models\SupplierContractorCarProblem;
use App\Models\SupplierContractorCarCorrective;
use App\Models\SupplierContractorEvalution;
use Illuminate\Support\Facades\Mail;
use App\Mail\SiteInductionRecordMail;
use Hash;
use DB;
use Auth;
use Validator;
use PDF;
class WebFormController extends Controller
{
    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {    
       //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
       // 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
       //
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
     
    public function update(Request $request,$id)
    {
        //
    }


    public function webformReport(Request $request)
    {
        $user = Auth::user();

        $userProject = UserWebform::join('projects', 'user_webforms.project_id', '=', 'projects.id')
        ->select('user_webforms.project_id','projects.*') 
        ->distinct()
        ->where('user_webforms.user_id', $user->id)
        ->get();

        $userWebforms = array();

        if(!empty($request->pId)){

            $userWebforms = UserWebform::join('webforms', 'user_webforms.webform_id', '=', 'webforms.id')
            ->select('user_webforms.webform_id','webforms.*') 
            ->distinct()
            ->where('user_webforms.user_id', $user->id)
            ->where('user_webforms.project_id', $request->pId) 
            ->where('user_webforms.form_view', 1) 
            ->get();
        }

        return view('admin.webform.webformreport', compact('userProject','userWebforms'));
        
    }


    public function webform(Request $request,$slug = null)
    {
        if(empty($request->get('pId'))){
            return redirect('admin/webformReport')->with('failed', 'Something went wrong. Please try again');
        }
        if(empty($slug)){
            return redirect('admin/webformReport')->with('failed', 'Something went wrong. Please try again');
        } else {
            
            $from_date = $request->get('from_date');
            $to_date = date('Y-m-d', strtotime($request->get('to_date')));
            if($slug == 'site-induction-record'){
                $querySiteInduction = SiteInductionRecord::query();
                $querySiteInduction->select('site_induction_record.*', 'projects.name as projectname', 'projects.id as projectId')
                    ->join('projects', 'projects.id', '=', 'site_induction_record.project')
                    ->orderBy('site_induction_record.id', 'DESC')
                    ->when(!empty($from_date) && !empty($to_date), function ($query) use ($from_date, $to_date) {
                        $query->whereBetween('site_induction_record.applyDate', [$from_date, $to_date]);
                    })->where('site_induction_record.project',$request->get('pId'));
                $data = $querySiteInduction->paginate(10)->withQueryString();
                
                return view('admin.webform.'.$slug, compact('data'));
            }
            
            if($slug == 'site-safety-inspection'){
                $querySiteSafety = SiteSafetyInspection::query();
                $querySiteSafety->select('site_safety_inspection.*', 'projects.name as projectname', 'projects.id as projectId')
                    ->join('projects', 'projects.id', '=', 'site_safety_inspection.project_reference')
                    ->orderBy('site_safety_inspection.id', 'DESC')
                    ->when(!empty($from_date) && !empty($to_date), function ($query) use ($from_date, $to_date) {
                        $query->whereBetween('site_safety_inspection.date', [$from_date, $to_date]);
                    })->where('site_safety_inspection.project_reference',$request->get('pId'));
                $data = $querySiteSafety->paginate(10)->withQueryString();
                return view('admin.webform.'.$slug, compact('data'));
            }
            
            if($slug == 'toolbox-talk-record'){
                
                $querytooltalkRecords = ToolBoxTalkRecords::query();
                $querytooltalkRecords->select('tool_box_talk_records.*', 'projects.name as projectname', 'projects.id as projectId')
                    ->join('projects', 'projects.id', '=', 'tool_box_talk_records.project')
                    ->orderBy('tool_box_talk_records.id', 'DESC')
                    ->when(!empty($from_date) && !empty($to_date), function ($query) use ($from_date, $to_date) {
                        $query->whereBetween('tool_box_talk_records.tollbox_talk_record_date', [$from_date, $to_date]);
                    })->where('tool_box_talk_records.project',$request->get('pId'));
                $data = $querytooltalkRecords->paginate(10)->withQueryString();
                
                return view('admin.webform.'.$slug, compact('data'));
            }
            
            if($slug == 'pre-start-meeting-record'){
                
                
                $queryPreMeeting = PreStartMeeting::query();
                $queryPreMeeting->select('pre_start_meetings.*', 'projects.name as projectname', 'projects.id as projectId')
                    ->join('projects', 'projects.id', '=', 'pre_start_meetings.project')
                    ->orderBy('pre_start_meetings.id', 'DESC')
                    ->when(!empty($from_date) && !empty($to_date), function ($query) use ($from_date, $to_date) {
                        $query->whereBetween('pre_start_meetings.pre_meeting_date', [$from_date, $to_date]);
                    })->where('pre_start_meetings.project',$request->get('pId'));
                $data = $queryPreMeeting->paginate(10)->withQueryString();
               
                
                return view('admin.webform.'.$slug, compact('data'));
            }
            
            /* Changes Added by Vinod */

            if($slug == 'inspection-and-test-plan'){

                $querySiteInduction = InspectionTestPlan::query();
                $querySiteInduction->select('inspectiontestplans.*', 'projects.name as projectname', 'projects.id as projectId')
                    ->join('projects', 'projects.id', '=', 'inspectiontestplans.project')
                    ->orderBy('inspectiontestplans.id', 'DESC')
                    ->when(!empty($from_date) && !empty($to_date), function ($query) use ($from_date, $to_date) {
                        $query->whereBetween('inspectiontestplans.revision_date', [$from_date, $to_date]);
                    })->where('inspectiontestplans.project',$request->get('pId'));
                $data = $querySiteInduction->paginate(10)->withQueryString();

                return view('admin.webform.'.$slug, compact('data'));
            }

            if($slug == 'supplier-contractor-evalution'){

                $querySiteInduction = SupplierContractorEvalution::query();
                $querySiteInduction->select('supplier_contractor_evalution.*')
                    ->orderBy('supplier_contractor_evalution.id', 'DESC')
                    ->when(!empty($from_date) && !empty($to_date), function ($query) use ($from_date, $to_date) {
                        $query->whereBetween('supplier_contractor_evalution.supplier_date', [$from_date, $to_date]);
                    });
                $data = $querySiteInduction->paginate(10)->withQueryString();

                return view('admin.webform.'.$slug, compact('data'));
            }

            if($slug == 'supplier-contractor-car'){

                $querySiteInduction = SupplierContractorCar::query();
                $querySiteInduction->select('supplier_contractor_car.*', 'projects.name as projectname', 'projects.id as projectId')
                    ->join('projects', 'projects.id', '=', 'supplier_contractor_car.project')
                    ->orderBy('supplier_contractor_car.id', 'DESC')
                    ->when(!empty($from_date) && !empty($to_date), function ($query) use ($from_date, $to_date) {
                        $query->whereBetween('supplier_contractor_car.applyDate', [$from_date, $to_date]);
                    })->where('supplier_contractor_car.project',$request->get('pId'));
                $data = $querySiteInduction->paginate(10)->withQueryString();

                return view('admin.webform.'.$slug, compact('data'));
            }

            if($slug == 'contractor-pre-start-checklist'){
                
                $queryPreCheckList = PreStartChecklist::query();
                $queryPreCheckList->select('pre_start_checklist.*')
                    ->orderBy('pre_start_checklist.id', 'DESC')
                    ->when(!empty($from_date) && !empty($to_date), function ($query) use ($from_date, $to_date) {
                        $query->whereBetween('pre_start_checklist.manager_date', [$from_date, $to_date]);
                    });
                $data = $queryPreCheckList->paginate(10)->withQueryString();
                return view('admin.webform.'.$slug, compact('data'));
            }

            /* Changes End by Vinod */
        }
    }
    
    function siteInductionPdf(Request $request, $id)
    {
        $querySiteInduction = SiteInductionRecord::query();
                $querySiteInduction->select('site_induction_record.*', 'projects.name as projectname', 'projects.id as projectId')
                    ->join('projects', 'projects.id', '=', 'site_induction_record.project')
                    ->where('site_induction_record.id',$id);
                $data = $querySiteInduction->first();
        
        if(!$data){
            return redirect()->back()->with('error', 'Somthing went wrong.');
        }
       $pdf = PDF::loadView('admin.webform.siteInductionRecordPdf',compact('data'));
        return $pdf->stream('site_induction_record.pdf');
    }
    
    function siteInductionResendMail(Request $request)
    {
        $id = $request->siteInductionReportId;
            $querySiteInduction = SiteInductionRecord::query();
                $querySiteInduction->select('site_induction_record.*', 'projects.name as projectname', 'projects.id as projectId')
                    ->join('projects', 'projects.id', '=', 'site_induction_record.project')
                    ->where('site_induction_record.id',$id);
                $data = $querySiteInduction->first();
        if(!$data){
            return redirect()->back()->with('error', 'Somthing went wrong.');
        }

        $formData = WebForm::find($request->formId);
        if(!$formData){
            return redirect()->back()->with('error', 'Somthing went wrong.');
        }
        // Load the PDF view
        $pdf = PDF::loadView('superadmin.webforms.siteInductionRecordPdf', compact('data'));
        // Define the path where you want to save the PDF
        $savePath = public_path('webformInvoice'); // Change 'pdfs' to your desired folder name
        // Make sure the folder exists, create it if not
        if (!file_exists($savePath)) {
            mkdir($savePath, 0755, true);
        }
        // Save the PDF to the specified path
        $attachmentPath = $savePath . '/' . 'site_induction_record_' . $id . '.pdf';
        $pdf->save($attachmentPath);

        $ccmail = $formData->ccMail;
        Mail::to($formData->toMail)->send(new SiteInductionRecordMail($data, $attachmentPath, $ccmail));
        unlink($attachmentPath); // Delete the file
        return redirect()->back()->with('success','Mail has been sent successfully.');
    }


    function siteSafeInspectionReportsPdf(Request $request, $id){

         $querySiteSafety = SiteSafetyInspection::query();
                $querySiteSafety->select('site_safety_inspection.*', 'projects.name as projectname', 'projects.id as projectId')
                    ->join('projects', 'projects.id', '=', 'site_safety_inspection.project_reference')
                    ->where('site_safety_inspection.id',$id);
                $data = $querySiteSafety->first();
        
        if(!$data){
            return redirect()->route('admin/dashboard')->with('error', 'Somthing went wrong.');
        }
        $pdf = PDF::loadView('admin.webform.siteSafetyInspectionPdf',compact('data'));
        return $pdf->stream('site_safe_inspection_record.pdf');
    }

        
    function siteSafeInspectionUserResendMail(Request $request)
    {
        $id = $request->siteSafeInspectionReportId;
        $querySiteSafety = SiteSafetyInspection::query();
                $querySiteSafety->select('site_safety_inspection.*', 'projects.name as projectname', 'projects.id as projectId')
                    ->join('projects', 'projects.id', '=', 'site_safety_inspection.project_reference')
                    ->where('site_safety_inspection.id',$id);
                $data = $querySiteSafety->first();
        if(!$data){
            return redirect()->back()->with('error', 'Somthing went wrong ghg.');
        }

        $formData = WebForm::find($request->formId);
        if(!$formData){
            return redirect()->back()->with('error', 'Somthing went wrong grrrr.');
        }
        $pdf = PDF::loadView('admin.webform.siteSafetyInspectionPdf', compact('data'));
        $savePath = public_path('webformInvoice'); // Change 'pdfs' to your desired folder name
        if (!file_exists($savePath)) {
            mkdir($savePath, 0755, true);
        }
        $attachmentPath = $savePath . '/' . 'site_safe_inspection_' . $id . '.pdf';
        $pdf->save($attachmentPath);

        $ccmail = $formData->ccMail;
        Mail::to($formData->toMail)->send(new SiteInductionRecordMail($data, $attachmentPath, $ccmail));
        unlink($attachmentPath); // Delete the file
        return redirect()->back()->with('success','Mail has been sent successfully.');
    }


    
    public function viewPreStartMeeting(Request $request, $id){

        $queryPreMeeting = PreStartMeeting::query();
        $queryPreMeeting->select('pre_start_meetings.*', 'projects.name as projectname', 'projects.id as projectId')
            ->join('projects', 'projects.id', '=', 'pre_start_meetings.project')
            ->where('pre_start_meetings.id',$id);
        $preMeetingrecord = $queryPreMeeting->first();
        
        
        $preMeetingTopics = PreMeetingTopics::where('pre_meeting_id',$id)->get();
        $preMeetingCorrective = PreMeetingCorrective::where('pre_meeting_id',$id)->get();
        $preMeetingAttendance = PreMeetingAttendance::where('pre_meeting_id',$id)->get();

        $pdf = PDF::loadView('admin.webform.pre-start-meetingPdf',compact('preMeetingrecord', 'preMeetingTopics', 'preMeetingCorrective', 'preMeetingAttendance'));
        return $pdf->stream('pre-start-meeting.pdf');
    }

    public function viewToolBoxTalkRecord(Request $request, $id){
        
         $querytooltalkRecords = ToolBoxTalkRecords::query();
                $querytooltalkRecords->select('tool_box_talk_records.*', 'projects.name as projectname', 'projects.id as projectId')
                    ->join('projects', 'projects.id', '=', 'tool_box_talk_records.project')
                    ->where('tool_box_talk_records.id',$id);
                $tollboxtalkrecord = $querytooltalkRecords->first();
        
        $tollboxtalkrecordAction = ToolBoxTalkAction::where('tool_box_talk_record_id',$id)->get();
        $tollboxtalkrecordAttendance = ToolBoxTalkAttendance::where('tool_box_talk_record_id',$id)->get();
        $pdf = PDF::loadView('admin.webform.toolbox-talk-recordPdf',compact('tollboxtalkrecord', 'tollboxtalkrecordAction', 'tollboxtalkrecordAttendance'));
        return $pdf->stream('toolbox_talk_record.pdf');
    }
    
    function siteInductionTestPlanPdf(Request $request, $id)
    {
        $queryInspection = InspectionTestPlan::query();
        $queryInspection->select('inspectiontestplans.*', 'projects.name as projectname', 'projects.id as projectId')
            ->join('projects', 'projects.id', '=', 'inspectiontestplans.project')
            ->where('inspectiontestplans.id',$id);
        $data = $queryInspection->first();
        $inspectionTrade = InspectionTrade::where('inspection_id',$id)->get();
        $inspectionRepresentative = InspectionRepresentative::where('inspection_id',$id)->get();
        if(!$data){
            return redirect()->back()->with('error', 'Somthing went wrong.');
        }
        $pdf = PDF::loadView('admin.webform.siteInductionTestPlanRecordPdf',compact('data', 'inspectionTrade','inspectionRepresentative'));
        return $pdf->stream('inspection_test_plan.pdf');
    }

    function siteInductionTestPlanResendMail(Request $request)
    {
        $id = $request->siteInductionReportId;
            $querySiteInduction = InspectionTestPlan::query();
                $querySiteInduction->select('inspectiontestplans.*', 'projects.name as projectname', 'projects.id as projectId')
                    ->join('projects', 'projects.id', '=', 'inspectiontestplans.project')
                    ->where('inspectiontestplans.id',$id);
                $data = $querySiteInduction->first();
        if(!$data){
            return redirect()->back()->with('error', 'Somthing went wrong.');
        }

        $formData = WebForm::find($request->formId);
        if(!$formData){
            return redirect()->back()->with('error', 'Somthing went wrong.');
        }
        // Load the PDF view
        $pdf = PDF::loadView('superadmin.webforms.siteInductionRecordPdf', compact('data'));
        // Define the path where you want to save the PDF
        $savePath = public_path('webformInvoice'); // Change 'pdfs' to your desired folder name
        // Make sure the folder exists, create it if not
        if (!file_exists($savePath)) {
            mkdir($savePath, 0755, true);
        }
        // Save the PDF to the specified path
        $attachmentPath = $savePath . '/' . 'inspectiontestplans_' . $id . '.pdf';
        $pdf->save($attachmentPath);

        $ccmail = $formData->ccMail;
        Mail::to($formData->toMail)->send(new SiteInductionRecordMail($data, $attachmentPath, $ccmail));
        unlink($attachmentPath); // Delete the file
        return redirect()->back()->with('success','Mail has been sent successfully.');
    }
    
    function supplierContractorEvalutionPdf(Request $request, $id)
    {
        $querySuperContrEval = SupplierContractorEvalution::query();
        $querySuperContrEval->select('supplier_contractor_evalution.*')
            ->orderBy('supplier_contractor_evalution.id', 'DESC')
            ->where('supplier_contractor_evalution.id',$id);
        $data = $querySuperContrEval->first();
        if(!$data){
            return redirect()->back()->with('error', 'Somthing went wrong.');
        }
        $pdf = PDF::loadView('admin.webform.supplierContractorEvalutionRecordPdf',compact('data'));
        return $pdf->stream('supplier_contractor_evalution.pdf');
    }
    
    function supplierContractorCarPdf(Request $request, $id)
    {
        
          $querySupContCar = SupplierContractorCar::query();
        $querySupContCar->select('supplier_contractor_car.*', 'projects.name as projectname', 'projects.id as projectId')
            ->join('projects', 'projects.id', '=', 'supplier_contractor_car.project')
            ->where('supplier_contractor_car.id',$id);
        $supContCarRecord = $querySupContCar->first();
        
        $supContCarProblemRecord = SupplierContractorCarProblem::where('supplier_contractor_car_id',$id)->get();
        $supContCarCorrective = SupplierContractorCarCorrective::where('supplier_contractor_car_id',$id)->get();
        
        if(!$supContCarRecord){
            return redirect()->back()->with('error', 'Somthing went wrong.');
        }
        $pdf = PDF::loadView('admin.webform.supplierContractorCarRecordPdf',compact('supContCarRecord', 'supContCarProblemRecord', 'supContCarCorrective'));
        return $pdf->stream('supplier_contractor_car.pdf');
        
        
    }
    
     public function contractPreStartChecklist($id)
    {
       
       $querySuperContrEval = PreStartChecklist::query();
        $querySuperContrEval->select('pre_start_checklist.*')
            ->where('pre_start_checklist.id',$id);
        $data = $querySuperContrEval->first();
        
        if(!$data){
            return redirect()->route('contractPreStartChecklist')->with('error', 'Somthing went wrong.');
        }
       $pdf = PDF::loadView('superadmin.contractPreStartChecklist.show',compact('data'));
        return $pdf->stream('contract_Pre_start_checklist.pdf');
    }
    
      function contractPreStartChecklistAttach($id)
    {
       $querySuperContrEval = PreStartChecklist::query();
        $querySuperContrEval->select('pre_start_checklist.*')
            ->where('pre_start_checklist.id',$id);
        $data = $querySuperContrEval->first();
        if(!$data){
            return redirect()->route('contractPreStartChecklist')->with('error', 'Somthing went wrong.');
        }
        return view('superadmin.contractPreStartChecklist.viewAttachement', compact('data'));
    }
    
   
}
