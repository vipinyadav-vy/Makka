<?php
namespace App\Http\Controllers\SuperAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WebForm;
use App\Models\SiteSafetyInspection;
use App\Models\SiteInductionRecord;
use App\Models\SupplierContractorEvalution;
use App\Http\Controllers\SuperAdmin\Mediakit; 
use Illuminate\Support\Facades\Mail;
use App\Mail\SiteInductionRecordMail;

use Hash;
use DB;
use Auth;
use Validator;
use PDF;
class SupplierContractorEvaluationSuperAdmin extends Controller
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
        
        $querySupplierCE = SupplierContractorEvalution::query();
        $querySupplierCE->select('supplier_contractor_evalution.*')
            ->orderBy('supplier_contractor_evalution.id', 'DESC')
            ->when(!empty($from_date) && !empty($to_date), function ($query) use ($from_date, $to_date) {
                $query->whereBetween('supplier_contractor_evalution.supplier_date', [$from_date, $to_date]);
            });
        $data = $querySupplierCE->paginate(10)->withQueryString();
        
        return view('superadmin.supplierContractorEvaluation.index', compact('data'));
        
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
       
       $querySuperContrEval = SupplierContractorEvalution::query();
        $querySuperContrEval->select('supplier_contractor_evalution.*')
            ->orderBy('supplier_contractor_evalution.id', 'DESC')
            ->where('supplier_contractor_evalution.id',$id);
        $data = $querySuperContrEval->first();
        
        if(!$data){
            return redirect()->route('supplierContractorEvaluation')->with('error', 'Somthing went wrong.');
        }
       $pdf = PDF::loadView('superadmin.supplierContractorEvaluation.show',compact('data'));
        return $pdf->stream('supplier_contractor_evaluation.pdf');
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
    
    public function suppContractorEvalAttach($id)
    {
       $querySuperContrEval = SupplierContractorEvalution::query();
        $querySuperContrEval->select('supplier_contractor_evalution.*')
            ->where('supplier_contractor_evalution.id',$id);
        $data = $querySuperContrEval->first();
        if(!$data){
            return redirect()->route('supplierContractorEvaluation')->with('error', 'Somthing went wrong.');
        }
        return view('superadmin.supplierContractorEvaluation.viewAttachement', compact('data'));
    }

    
   
}
