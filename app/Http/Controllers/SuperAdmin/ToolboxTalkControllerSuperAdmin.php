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
use App\Http\Controllers\SuperAdmin\Mediakit;
use Illuminate\Support\Facades\Mail;
use App\Mail\SiteInductionRecordMail;
use Hash;
use DB;
use Auth;
use Validator;
use PDF;
class ToolboxTalkControllerSuperAdmin extends Controller
{
    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {    
        
        $from_date = $request->get('from_date');
        $to_date = date('Y-m-d', strtotime($request->get('to_date') . ' + 1 days'));
        $querytooltalkRecords = ToolBoxTalkRecords::query();
        $querytooltalkRecords->select('tool_box_talk_records.*', 'projects.name as projectname', 'projects.id as projectId')
            ->join('projects', 'projects.id', '=', 'tool_box_talk_records.project')
            ->orderBy('tool_box_talk_records.id', 'DESC')
            ->when(!empty($from_date) && !empty($to_date), function ($query) use ($from_date, $to_date) {
                $query->whereBetween('tool_box_talk_records.tollbox_talk_record_date', [$from_date, $to_date]);
            });
        $tooltalkRecords = $querytooltalkRecords->paginate(10)->withQueryString();
        
        return view('superadmin.toolboxTalkRecord.index', compact('tooltalkRecords'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $projects = Projects::where(['status' => 1])->orderBy('id','DESC')->get();
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
        $formData = WebForm::find(7);
        if(!$formData){
            return redirect()->back()->with('error', 'Somthing went wrong.');
        }
        $validate = Validator::make($request->all(), [
            'project' => 'required',
            'tollbox_talk_record_date' => 'required',
            'conducted_by' => 'required',
            'site_topic' => 'required',
            'discussion' => 'required'
        ], [
            'project.required' => 'Project is Required',
            'tollbox_talk_record_date.required' => 'Tollbox Talk Record Date is Required',
            'conducted_by.required' => 'Conducted By is Required',
            'site_topic.required' => 'Site Topic is Required',
            'discussion.required' => 'Discussion is Required',
        ]);
        if ($validate->fails()) {
            return back()->withErrors($validate->errors())->withInput();
        }

        $toolTalkRecord = new ToolBoxTalkRecords();
            $toolTalkRecord['webFormId'] = 7;
            $toolTalkRecord['project'] = $request->project;
            $toolTalkRecord['tollbox_talk_record_date'] = $request->tollbox_talk_record_date;
            $toolTalkRecord['conducted_by'] = $request->conducted_by;
            $toolTalkRecord['site_topic'] = $request->site_topic;
            $toolTalkRecord['discussion']  = $request->discussion;
        if($toolTalkRecord->save()){
            $actionDescriptionArray = $request->actionDescription;
            $actionResponsibleArray = $request->actionResponsible;
            $actionDueDateArray = $request->actionDueDate;
            for ($i = 0; $i < count($actionDescriptionArray); $i++) {
                $actionDescval = $actionDescriptionArray[$i];
                $actionResponsibalval = $actionResponsibleArray[$i];
                $actionDueDateval = $actionDueDateArray[$i];
                $toolBoxTalkAction = new ToolBoxTalkAction();
                $toolBoxTalkAction['tool_box_talk_record_id'] = $toolTalkRecord->id;
                $toolBoxTalkAction['actionDescription'] = $actionDescval;
                $toolBoxTalkAction['actionResponsible'] = $actionResponsibalval;
                $toolBoxTalkAction['actionDueDate'] = $actionDueDateval;
                $toolBoxTalkAction->save();
            }
            
            $querytooltalkRecords = ToolBoxTalkRecords::query();
        $querytooltalkRecords->select('tool_box_talk_records.*', 'projects.name as projectname', 'projects.id as projectId')
            ->join('projects', 'projects.id', '=', 'tool_box_talk_records.project')
            ->where('tool_box_talk_records.id',$toolTalkRecord->id);
        $tollboxtalkrecord = $querytooltalkRecords->first();

        $tollboxtalkrecordAction = ToolBoxTalkAction::where('tool_box_talk_record_id',$toolTalkRecord->id)->get();
        $tollboxtalkrecordAttendance = ToolBoxTalkAttendance::where('tool_box_talk_record_id',$toolTalkRecord->id)->get();
             
            // Load the PDF view
            $pdf = PDF::loadView('superadmin.webforms.tool_box_talk_recordsPdf', compact('tollboxtalkrecord', 'tollboxtalkrecordAction', 'tollboxtalkrecordAttendance'));
            
            // Define the path where you want to save the PDF
            $savePath = public_path('webformInvoice'); // Change 'pdfs' to your desired folder name
            // Make sure the folder exists, create it if not
            if (!file_exists($savePath)) {
                mkdir($savePath, 0755, true);
            }
            // Save the PDF to the specified path
            $attachmentPath = $savePath . '/' . 'tool_box_talk_record_' . $toolTalkRecord->id . '.pdf';
            $pdf->save($attachmentPath);
            $ccmail = $formData->ccMail;
            Mail::to($formData->toMail)->send(new SiteInductionRecordMail($tollboxtalkrecord, $attachmentPath, $ccmail));
            unlink($attachmentPath); // Delete the file
            return redirect()->route('toolBoxTalkRecords.index')->with('success','Successfully Created');
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


        $querytooltalkRecords = ToolBoxTalkRecords::query();
        $querytooltalkRecords->select('tool_box_talk_records.*', 'projects.name as projectname', 'projects.id as projectId')
            ->join('projects', 'projects.id', '=', 'tool_box_talk_records.project')
            ->where('tool_box_talk_records.id',$id);
        $tollboxtalkrecord = $querytooltalkRecords->first();

        $tollboxtalkrecordAction = ToolBoxTalkAction::where('tool_box_talk_record_id',$id)->get();
        $tollboxtalkrecordAttendance = ToolBoxTalkAttendance::where('tool_box_talk_record_id',$id)->get();
        

        $pdf = PDF::loadView('superadmin.toolboxTalkRecord.show',compact('tollboxtalkrecord', 'tollboxtalkrecordAction', 'tollboxtalkrecordAttendance'));
        return $pdf->stream('toolbox_talk_record.pdf');
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



        function toolBoxTalkRecordsPdf(Request $request, $id){
            $data = SiteSafetyInspection::find($id);
            if(!$data){
                return redirect()->route('siteSafetInspectionReports')->with('error', 'Somthing went wrong.');
            }
            $pdf = PDF::loadView('superadmin.webforms.toolboxTalkReportsPdf',compact('data'));
            return $pdf->stream('toolbox_talk_record.pdf');
        }
        

        
    function toolBoxTalkRecordsResendMail(Request $request)
    {
        $id = $request->siteSafeInspectionReportId;
        $data = SiteSafetyInspection::find($id);
        if(!$data){
            return redirect()->back()->with('error', 'Somthing went wrong ghg.');
        }

        $formData = WebForm::find($request->formId);
        if(!$formData){
            return redirect()->back()->with('error', 'Somthing went wrong grrrr.');
        }
        // Load the PDF view
        $pdf = PDF::loadView('superadmin.webforms.toolboxTalkReportsPdf', compact('data'));
        // Define the path where you want to save the PDF
        $savePath = public_path('webformInvoice'); // Change 'pdfs' to your desired folder name
        // Make sure the folder exists, create it if not
        if (!file_exists($savePath)) {
            mkdir($savePath, 0755, true);
        }
        // Save the PDF to the specified path
        $attachmentPath = $savePath . '/' . 'toolbox_talk_record_' . $id . '.pdf';
        $pdf->save($attachmentPath);

        $ccmail = $formData->ccMail;
        Mail::to($formData->toMail)->send(new SiteInductionRecordMail($data, $attachmentPath, $ccmail));
        unlink($attachmentPath); // Delete the file
        return redirect()->back()->with('success','Mail has been sent successfully.');
    }

    
}
