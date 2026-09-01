<?php
namespace App\Http\Controllers\SuperAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WebForm;
use App\Models\SupplierContractorCar;
use App\Models\SupplierContractorCarProblem;
use App\Models\SupplierContractorCarCorrective;
use App\Models\PreStartMeeting;
use App\Models\PreMeetingTopics;
use App\Models\PreMeetingCorrective;
use App\Models\PreMeetingAttendance;
use App\Models\Projects;
use App\Http\Controllers\SuperAdmin\Mediakit;
use Illuminate\Support\Facades\Mail;
use App\Mail\SiteInductionRecordMail;
use Hash;
use DB;
use Auth;
use Validator;
use PDF;
class SupplierContractorCarSuperAdmin extends Controller
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
        $querySupContCar = SupplierContractorCar::query();
        $querySupContCar->select('supplier_contractor_car.*', 'projects.name as projectname', 'projects.id as projectId')
            ->join('projects', 'projects.id', '=', 'supplier_contractor_car.project')
            ->orderBy('supplier_contractor_car.id', 'DESC')
            ->when(!empty($from_date) && !empty($to_date), function ($query) use ($from_date, $to_date) {
                $query->whereBetween('supplier_contractor_car.supply_contractor_car_date', [$from_date, $to_date]);
            });
        $supContCarRecords = $querySupContCar->paginate(10)->withQueryString();
        return view('superadmin.supplierContractorCar.index', compact('supContCarRecords'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $projects = Projects::where(['status' => 1])->orderBy('id','DESC')->get();
        return view('superadmin.supplierContractorCar.create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
         $formData = WebForm::find(11);
        if(!$formData){
            return redirect()->back()->with('error', 'Somthing went wrong.');
        }
       
        $validate = Validator::make($request->all(), [
            'project' => 'required',
            'location' => 'required',
            'supplier' => 'required',
            'issued_by' => 'required',
            'supply_contractor_car_date' => 'required',
            'satisfactory' => 'required'
        ], [
            'project.required' => 'Project is Required',
            'location.required' => 'Location is Required',
            'supplier.required' => 'Supplier / Contractor is Required',
            'issued_by.required' => 'Issued By is Required',
            'supply_contractor_car_date.required' => 'Date is Required',
            'satisfactory.required' => 'Satisfactory is Required'
        ]);
        if ($validate->fails()) {
            return back()->withErrors($validate->errors())->withInput();
        }

       
            $supplierContractorCar = new SupplierContractorCar();
            $supplierContractorCar['webFormId'] = 11;
            $supplierContractorCar['project'] = $request->project;
            $supplierContractorCar['location'] = $request->location;
            $supplierContractorCar['supplier'] = $request->supplier;
            $supplierContractorCar['issued_by']  = $request->issued_by;
            $supplierContractorCar['supply_contractor_car_date']  = $request->supply_contractor_car_date;
            $supplierContractorCar['satisfactory']  = $request->satisfactory;

        if($supplierContractorCar->save()){
            $SPCProblemArray = $request->problem;
            $actionByArray = $request->action;
            $dueDateArray = $request->due_date;
            $closeDateArray = $request->close_date;

            for ($i = 0; $i < count($SPCProblemArray); $i++) {
                $problemval = $SPCProblemArray[$i];
                $actionByval = $actionByArray[$i];
                $dueDateval = $dueDateArray[$i];
                $closeDateval = $closeDateArray[$i];
                $SUPContractorProblem = new SupplierContractorCarProblem();
                $SUPContractorProblem['supplier_contractor_car_id'] = $supplierContractorCar->id;
                $SUPContractorProblem['problem'] = $problemval;
                $SUPContractorProblem['action'] = $actionByval;
                $SUPContractorProblem['due_date'] = $dueDateval;
                $SUPContractorProblem['close_date'] = $closeDateval;
                $SUPContractorProblem->save();
            }
            
            
            
            $querySupContCar = SupplierContractorCar::query();
        $querySupContCar->select('supplier_contractor_car.*', 'projects.name as projectname', 'projects.id as projectId')
            ->join('projects', 'projects.id', '=', 'supplier_contractor_car.project')
            ->where('supplier_contractor_car.id',$supplierContractorCar->id);
        $supContCarRecord = $querySupContCar->first();
        
        $supContCarProblemRecord = SupplierContractorCarProblem::where('supplier_contractor_car_id',$supplierContractorCar->id)->get();
        $supContCarCorrective = SupplierContractorCarCorrective::where('supplier_contractor_car_id',$supplierContractorCar->id)->get();
        $pdf = PDF::loadView('superadmin.supplierContractorCar.show',compact('supContCarRecord', 'supContCarProblemRecord', 'supContCarCorrective'));
            
        
            // Define the path where you want to save the PDF
            $savePath = public_path('webformInvoice'); // Change 'pdfs' to your desired folder name
            // Make sure the folder exists, create it if not
            if (!file_exists($savePath)) {
                mkdir($savePath, 0755, true);
            }
            // Save the PDF to the specified path
            $attachmentPath = $savePath . '/' . 'supplier_contractor_car_record_' . $supplierContractorCar->id . '.pdf';
            $pdf->save($attachmentPath);
            $ccmail = $formData->ccMail;
            Mail::to($formData->toMail)->send(new SiteInductionRecordMail($supContCarRecord, $attachmentPath, $ccmail));
            unlink($attachmentPath); // Delete the file

            return redirect()->route('supplierContractorCar.index')->with('success','Successfully Created');
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
        
        $querySupContCar = SupplierContractorCar::query();
        $querySupContCar->select('supplier_contractor_car.*', 'projects.name as projectname', 'projects.id as projectId')
            ->join('projects', 'projects.id', '=', 'supplier_contractor_car.project')
            ->where('supplier_contractor_car.id',$id);
        $supContCarRecord = $querySupContCar->first();
        
        $supContCarProblemRecord = SupplierContractorCarProblem::where('supplier_contractor_car_id',$id)->get();
        $supContCarCorrective = SupplierContractorCarCorrective::where('supplier_contractor_car_id',$id)->get();
        $pdf = PDF::loadView('superadmin.supplierContractorCar.show',compact('supContCarRecord', 'supContCarProblemRecord', 'supContCarCorrective'));
        return $pdf->stream('supplier_contractor_car_record.pdf');
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
