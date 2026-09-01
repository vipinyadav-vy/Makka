<?php
namespace App\Http\Controllers\SuperAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WebForm;
use App\Models\SiteSafetyInspection;
use App\Models\SiteInductionRecord;
use App\Http\Controllers\SuperAdmin\Mediakit;
use Illuminate\Support\Facades\Mail;
use App\Mail\SiteInductionRecordMail;
use Hash;
use DB;
use Auth;
use Validator;
use PDF;
class WebFormControllerSuperAdmin extends Controller
{
    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {    
        $webforms = WebForm::orderBy('id','DESC')->paginate(10)->withQueryString();
        return view('superadmin.webforms.index', compact('webforms'));
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
        $webForm = WebForm::find($id);
        return view('superadmin.webforms.edit',compact('webForm'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     
     public function update(Request $request,$id){
       
        $validator = Validator::make($request->all(), [
            'title'    		=> 'Required', 
            'toMail'    	=> 'required|email',
        ],
        [   
            'title.required'=> 'Title is Required',
            'toMail.required'=> 'To Mail is Required',

        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $webform = WebForm::find($id);
        if (!$webform) {
            return response()->json(['success' => false, 'message' => 'Web Form not found.']);
        }
        // Update the webform status
        $webform->title = $request->title;
        $webform->toMail = $request->toMail;
        $webform->ccMail = $request->ccMail;
        $webform->status = $request->status;
        if($webform->save()){
            return redirect()->route('webforms.index')->with('success', 'Updated successfully.');
        }

    }

    public function webformUpdate(Request $request)
    {
        $webform = WebForm::find($request->id);
        if (!$webform) {
            return response()->json(['success' => false, 'message' => 'Web Form not found.']);
        }
        // Update the webform status
        $webform->status = $request->status;
        $webform->save();

        if($webform->status == 1){
                return response()->json(['code' => 200, 'success' => true, 'message' => 'Status Activated successfully.']);
            }else{
                return response()->json(['code' => 200, 'error' => true, 'message' => 'Status Deactivated successfully.']);
            }
    }


    public function webformReports(Request $request)
    {
        
        $from_date = $request->get('from_date');
        $to_date = date('Y-m-d', strtotime($request->get('to_date')));
        
        
        $querySiteInduction = SiteInductionRecord::query();
        $querySiteInduction->select('site_induction_record.*', 'projects.name as projectname', 'projects.id as projectId')
            ->join('projects', 'projects.id', '=', 'site_induction_record.project')
            ->orderBy('site_induction_record.id', 'DESC')
            ->when(!empty($from_date) && !empty($to_date), function ($query) use ($from_date, $to_date) {
                $query->whereBetween('site_induction_record.applyDate', [$from_date, $to_date]);
            });
        $data = $querySiteInduction->paginate(10)->withQueryString();
        
        return view('superadmin.webforms.webformReports', compact('data'));
    }

    function fetch_data(Request $request){
    if($request->ajax())
     {
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);

            $from_date = $request->get('from_date');
            $to_date = date('Y-m-d', strtotime($request->get('to_date'). ' + 1 days'));

            $data = DB::table('site_induction_record')
            //->where('project', 'like', '%' . $query . '%')
            ->when(!empty($from_date) && !empty($to_date), function ($query) use ($from_date, $to_date) {
                return $query->whereBetween('applyDate', [$from_date, $to_date]);
            })
            ->orderBy('id', 'DESC')
            ->paginate(10);
      return view('superadmin.webforms.paginate_data', compact('data'))->render();
     }

    }

    
    function webformReportsPdf(Request $request, $id)
    {
        
        $querySiteInduction = SiteInductionRecord::query();
        $querySiteInduction->select('site_induction_record.*', 'projects.name as projectname', 'projects.id as projectId')
            ->join('projects', 'projects.id', '=', 'site_induction_record.project')
            ->orderBy('site_induction_record.id', 'DESC')
            ->where('site_induction_record.id',$id);
        $data = $querySiteInduction->first();
        
        if(!$data){
            return redirect()->route('webformReports')->with('error', 'Somthing went wrong.');
        }
       $pdf = PDF::loadView('superadmin.webforms.siteInductionRecordPdf',compact('data'));
        return $pdf->stream('site_induction_record.pdf');
    }
    
    function resendMail(Request $request)
    {
        $id = $request->siteInductionReportId;
        $querySiteInduction = SiteInductionRecord::query();
        $querySiteInduction->select('site_induction_record.*', 'projects.name as projectname', 'projects.id as projectId')
            ->join('projects', 'projects.id', '=', 'site_induction_record.project')
            ->orderBy('site_induction_record.id', 'DESC')
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




    

    public function siteSafetInspectionReports(Request $request)
    {

        $from_date = $request->get('from_date');
        $to_date = date('Y-m-d', strtotime($request->get('to_date') . ' + 1 days'));
        
        $querySiteSafety = SiteSafetyInspection::query();
        $querySiteSafety->select('site_safety_inspection.*', 'projects.name as projectname', 'projects.id as projectId')
            ->join('projects', 'projects.id', '=', 'site_safety_inspection.project_reference')
            ->orderBy('site_safety_inspection.id', 'DESC')
            ->when(!empty($from_date) && !empty($to_date), function ($query) use ($from_date, $to_date) {
                $query->whereBetween('site_safety_inspection.date', [$from_date, $to_date]);
            });
        $data = $querySiteSafety->paginate(10)->withQueryString();
        
        return view('superadmin.webforms.siteSafeInspectionReports', compact('data'));
    }

    function site_Safe_inspection_fetch_data(Request $request){
        if($request->ajax()){
                $query = $request->get('query');
                $query = str_replace(" ", "%", $query);
    
                $from_date = $request->get('from_date');
                $to_date = date('Y-m-d', strtotime($request->get('to_date'). ' + 1 days'));
    
                $data = DB::table('site_safety_inspection')
                //->where('project', 'like', '%' . $query . '%')
                ->when(!empty($from_date) && !empty($to_date), function ($query) use ($from_date, $to_date) {
                    return $query->whereBetween('date', [$from_date, $to_date]);
                })
                ->orderBy('id', 'DESC')
                ->paginate(10);
          return view('superadmin.webforms.site_safe_inspection_paginate_data', compact('data'))->render();
         }
    
        }



        function siteSafeInspectionReportsPdf(Request $request, $id){

            $querySiteSafety = SiteSafetyInspection::query();
                $querySiteSafety->select('site_safety_inspection.*', 'projects.name as projectname', 'projects.id as projectId')
                    ->join('projects', 'projects.id', '=', 'site_safety_inspection.project_reference')
                    ->orderBy('site_safety_inspection.id', 'DESC')
                    ->where('site_safety_inspection.id',$id);
                $data = $querySiteSafety->first();
            
            if(!$data){
                return redirect()->route('siteSafetInspectionReports')->with('error', 'Somthing went wrong.');
            }
            $pdf = PDF::loadView('superadmin.webforms.siteSafetyInspectionPdf',compact('data'));
            return $pdf->stream('site_safe_inspection_record.pdf');
        }
        

        
    function siteSafeInspectionResendMail(Request $request)
    {
        $id = $request->siteSafeInspectionReportId;

        $querySiteSafety = SiteSafetyInspection::query();
                $querySiteSafety->select('site_safety_inspection.*', 'projects.name as projectname', 'projects.id as projectId')
                    ->join('projects', 'projects.id', '=', 'site_safety_inspection.project_reference')
                    ->orderBy('site_safety_inspection.id', 'DESC')
                    ->where('site_safety_inspection.id',$id);
                $data = $querySiteSafety->first();
        if(!$data){
            return redirect()->back()->with('error', 'Somthing went wrong ghg.');
        }

        $formData = WebForm::find($request->formId);
        if(!$formData){
            return redirect()->back()->with('error', 'Somthing went wrong grrrr.');
        }
        // Load the PDF view
        $pdf = PDF::loadView('superadmin.webforms.siteSafetyInspectionPdf', compact('data'));
        // Define the path where you want to save the PDF
        $savePath = public_path('webformInvoice'); // Change 'pdfs' to your desired folder name
        // Make sure the folder exists, create it if not
        if (!file_exists($savePath)) {
            mkdir($savePath, 0755, true);
        }
        // Save the PDF to the specified path
        $attachmentPath = $savePath . '/' . 'site_safe_inspection_' . $id . '.pdf';
        $pdf->save($attachmentPath);

        $ccmail = $formData->ccMail;
        Mail::to($formData->toMail)->send(new SiteInductionRecordMail($data, $attachmentPath, $ccmail));
        unlink($attachmentPath); // Delete the file
        return redirect()->back()->with('success','Mail has been sent successfully.');
    }
   
}
