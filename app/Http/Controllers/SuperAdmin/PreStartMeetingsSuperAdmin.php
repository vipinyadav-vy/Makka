<?php
namespace App\Http\Controllers\SuperAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WebForm;
use App\Models\SiteSafetyInspection;
use App\Models\PreStartMeeting;
use App\Models\PreMeetingTopics;
use App\Models\PreMeetingCorrective;
use App\Models\PreMeetingAttendance;
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
class PreStartMeetingsSuperAdmin extends Controller
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
        $queryPreMeeting = PreStartMeeting::query();
        $queryPreMeeting->select('pre_start_meetings.*', 'projects.name as projectname', 'projects.id as projectId')
            ->join('projects', 'projects.id', '=', 'pre_start_meetings.project')
            ->orderBy('pre_start_meetings.id', 'DESC')
            ->when(!empty($from_date) && !empty($to_date), function ($query) use ($from_date, $to_date) {
                $query->whereBetween('pre_start_meetings.pre_meeting_date', [$from_date, $to_date]);
            });
        $preMeetingRecords = $queryPreMeeting->paginate(10)->withQueryString();
        
        return view('superadmin.preMeeting.index', compact('preMeetingRecords'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $projects = Projects::where(['status' => 1])->orderBy('id','DESC')->get();
        return view('superadmin.preMeeting.create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $formData = WebForm::find(8);
        if(!$formData){
            return redirect()->back()->with('error', 'Somthing went wrong.');
        }
        $validate = Validator::make($request->all(), [
            'project' => 'required',
            'pre_meeting_date' => 'required',
            'conducted_by' => 'required',
            'representative' => 'required',
            'topics' => 'required',
            'discussion' => 'required',
            'corrective_action' => 'required',
            'action_by' => 'required',
            'action_sign_off' => 'required',
            'action_date' => 'required'
        ], [
            'project.required' => 'Project is Required',
            'pre_meeting_date.required' => 'Pre Start Meeting Date is Required',
            'conducted_by.required' => 'Conducted By is Required',
            'representative.required' => 'Representative is Required',
            'topics.required' => 'Topics is Required',
            'discussion.required' => 'Discussion is Required',
            'corrective_action.required' => 'Corrective Action is Required',
            'action_by.required' => 'Action By is Required',
            'action_sign_off.required' => 'Action Sign Off is Required',
            'action_date.required' => 'Action Date is Required',
        ]);
        if ($validate->fails()) {
            return back()->withErrors($validate->errors())->withInput();
        }

            $premeeting = new PreStartMeeting();
            $premeeting['webFormId'] = 8;
            $premeeting['project'] = $request->project;
            $premeeting['pre_meeting_date'] = $request->pre_meeting_date;
            $premeeting['conducted_by'] = $request->conducted_by;
            if($request->conducted_by_signature){
            $img = $request->conducted_by_signature;
            $stored = store_base64_upload($img, public_path('/images/signatures'), '/public/images/signatures');
            $imageName = $stored['public'] ?? '';
            $premeeting['conducted_by_signature'] = $imageName;
            }
            $premeeting['representative'] = $request->representative;
            if($request->representative_signature){
            $img = $request->representative_signature;
            $stored = store_base64_upload($img, public_path('/images/signatures'), '/public/images/signatures');
            $imageName = $stored['public'] ?? '';
            $premeeting['representative_signature'] = $imageName;
            }
            $premeeting['discussion']  = $request->discussion;
        if($premeeting->save()){
            $topicsArray = $request->topics;
            for ($i = 0; $i < count($topicsArray); $i++) {
                $topicsval = $topicsArray[$i];
                $PMTopics = new PreMeetingTopics();
                $PMTopics['pre_meeting_id'] = $premeeting->id;
                $PMTopics['topics'] = $topicsval;
                $PMTopics->save();
            }
            $correctiveActionArray = $request->corrective_action;
            $actionByArray = $request->action_by;
            $actionSignOffArray = $request->action_sign_off;
            $actionDateArray = $request->action_date;

            for ($i = 0; $i < count($correctiveActionArray); $i++) {
                $correctiveActionval = $correctiveActionArray[$i];
                $actionByval = $actionByArray[$i];
                $actionSignOffval = $actionSignOffArray[$i];
                $actionDateval = $actionDateArray[$i];
                $PMCorrective = new PreMeetingCorrective();
                $PMCorrective['pre_meeting_id'] = $premeeting->id;
                $PMCorrective['corrective_action'] = $actionByval;
                $PMCorrective['action_by'] = $actionByval;
                $PMCorrective['action_sign_off'] = $actionSignOffval;
                $PMCorrective['action_date'] = $actionDateval;
                $PMCorrective->save();
            }
            
            
            
            
            $queryPreMeeting = PreStartMeeting::query();
        $queryPreMeeting->select('pre_start_meetings.*', 'projects.name as projectname', 'projects.id as projectId')
            ->join('projects', 'projects.id', '=', 'pre_start_meetings.project')
            ->where('pre_start_meetings.id',$premeeting->id);
        $preMeetingrecord = $queryPreMeeting->first();
        
        
        $preMeetingTopics = PreMeetingTopics::where('pre_meeting_id',$premeeting->id)->get();
        $preMeetingCorrective = PreMeetingCorrective::where('pre_meeting_id',$premeeting->id)->get();
        $preMeetingAttendance = PreMeetingAttendance::where('pre_meeting_id',$premeeting->id)->get();


        $pdf = PDF::loadView('superadmin.webforms.pre_start_meeting_recordsPdf',compact('preMeetingrecord', 'preMeetingTopics', 'preMeetingCorrective','preMeetingAttendance'));

            // Define the path where you want to save the PDF
            $savePath = public_path('webformInvoice'); // Change 'pdfs' to your desired folder name
            // Make sure the folder exists, create it if not
            if (!file_exists($savePath)) {
                mkdir($savePath, 0755, true);
            }
            // Save the PDF to the specified path
            $attachmentPath = $savePath . '/' . 'pre_start_meeting_record_' . $premeeting->id . '.pdf';
            $pdf->save($attachmentPath);
            $ccmail = $formData->ccMail;
            Mail::to($formData->toMail)->send(new SiteInductionRecordMail($preMeetingrecord, $attachmentPath, $ccmail));
            unlink($attachmentPath); // Delete the file
            
            
            

            return redirect()->route('preStartMeetings.index')->with('success','Successfully Created');
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
        
        $queryPreMeeting = PreStartMeeting::query();
        $queryPreMeeting->select('pre_start_meetings.*', 'projects.name as projectname', 'projects.id as projectId')
            ->join('projects', 'projects.id', '=', 'pre_start_meetings.project')
            ->where('pre_start_meetings.id',$id);
        $preMeetingrecord = $queryPreMeeting->first();
        
        
        $preMeetingTopics = PreMeetingTopics::where('pre_meeting_id',$id)->get();
        $preMeetingCorrective = PreMeetingCorrective::where('pre_meeting_id',$id)->get();
        $preMeetingAttendance = PreMeetingAttendance::where('pre_meeting_id',$id)->get();


        $pdf = PDF::loadView('superadmin.preMeeting.show',compact('preMeetingrecord', 'preMeetingTopics', 'preMeetingCorrective','preMeetingAttendance'));
        return $pdf->stream('pre_meeting_record.pdf');
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
