<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\User;
use App\Models\ToolBoxTalkRecords;
use App\Models\ToolBoxTalkAction;
use App\Models\SiteInductionRecord;
use App\Models\SiteSafetyInspection;
use App\Models\WebFormsController;
use App\Models\WebForm;
use App\Models\PreStartMeeting;
use App\Models\PreMeetingTopics;
use App\Models\PreMeetingCorrective;
use App\Models\InspectionTestPlan;
use App\Models\InspectionTrade;
use App\Models\SupplierContractorCar;
use App\Models\SupplierContractorCarProblem;
use App\Models\PreStartChecklist;
use App\Models\SupplierContractorEvalution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Validator;

class WebFormController extends BaseController {
        public function __construct() {
            //
        }
        
        public function webFormList(Request $request) {
            $webforms = WebForm::orderBy('id','DESC')->get();
            if($webforms){
                return $this->sendSuccess('Webform List',$webforms);
            } else {
              return $this -> sendFailed('Something Went wrong. Please Try again.');
            }
        } 
        //end Function
        
        //Start Function
        public function changeWebFormStatus(Request $request){
            $validator = Validator:: make($request -> all(), [
                    'id' => 'required|integer',
                    'status'=> 'required|in:0,1',
                ]
            );
            if ($validator->fails()) {
                return $this->sendFailed($validator -> errors() -> first());
            }
            $data = WebForm::find($request->id);
            if(empty($data)){
                return $this->sendFailed('Record Does not Exist');
            }
            $data->status = $request->status;
            if ($data->save()) {
                if ($data->status == '1') {
                    return $this->sendSuccess('Status Activated successfully');
                } else {
                    return $this->sendSuccess('Status Deactivated successfully');
                }
            } else {
                return $this -> sendFailed('Something Went wrong. Please Try again.');
            }
        }
        //end Function
        
        //Start Function
        public function updateWebForm(Request $request){
            $validator = Validator:: make($request -> all(), [
                    'id' => 'required|integer',
                    'title'=> 'required|string|max:255',
                    'toMail'=> 'required|email|max:255',
                    'ccMail'=> 'nullable|string|max:500',
                    'status'=> 'nullable|in:0,1',
                ]
            );
            if ($validator->fails()) {
                return $this->sendFailed($validator -> errors() -> first());
            }
            $webform = WebForm::find($request->id);
            if (!$webform) {
                return $this -> sendFailed('Something Went wrong. Please Try again.');
            }
            $webform->title = $request->title;
            $webform->toMail = $request->toMail;
            if($request->ccMail){
                $webform->ccMail = $request->ccMail;
            }
            $webform->status = $request->status;
            if($webform->save()){
                return $this->sendSuccess('Updated successfully');
            }
        }
        //end Function
        
        //Start Function
        public function siteInductionRecord(Request $request) {
            $from_date = $request->from_date;
            $to_date = date('Y-m-d', strtotime($request->to_date));
            $querySiteInduction = SiteInductionRecord::query();
            $querySiteInduction->select('site_induction_record.*', 'projects.name as projectname', 'projects.id as projectId')
                ->join('projects', 'projects.id', '=', 'site_induction_record.project')
                ->orderBy('site_induction_record.id', 'DESC')
                ->when(!empty($from_date) && !empty($to_date), function ($query) use ($from_date, $to_date) {
                    $query->whereBetween('site_induction_record.applyDate', [$from_date, $to_date]);
                });
            $records = $querySiteInduction->get();
             // Append pdfUrl to each record
            $records->transform(function ($record) {
                $record->pdfUrl = url("siteInductionReportsPdf/{$record->id}");
                return $record;
            });
            if($records){
                return $this->sendSuccess('Site Induction Record List',$records);
            } else {
              return $this -> sendFailed('Something Went wrong. Please Try again.');
            }
        }
        //end Function
        
        //Start Function
        public function siteSafetInspectionRecord(Request $request) {
            $from_date = $request->from_date;
            $to_date = date('Y-m-d', strtotime($request->to_date));
            $querySiteSafety = SiteSafetyInspection::query();
            $querySiteSafety->select('site_safety_inspection.*', 'projects.name as projectname', 'projects.id as projectId')
                ->join('projects', 'projects.id', '=', 'site_safety_inspection.project_reference')
                ->orderBy('site_safety_inspection.id', 'DESC')
                ->when(!empty($from_date) && !empty($to_date), function ($query) use ($from_date, $to_date) {
            $query->whereBetween('site_safety_inspection.date', [$from_date, $to_date]);
            });
            $records = $querySiteSafety->get();
              // Append pdfUrl to each record
            $records->transform(function ($record) {
                $record->pdfUrl = url("siteSafeInspectionReportsPdf/{$record->id}");
                return $record;
            });
            if($records){
                return $this->sendSuccess('Site Safety Record List',$records);
            } else {
              return $this -> sendFailed('Something Went wrong. Please Try again.');
            }
        }
        //end Function
        
        
         //Start Function
        public function preStartRecord(Request $request) {
            
            
             $from_date = $request->get('from_date');
        $to_date = date('Y-m-d', strtotime($request->get('to_date')));
        $queryPreMeeting = PreStartMeeting::query();
        $queryPreMeeting->select('pre_start_meetings.*', 'projects.name as projectname', 'projects.id as projectId')
            ->join('projects', 'projects.id', '=', 'pre_start_meetings.project')
            ->orderBy('pre_start_meetings.id', 'DESC')
            ->when(!empty($from_date) && !empty($to_date), function ($query) use ($from_date, $to_date) {
                $query->whereBetween('pre_start_meetings.pre_meeting_date', [$from_date, $to_date]);
            });
        $preMeetingRecords = $queryPreMeeting->get();
              // Append pdfUrl to each record 
            $preMeetingRecords->transform(function ($record) {
                $record->shareUrl = url("preStartMeetings/{$record->id}");
                $record->pdfUrl = url("preStartMeetingsPdf/{$record->id}");
                return $record;
            });
             
            if($preMeetingRecords){
                return $this->sendSuccess('Pre Start Meeting Record List',$preMeetingRecords);
            } else {
              return $this -> sendFailed('Something Went wrong. Please Try again.');
            }
        }
        //end Function
        
         //Start Function
        public function toolBoxTalkRecords(Request $request) {
            
            
            
            $from_date = $request->get('from_date');
        $to_date = date('Y-m-d', strtotime($request->get('to_date')));
        $querytooltalkRecords = ToolBoxTalkRecords::query();
        $querytooltalkRecords->select('tool_box_talk_records.*', 'projects.name as projectname', 'projects.id as projectId')
            ->join('projects', 'projects.id', '=', 'tool_box_talk_records.project')
            ->orderBy('tool_box_talk_records.id', 'DESC')
            ->when(!empty($from_date) && !empty($to_date), function ($query) use ($from_date, $to_date) {
                $query->whereBetween('tool_box_talk_records.tollbox_talk_record_date', [$from_date, $to_date]);
            });
        $tooltalkRecords = $querytooltalkRecords->get();
            
            
            if($tooltalkRecords){
                return $this->sendSuccess('Tool box talk Record List',$tooltalkRecords);
            } else {
              return $this -> sendFailed('Something Went wrong. Please Try again.');
            }
        }
        //end Function
        
        public function inspectionTestPlan(Request $request){
            $from_date = $request->get('from_date');
            $to_date = date('Y-m-d', strtotime($request->get('to_date')));
            $queryPreMeeting = InspectionTestPlan::query();
            $queryPreMeeting->select('inspectiontestplans.*', 'projects.name as projectname', 'projects.id as projectId')
                ->join('projects', 'projects.id', '=', 'inspectiontestplans.project')
                ->orderBy('inspectiontestplans.id', 'DESC')
                ->when(!empty($from_date) && !empty($to_date), function ($query) use ($from_date, $to_date) {
                    $query->whereBetween('inspectiontestplans.revision_date', [$from_date, $to_date]);
                });
            $inscpectionRecords = $queryPreMeeting->get();
            $inscpectionRecords->transform(function ($record) {
                    $record->shareWithRepresentative = url("inspectionTestPlan/{$record->id}?type=PC");
                    $record->shareWithSubcontractor = url("inspectionTestPlan/{$record->id}?type=SC");
                    $record->pdfUrl = url("inspectionTestPlanPdf/{$record->id}");
                    return $record;
                });
                if($inscpectionRecords){
                    return $this->sendSuccess('Inspection Test Plan Record List',$inscpectionRecords);
                } else {
                  return $this -> sendFailed('Something Went wrong. Please Try again.');
                }
            return view('superadmin.inspectionTestPlan.index', compact('inscpectionRecords'));
        }
        
        
        public function supplierContractorCar(Request $request){
            $from_date = $request->get('from_date');
            $to_date = date('Y-m-d', strtotime($request->get('to_date')));
            $querySupContCar = SupplierContractorCar::query();
            $querySupContCar->select('supplier_contractor_car.*', 'projects.name as projectname', 'projects.id as projectId')
                ->join('projects', 'projects.id', '=', 'supplier_contractor_car.project')
                ->orderBy('supplier_contractor_car.id', 'DESC')
                ->when(!empty($from_date) && !empty($to_date), function ($query) use ($from_date, $to_date) {
                    $query->whereBetween('supplier_contractor_car.supply_contractor_car_date', [$from_date, $to_date]);
                });
                $supContCarRecords = $querySupContCar->get();
                $supContCarRecords->transform(function ($record) {
                    $record->shareUrl = url("supplierContractorCar/{$record->id}");
                    $record->pdfUrl = url("supplierContractorCarPdf/{$record->id}");
                    return $record;
                });
                if($supContCarRecords){
                    return $this->sendSuccess('Supplier Contractor Car Record List',$supContCarRecords);
                } else {
                  return $this -> sendFailed('Something Went wrong. Please Try again.');
                }
        }
            
            
              //Start Function
        public function preStartChecklist(Request $request) {
            $from_date = $request->get('from_date');
            $to_date = date('Y-m-d', strtotime($request->get('to_date') . ' + 1 days'));
            $queryPreCheckList = PreStartChecklist::query(); 
            $queryPreCheckList->select('pre_start_checklist.*')
                ->orderBy('pre_start_checklist.id', 'DESC')
                ->when(!empty($from_date) && !empty($to_date), function ($query) use ($from_date, $to_date) {
                    $query->whereBetween('pre_start_checklist.manager_date', [$from_date, $to_date]);
                });
            $records = $queryPreCheckList->get();
            $records->transform(function ($record) {
                    $record->pdfUrl = url("contractPreStartChecklistPdf/{$record->id}");
                    //$record->viewAttach = url("contractPreStartChecklistAttach/{$record->id}");
                    return $record;
                });
            if($records){
                return $this->sendSuccess('Contract Pre Start Check Record List',$records);
            } else {
              return $this -> sendFailed('Something Went wrong. Please Try again.');
            }
        }
        //end Function
        
          //Start Function
        public function contractPreStartChecklistAttach(Request $request){
            $validator = Validator:: make($request -> all(), [
                    'id' => 'required',
                ]
            );
            if ($validator->fails()) {
                return $this->sendFailed($validator -> errors() -> first());
            }
            
            $querySuperContrEval = PreStartChecklist::query();
        $querySuperContrEval->select('pre_start_checklist.*')
            ->where('pre_start_checklist.id',$request->id);
        $data = $querySuperContrEval->first();
            
            if($data){
                return $this->sendSuccess('contractor pre start checklist Attachment',$data);
            }
        }
        //end Function
        
        
        
        
              //Start Function
        public function contractorEvaluation(Request $request) {
             $from_date = $request->get('from_date');
        $to_date = date('Y-m-d', strtotime($request->get('to_date') . ' + 1 days'));
        
        $querySupplierCE = SupplierContractorEvalution::query();
        $querySupplierCE->select('supplier_contractor_evalution.*')
            ->orderBy('supplier_contractor_evalution.id', 'DESC')
            ->when(!empty($from_date) && !empty($to_date), function ($query) use ($from_date, $to_date) {
                $query->whereBetween('supplier_contractor_evalution.supplier_date', [$from_date, $to_date]);
            });
        $records = $querySupplierCE->get();
        $records->transform(function ($record) {
                    $record->pdfUrl = url("supplierContractorEvaluationPdf/{$record->id}");
                    return $record;
                });
        
            if($records){
                return $this->sendSuccess('Supplier Contractor Evalution Record List',$records);
            } else {
              return $this -> sendFailed('Something Went wrong. Please Try again.');
            }
        }
        //end Function
        
        
          //Start Function
        public function contractorEvaluationAttachment(Request $request){
            $validator = Validator:: make($request -> all(), [
                    'id' => 'required',
                ]
            );
            if ($validator->fails()) {
                return $this->sendFailed($validator -> errors() -> first());
            }
            $querySuperContrEval = SupplierContractorEvalution::query();
            $querySuperContrEval->select('supplier_contractor_evalution.*')
                ->where('supplier_contractor_evalution.id',$request->get('id'));
            $data = $querySuperContrEval->first(); 
            if($data){
                return $this->sendSuccess('contractor Evaluation Attachment',$data);
            }
        }
        //end Function
        
        
        //Start Function
        public function siteInductionRecordSave(Request $request) {
            $validator = Validator:: make($request -> all(), [
                'project' => 'required',
                'inductionNumber' => 'required',
                'workerName' => 'required',
                'workerAddress' => 'required',
                'phone_no' => 'required',
                'identityDocument' => 'required',
                'inductionCardNo' => 'required',
                'occupation' => 'required',
                'qualification' => 'required',
                'citizen' => 'required',
                'employerName' => 'required',
                'abnNumber' => 'required',
                'employerrepresentative' => 'required',
                'employerPhone' => 'required',
                'siteManagement' => 'required',
                'siteHours' => 'required',
                'siteSafety' => 'required',
                'minimumPpe' => 'required',
                'whsManagementPlan' => 'required',
                'healthSafetyRepresentatives' => 'required',
                'workerDuties' => 'required',
                'firstAid' => 'required',
                'emergencyResponse' => 'required',
                'emergencyEvacuation' => 'required',
                'trafficManagement' => 'required',
                'exclusiveZones' => 'required',
                'mobilePlant' => 'required',
                'scaffoldSafety' => 'required',
                'siteAmenities' => 'required',
                'siteAccess' => 'required',
                'dailySign' => 'required',
                'siteNoticeboard' => 'required',
                'siteNoSmoking' => 'required',
                'siteDrug' => 'required',
                'siteViolence' => 'required',
                'hazardIncidentReport' => 'required',
                'stopWorkPolicy' => 'required',
                'swmsSafety' => 'required',
                'housekeepingPolicy' => 'required',
                'electricSafety' => 'required',
                'nonCompliance' => 'required',
                'safeWorkMethodConfirmation' => 'required',
                'skillsConfirmation' => 'required',
                'englishConfirmation' => 'required',
                'inducteeName' => 'required',
            // 'inducteeSignature' => 'required',
                'applyDate' => 'required',
            ]);
            if ($validator->fails()) {
              return $this->sendFailed($validator -> errors() -> first());
            }
            $siteInductionRecord = new SiteInductionRecord();
            $siteInductionRecord->webFormId = 6;
            $siteInductionRecord->project = $request->project;
            $siteInductionRecord->inductionNumber = $request->inductionNumber;
            $siteInductionRecord->workerName = $request->workerName;
            $siteInductionRecord->workerAddress = $request->workerAddress;
            $siteInductionRecord->phone_no = $request->phone_no;
            if ($request->file('identityDocument')) {
                $stored = store_uploaded_file_safe(
                    $request->file('identityDocument'),
                    public_path('/images/identities/'),
                    '/public/images/identities',
                    ['jpg', 'jpeg', 'png', 'pdf']
                );
                if ($stored) {
                    $siteInductionRecord->identityDocument = $stored['public'];
                }
            }
            $siteInductionRecord->inductionCardNo = $request->inductionCardNo;
            $siteInductionRecord->occupation = $request->occupation;
            $siteInductionRecord->qualification = $request->qualification;
            $siteInductionRecord->citizen = $request->citizen;
            $siteInductionRecord->employerName = $request->employerName;
            $siteInductionRecord->abnNumber = $request->abnNumber;
            $siteInductionRecord->employerrepresentative = $request->employerrepresentative;
            $siteInductionRecord->employerPhone = $request->employerPhone;
            if($request->siteManagement){
                $siteInductionRecord->siteManagement = 1;
            }
            if($request->siteHours){
                $siteInductionRecord->siteHours = 1;
            }
            if($request->siteSafety){
                $siteInductionRecord->siteSafety = 1;
            }
            if($request->minimumPpe){
                $siteInductionRecord->minimumPpe = 1;
            }
            if($request->whsManagementPlan){
                $siteInductionRecord->whsManagementPlan = 1;
            }
            if($request->healthSafetyRepresentatives){
                $siteInductionRecord->healthSafetyRepresentatives = 1;
            }
            if($request->workerDuties){
                $siteInductionRecord->workerDuties = 1;
            }
            if($request->firstAid){
                $siteInductionRecord->firstAid = 1;
            }
            if($request->emergencyResponse){
                $siteInductionRecord->emergencyResponse = 1;
            }
            if($request->emergencyEvacuation){
                $siteInductionRecord->emergencyEvacuation = 1;
            }
            if($request->trafficManagement){
                $siteInductionRecord->trafficManagement = 1;
            }
            if($request->exclusiveZones){
                $siteInductionRecord->exclusiveZones = 1;
            }
            if($request->mobilePlant){
                $siteInductionRecord->mobilePlant = 1;
            }
            if($request->scaffoldSafety){
                $siteInductionRecord->scaffoldSafety = 1;
            }
            if($request->siteAmenities){
                $siteInductionRecord->siteAmenities = 1;
            }
            if($request->siteAccess){
                $siteInductionRecord->siteAccess = 1;
            }
            if($request->dailySign){
                $siteInductionRecord->dailySign = 1;
            }
            if($request->siteNoticeboard){
                $siteInductionRecord->siteNoticeboard = 1;
            }
            if($request->siteNoSmoking){
                $siteInductionRecord->siteNoSmoking = 1;
            }
            if($request->siteDrug){
                $siteInductionRecord->siteDrug = 1;
            }
            if($request->siteViolence){
                $siteInductionRecord->siteViolence = 1;
            }
            if($request->hazardIncidentReport){
                $siteInductionRecord->hazardIncidentReport = 1;
            }
            if($request->stopWorkPolicy){
                $siteInductionRecord->stopWorkPolicy = 1;
            }
            if($request->swmsSafety){
                $siteInductionRecord->swmsSafety = 1;
            }
            if($request->housekeepingPolicy){
                $siteInductionRecord->housekeepingPolicy = 1;
            }
            if($request->electricSafety){
                $siteInductionRecord->electricSafety = 1;
            }
            if($request->nonCompliance){
                $siteInductionRecord->nonCompliance = 1;
            }
            if($request->safeWorkMethodConfirmation){
                $siteInductionRecord->safeWorkMethodConfirmation = 1;
            }
            if($request->skillsConfirmation){
                $siteInductionRecord->skillsConfirmation = 1;
            }
            if($request->englishConfirmation){
                $siteInductionRecord->englishConfirmation = 1;
            }
            $siteInductionRecord->inducteeName = $request->inducteeName;
            if($request->inducteeSignature){
            $img = $request->inducteeSignature;
            $stored = store_base64_upload($img, public_path('/images/signatures'), '/public/images/signatures');
            $imageName = $stored['public'] ?? '';
            $siteInductionRecord->inducteeSignature = $imageName;
            }
            $siteInductionRecord->applyDate = $request->applyDate;
            if($siteInductionRecord->save()){
              return $this->sendSuccess('Submitted Successfully');
            } else {
              return $this -> sendFailed('Something Went wrong. Please Try again.');
            }
        }
        //end Function
        
        //Start Function
        public function siteSafetyInspectionSave(Request $request) {
            $validator = Validator:: make($request -> all(), [
                'project_reference' => 'required|max:250',
                'location' => 'required|max:250',
                'area_inspected' => 'required|max:250',
                'inspected_by' => 'required|max:500',
                'date' => 'required',
                'site_document' => 'required',
                'site_document_comments' => 'required|max:250',
                'site_signage' => 'required',
                'site_signage_comments' => 'required|max:250',
                'safety_signs' => 'required',
                'safety_signs_comments' => 'required|max:250',
                'mandatory_ppe' => 'required',
                'mandatory_ppe_comments' => 'required|max:250',
                'policies' => 'required',
                'policies_comments' => 'required|max:250',
                'site_rules' => 'required',
                'site_rules_comments' => 'required|max:250',
                'emergency_information' => 'required',
                'emergency_information_comments' => 'required|max:250',
                'first_aid_officers' => 'required',
                'first_aid_officers_comments' => 'required|max:250',
                'sign_in' => 'required',
                'sign_in_comments' => 'required|max:250',
                'site_security' => 'required',
                'site_security_comments' => 'required|max:250',
                'site_fence' => 'required',
                'site_fence_comments' => 'required|max:250',
                'appropriate_barricades' => 'required',
                'appropriate_barricades_comments' => 'required|max:250',
                'site_access' => 'required',
                'site_access_comments' => 'required|max:250',
                'public_access' => 'required',
                'public_access_comments' => 'required|max:250',
                'safe_access' => 'required',
                'safe_access_comments' => 'required|max:250',
                'site_processes' => 'required',
                'site_processes_comments' => 'required|max:250',
                'all_workers_inducted_on_site' => 'required',
                'all_workers_inducted_on_site_comments' => 'required|max:250',
                'workers_inducted_swms_sops' => 'required',
                'workers_inducted_swms_sops_comments' => 'required|max:250',
                'workers_white_cards' => 'required',
                'workers_white_cards_comments' => 'required|max:250',
                'workers_following_site_processes' => 'required',
                'workers_following_site_processes_comments' => 'required|max:250',
                'daily_pre_start_meetings' => 'required',
                'daily_pre_start_meetings_comments' => 'required|max:250',
                'toolbox_talks_regularly_conducted' => 'required',
                'toolbox_talks_regularly_conducted_comments' => 'required|max:250',
                'housekeeping' => 'required',
                'housekeeping_comments' => 'required|max:250',
                'site_generally_clean' => 'required',
                'site_generally_clean_comments' => 'required|max:250',
                'walkways_clear_obstruction' => 'required',
                'walkways_clear_obstruction_comments' => 'required|max:250',
                'materials_safely_stowed' => 'required',
                'materials_safely_stowed_comments' => 'required|max:250',
                'rubbish_debris_disposed' => 'required',
                'rubbish_debris_disposed_comments' => 'required|max:250',
                'slurry_water_dust_removed' => 'required',
                'slurry_water_dust_removed_comments' => 'required|max:250',
                'amenities' => 'required',
                'amenities_comments' => 'required|max:250',
                'sufficient_toilets_bubblers_provided' => 'required',
                'sufficient_toilets_bubblers_provided_comments' => 'required|max:250',
                'lunchroom_facilities_provided' => 'required',
                'lunchroom_facilities_provided_comments' => 'required|max:250',
                'amenities_clean_tidy' => 'required',
                'amenities_clean_tidy_comments' => 'required|max:250',
                'electrical' => 'required',
                'electrical_comments' => 'required|max:250',
                'temporary_power_boards_present' => 'required',
                'temporary_power_boards_present_comments' => 'required|max:250',
                'temporary_power_boards_fitted_rcd' => 'required',
                'temporary_power_boards_fitted_rcd_comments' => 'required|max:250',
                'temporary_power_board_secured_ground' => 'required',
                'temporary_power_board_secured_ground_comments' => 'required|max:250',
                'temporary_power_board_compliant_AS_NZS' => 'required',
                'temporary_power_board_compliant_AS_NZS_comments' => 'required|max:250',
                'electrical_equipment_current_test_tag' => 'required',
                'electrical_equipment_current_test_tag_comments' => 'required|max:250',
                'electrical_equipment_connected_RCD' => 'required',
                'electrical_equipment_connected_RCD_comments' => 'required|max:250',
                'extension_leads_current_test_tag' => 'required',
                'extension_leads_current_test_tag_comments' => 'required|max:250',
                'electrical_leads_elevated_ground_lead_stands' => 'required',
                'electrical_leads_elevated_ground_lead_stands_comments' => 'required|max:250',
                'electrical_equipment_leads_good_condition' => 'required',
                'electrical_equipment_leads_good_condition_comments' => 'required|max:250',
                'working_heights' => 'required',
                'working_heights_comments' => 'required|max:250',
                'all_falls_2m_protected' => 'required',
                'all_falls_2m_protected_comments' => 'required|max:250',
                'temporary_edge_protection' => 'required',
                'temporary_edge_protection_comments' => 'required|max:250',
                'extension_ladders_secured' => 'required',
                'extension_ladders_secured_comments' => 'required|max:250',
                'height_safety_equipment' => 'required',
                'height_safety_equipment_comments' => 'required|max:250',
                'penetrations_voids' => 'required',
                'penetrations_voids_comments' => 'required|max:250',
                'penetration_covers_mechanically' => 'required',
                'penetration_covers_mechanically_comments' => 'required|max:250',
                'necessary_cast_mesh' => 'required',
                'necessary_cast_mesh_comment' => 'required|max:250',
                'lift_shafts' => 'required',
                'lift_shafts_comments' => 'required|max:250',
                'guards_place_stair_voids' => 'required',
                'guards_place_stair_voids_comments' => 'required|max:250',
                'areas_delineated' => 'required',
                'areas_delineated_comments' => 'required|max:250',
                'materials_fall_protection' => 'required',
                'materials_fall_protection_comments' => 'required|max:250',
                'netting_covers_perimeter_scaffolding' => 'required',
                'netting_covers_perimeter_scaffolding_comments' => 'required|max:250',
                'toe_boards_installed_all_guard_rails' => 'required',
                'toe_boards_installed_all_guard_rails_comments' => 'required|max:250',
                'core_holes' => 'required',
                'core_holes_comments' => 'required|max:250',
                'scaffolds' => 'required',
                'scaffolds_comments' => 'required|max:250',
                'scaffold_current_test_tag_entry_points' => 'required',
                'scaffold_current_test_tag_entry_points_comments' => 'required|max:250',
                'handover_certificate_available' => 'required',
                'handover_certificate_available_comments' => 'required|max:250',
                'adequately_braced' => 'required',
                'adequately_braced_comments' => 'required|max:250',
                'scaffold_working_face_exceed_225mm' => 'required',
                'scaffold_working_face_exceed_225mm_comments' => 'required|max:250',
                'all_scaffold_components_intact' => 'required',
                'all_scaffold_components_intact_comments' => 'required|max:250',
                'access_ladders' => 'required',
                'access_ladders_comments' => 'required|max:250',
                'bays_free_obstruction' => 'required',
                'bays_free_obstruction_comments' => 'required|max:250',
                'minimum_450mm_wide_gap' => 'required',
                'minimum_450mm_wide_gap_comments' => 'required|max:250',
                'Bays_not_point_loaded' => 'required',
                'Bays_not_point_loaded_comments' => 'required|max:250',
                'bays_being_overloaded' => 'required',
                'bays_being_overloaded_comments' => 'required|max:250',
                'no_missing_scaffold_planks' => 'required',
                'no_missing_scaffold_planks_comments' => 'required|max:250',
                'sole_plates_founded_solid_base' => 'required',
                'sole_plates_founded_solid_base_comments' => 'required|max:250',
                'lapboards_mechanically_secured' => 'required',
                'lapboards_mechanically_secured_comments' => 'required|max:250',
                'incomplete_scaffold_barricaded_closed' => 'required',
                'incomplete_scaffold_barricaded_closed_comments' => 'required|max:250',
                'ppe' => 'required',
                'ppe_comments' => 'required|max:250',
                'workers_wearing_mandatory_ppe' => 'required',
                'workers_wearing_mandatory_ppe_comments' => 'required|max:250',
                'workers_observed_ppe_correctly_tasks' => 'required',
                'workers_observed_ppe_correctly_tasks_comments' => 'required|max:250',
                'ppe_complies_regulatory_requirements' => 'required',
                'ppe_complies_regulatory_requirements_comments' => 'required|max:250',
                'ladders' => 'required',
                'ladders_comments' => 'required|max:250',
                'industrial_strength_ladder' => 'required',
                'industrial_strength_ladder_comments' => 'required|max:250',
                'ladders_good_condition' => 'required',
                'ladders_good_condition_comments' => 'required|max:250',
                'safety_labels_intact' => 'required',
                'safety_labels_intact_comments' => 'required|max:250',
                'extension_adders_secured_top_bottom' => 'required',
                'extension_adders_secured_top_bottom_comments' => 'required|max:250',
                'extension_ladders_extend_1m_past_top_landing' => 'required',
                'extension_ladders_extend_1m_past_top_landing_comments' => 'required|max:250',
                'extension_ladders_placed_correct_angle_1_4' => 'required',
                'extension_ladders_placed_correct_angle_1_4_comments' => 'required|max:250',
                'ladders_not_used_scaffold' => 'required',
                'ladders_not_used_scaffold_comments' => 'required|max:250',
                'ladders_not_used_entrance_ways' => 'required',
                'ladders_not_used_entrance_ways_comments' => 'required|max:250',
                'trenches_xcavations' => 'required',
                'trenches_xcavations_comments' => 'required|max:250',
                'DBYD_been_obtained_before_work' => 'required',
                'DBYD_been_obtained_before_work_comments' => 'required|max:250',
                'services_have_been_located_potholed' => 'required',
                'services_have_been_located_potholed_comments' => 'required|max:250',
                'excavations_trenches_barricaded_sign_posted' => 'required',
                'excavations_trenches_barricaded_sign_posted_comments' => 'required|max:250',
                'correct_trench_support_used_where_necessary' => 'required',
                'correct_trench_support_used_where_necessary_comments' => 'required|max:250',
                'trenches_greater_than_1_5m_have_edge_protection' => 'required',
                'trenches_greater_than_1_5m_have_edge_protection_comments' => 'required|max:250',
                'edges_excavations' => 'required',
                'edges_excavations_comments' => 'required|max:250',
                'hazardous_substances' => 'required',
                'hazardous_substances_comments' => 'required|max:250',
                'register_kept_on_site_and_up_to_date' => 'required',
                'register_kept_on_site_and_up_to_date_comments' => 'required|max:250',
                'SDS_available_hazardous_substances' => 'required',
                'SDS_available_hazardous_substances_comments' => 'required|max:250',
                'appropriate_signage_displayed' => 'required',
                'appropriate_signage_displayed_comments' => 'required|max:250',
                'adequately_stored_ventilated' => 'required',
                'adequately_stored_ventilated_comments' => 'required|max:250',
                'kept_original_containers_with_labels' => 'required',
                'kept_original_containers_with_labels_comments' => 'required|max:250',
                'spill_kit_available_site' => 'required',
                'spill_kit_available_site_comments' => 'required|max:250',
                'emergency_first_aid' => 'required',
                'emergency_first_aid_comments' => 'required|max:250',
                'emergency_access_kept_all_times' => 'required',
                'emergency_access_kept_all_times_comments' => 'required|max:250',
                'emergency_exit_points_clearly_marked' => 'required',
                'emergency_exit_points_clearly_marked_comments' => 'required|max:250',
                'emergency_evacuation_plan_displayed' => 'required',
                'emergency_evacuation_plan_displayed_comments' => 'required|max:250',
                'emergency_assembly_point_displayed' => 'required',
                'emergency_assembly_point_displayed_comments' => 'required|max:250',
                'emergency_contact_details_displayed' => 'required',
                'emergency_contact_details_displayed_comments' => 'required|max:250',
                'adequate_firefighting_equipment_available' => 'required',
                'adequate_firefighting_equipment_available_comments' => 'required|max:250',
                'firefighting_equipment_current_test_tag' => 'required',
                'firefighting_equipment_current_test_tag_comments' => 'required|max:250',
                'first_aid_officer_contact_displayed' => 'required',
                'first_aid_officer_contact_displayed_comments' => 'required|max:250',
                'first_aid_signage_displayed' => 'required',
                'first_aid_signage_displayed_comments' => 'required|max:250',
                'first_aid_kit_fully_stocked' => 'required',
                'first_aid_kit_fully_stocked_comments' => 'required|max:250',
                'first_aid_emergency_personnel_trained' => 'required',
                'first_aid_emergency_personnel_trained_comments' => 'required|max:250',
                'injury_register_maintained_site' => 'required',
                'injury_register_maintained_site_comments' => 'required|max:250',
                'hot_works_approved_adequately_controls' => 'required',
                'hot_works_approved_adequately_controls_comments' => 'required|max:250',
                'cranes' => 'required',
                'cranes_comments' => 'required|max:250',
                'certificate_registration_available' => 'required',
                'certificate_registration_available_comments' => 'required|max:250',
                'insurances_available' => 'required',
                'insurances_available_comments' => 'required|max:250',
                'maintenance_service_records_available_and_up_to_date' => 'required',
                'maintenance_service_records_available_and_up_to_date_comments' => 'required|max:250',
                'pre_start_inspection_being_completed' => 'required',
                'pre_start_inspection_being_completed_comments' => 'required|max:250',
                'crane_crew_hold_appropriate_licences' => 'required',
                'crane_crew_hold_appropriate_licences_comments' => 'required|max:250',
                'exclusion_being_used_during_movement_loads' => 'required',
                'exclusion_being_used_during_movement_loads_comments' => 'required|max:250',
                'emergency_response_measures_place' => 'required',
                'emergency_response_measures_place_comments' => 'required|max:250',
                'mobile_plant' => 'required',
                'mobile_plant_comments' => 'required|max:250',
                'certificate_registration_available1' => 'required',
                'certificate_registration_available_comments1' => 'required|max:250',
                'insurances_available1' => 'required',
                'insurances_available_comments1' => 'required|max:250',
                'maintenance_service_records_available_and_up_to_date1' => 'required',
                'maintenance_service_records_available_and_up_to_date_comments1' => 'required|max:250',
                'operators_hold_appropriate_licences' => 'required',
                'operators_hold_appropriate_licences_comments' => 'required|max:250',
                'exclusion_being_used_where_necessary' => 'required',
                'exclusion_being_used_where_necessary_comments' => 'required|max:250',
                'emergency_response_measures_place1' => 'required',
                'emergency_response_measures_place_comments1' => 'required|max:250',
                'lifting_equipment' => 'required',
                'lifting_equipment_comments' => 'required|max:250',
                'register_available_maintained_site' => 'required',
                'register_available_maintained_site_comments' => 'required|max:250',
                'equipment_has_current_test_tag' => 'required',
                'equipment_has_current_test_tag_comments' => 'required|max:250',
                'equipment_correctly_stored' => 'required',
                'equipment_correctly_stored_comments' => 'required|max:250',
                'equipment_inspected_before_use' => 'required',
                'equipment_inspected_before_use_comments' => 'required|max:250',
                'traffic_control' => 'required',
                'traffic_control_comments' => 'required|max:250',
                'traffic_management' => 'required',
                'traffic_management_comments' => 'required|max:250',
                'fencing_barriers_to_stop_public_access_to_site' => 'required',
                'fencing_barriers_to_stop_public_access_to_site_comments' => 'required|max:250',
                'public_areas_kept_clear_of_materials' => 'required',
                'public_areas_kept_clear_of_materials_comments' => 'required|max:250',
                'traffic_controllers_certified' => 'required',
                'traffic_controllers_certified_comments' => 'required|max:250',
                'signs_and_devices_in_use' => 'required',
                'signs_and_devices_in_use_comments' => 'required|max:250',
                'general_additional_comments_notations' => 'required|max:250',
            ]);
            if ($validator->fails()) {
              return $this->sendFailed($validator -> errors() -> first());
            }
            $siteSafetyInspectionData = new SiteSafetyInspection();
            $siteSafetyInspectionData->webFormId = 6;
            $siteSafetyInspectionData->project_reference = $request->project_reference;
            $siteSafetyInspectionData->location = $request->location;
            $siteSafetyInspectionData->area_inspected = $request->area_inspected;
            $siteSafetyInspectionData->inspected_by = $request->inspected_by;
            $siteSafetyInspectionData->date = $request->date;
            $siteSafetyInspectionData->site_document = $request->site_document;
            $siteSafetyInspectionData->site_document_comments = $request->site_document_comments;
            $siteSafetyInspectionData->site_signage = $request->site_signage;
            $siteSafetyInspectionData->site_signage_comments = $request->site_signage_comments;
            $siteSafetyInspectionData->safety_signs = $request->safety_signs;
            $siteSafetyInspectionData->safety_signs_comments = $request->safety_signs_comments;
            $siteSafetyInspectionData->mandatory_ppe = $request->mandatory_ppe;
            $siteSafetyInspectionData->mandatory_ppe_comments = $request->mandatory_ppe_comments;
            $siteSafetyInspectionData->policies = $request->policies;
            $siteSafetyInspectionData->policies_comments = $request->policies_comments;
            $siteSafetyInspectionData->site_rules = $request->site_rules;
            $siteSafetyInspectionData->site_rules_comments = $request->site_rules_comments;
            $siteSafetyInspectionData->emergency_information = $request->emergency_information;
            $siteSafetyInspectionData->emergency_information_comments = $request->emergency_information_comments;
            $siteSafetyInspectionData->first_aid_officers = $request->first_aid_officers;
            $siteSafetyInspectionData->first_aid_officers_comments = $request->first_aid_officers_comments;
            $siteSafetyInspectionData->sign_in = $request->sign_in;
            $siteSafetyInspectionData->sign_in_comments = $request->sign_in_comments;
            $siteSafetyInspectionData->site_security = $request->site_security;
            $siteSafetyInspectionData->site_security_comments = $request->site_security_comments;
            $siteSafetyInspectionData->site_fence = $request->site_fence;
            $siteSafetyInspectionData->site_fence_comments = $request->site_fence_comments;
            $siteSafetyInspectionData->appropriate_barricades = $request->appropriate_barricades;
            $siteSafetyInspectionData->appropriate_barricades_comments = $request->appropriate_barricades_comments;
            $siteSafetyInspectionData->site_access = $request->site_access;
            $siteSafetyInspectionData->site_access_comments = $request->site_access_comments;
            $siteSafetyInspectionData->public_access = $request->public_access;
            $siteSafetyInspectionData->public_access_comments = $request->public_access_comments;
            $siteSafetyInspectionData->safe_access = $request->safe_access;
            $siteSafetyInspectionData->safe_access_comments = $request->safe_access_comments;
            $siteSafetyInspectionData->site_processes = $request->site_processes;
            $siteSafetyInspectionData->site_processes_comments = $request->site_processes_comments;
            $siteSafetyInspectionData->all_workers_inducted_on_site = $request->all_workers_inducted_on_site;
            $siteSafetyInspectionData->all_workers_inducted_on_site_comments = $request->all_workers_inducted_on_site_comments;
            $siteSafetyInspectionData->workers_inducted_swms_sops = $request->workers_inducted_swms_sops;
            $siteSafetyInspectionData->workers_inducted_swms_sops_comments = $request->workers_inducted_swms_sops_comments;
            $siteSafetyInspectionData->workers_white_cards = $request->workers_white_cards;
            $siteSafetyInspectionData->workers_white_cards_comments = $request->workers_white_cards_comments;
            $siteSafetyInspectionData->workers_following_site_processes = $request->workers_following_site_processes;
            $siteSafetyInspectionData->workers_following_site_processes_comments = $request->workers_following_site_processes_comments;
            $siteSafetyInspectionData->daily_pre_start_meetings = $request->daily_pre_start_meetings;
            $siteSafetyInspectionData->daily_pre_start_meetings_comments = $request->daily_pre_start_meetings_comments;
            $siteSafetyInspectionData->toolbox_talks_regularly_conducted = $request->toolbox_talks_regularly_conducted;
            $siteSafetyInspectionData->toolbox_talks_regularly_conducted_comments = $request->toolbox_talks_regularly_conducted_comments;
            $siteSafetyInspectionData->housekeeping = $request->housekeeping;
            $siteSafetyInspectionData->housekeeping_comments = $request->housekeeping_comments;
            $siteSafetyInspectionData->site_generally_clean = $request->site_generally_clean;
            $siteSafetyInspectionData->site_generally_clean_comments = $request->site_generally_clean_comments;
            $siteSafetyInspectionData->walkways_clear_obstruction = $request->walkways_clear_obstruction;
            $siteSafetyInspectionData->walkways_clear_obstruction_comments = $request->walkways_clear_obstruction_comments;
            $siteSafetyInspectionData->materials_safely_stowed = $request->materials_safely_stowed;
            $siteSafetyInspectionData->materials_safely_stowed_comments = $request->materials_safely_stowed_comments;
            $siteSafetyInspectionData->rubbish_debris_disposed = $request->rubbish_debris_disposed;
            $siteSafetyInspectionData->rubbish_debris_disposed_comments = $request->rubbish_debris_disposed_comments;
            $siteSafetyInspectionData->slurry_water_dust_removed = $request->slurry_water_dust_removed;
            $siteSafetyInspectionData->slurry_water_dust_removed_comments = $request->slurry_water_dust_removed_comments;
            $siteSafetyInspectionData->amenities = $request->amenities;
            $siteSafetyInspectionData->amenities_comments = $request->amenities_comments;
            $siteSafetyInspectionData->sufficient_toilets_bubblers_provided = $request->sufficient_toilets_bubblers_provided;
            $siteSafetyInspectionData->sufficient_toilets_bubblers_provided_comments = $request->sufficient_toilets_bubblers_provided_comments;
            $siteSafetyInspectionData->lunchroom_facilities_provided = $request->lunchroom_facilities_provided;
            $siteSafetyInspectionData->lunchroom_facilities_provided_comments = $request->lunchroom_facilities_provided_comments;
            $siteSafetyInspectionData->amenities_clean_tidy = $request->amenities_clean_tidy;
            $siteSafetyInspectionData->amenities_clean_tidy_comments = $request->amenities_clean_tidy_comments;
            $siteSafetyInspectionData->electrical = $request->electrical;
            $siteSafetyInspectionData->electrical_comments = $request->electrical_comments;
            $siteSafetyInspectionData->temporary_power_boards_present = $request->temporary_power_boards_present;
            $siteSafetyInspectionData->temporary_power_boards_present_comments = $request->temporary_power_boards_present_comments;
            $siteSafetyInspectionData->temporary_power_boards_fitted_rcd = $request->temporary_power_boards_fitted_rcd;
            $siteSafetyInspectionData->temporary_power_boards_fitted_rcd_comments = $request->temporary_power_boards_fitted_rcd_comments;
            $siteSafetyInspectionData->temporary_power_board_secured_ground = $request->temporary_power_board_secured_ground;
            $siteSafetyInspectionData->temporary_power_board_secured_ground_comments = $request->temporary_power_board_secured_ground_comments;
            $siteSafetyInspectionData->temporary_power_board_compliant_AS_NZS = $request->temporary_power_board_compliant_AS_NZS;
            $siteSafetyInspectionData->temporary_power_board_compliant_AS_NZS_comments = $request->temporary_power_board_compliant_AS_NZS_comments;
            $siteSafetyInspectionData->electrical_equipment_current_test_tag = $request->electrical_equipment_current_test_tag;
            $siteSafetyInspectionData->electrical_equipment_current_test_tag_comments = $request->electrical_equipment_current_test_tag_comments;
            $siteSafetyInspectionData->electrical_equipment_connected_RCD = $request->electrical_equipment_connected_RCD;
            $siteSafetyInspectionData->electrical_equipment_connected_RCD_comments = $request->electrical_equipment_connected_RCD_comments;
            $siteSafetyInspectionData->extension_leads_current_test_tag = $request->extension_leads_current_test_tag;
            $siteSafetyInspectionData->extension_leads_current_test_tag_comments = $request->extension_leads_current_test_tag_comments;
            $siteSafetyInspectionData->electrical_leads_elevated_ground_lead_stands = $request->electrical_leads_elevated_ground_lead_stands;
            $siteSafetyInspectionData->electrical_leads_elevated_ground_lead_stands_comments = $request->electrical_leads_elevated_ground_lead_stands_comments;
            $siteSafetyInspectionData->electrical_equipment_leads_good_condition = $request->electrical_equipment_leads_good_condition;
            $siteSafetyInspectionData->electrical_equipment_leads_good_condition_comments = $request->electrical_equipment_leads_good_condition_comments;
            $siteSafetyInspectionData->working_heights = $request->working_heights;
            $siteSafetyInspectionData->working_heights_comments = $request->working_heights_comments;
            $siteSafetyInspectionData->all_falls_2m_protected = $request->all_falls_2m_protected;
            $siteSafetyInspectionData->all_falls_2m_protected_comments = $request->all_falls_2m_protected_comments;
            $siteSafetyInspectionData->temporary_edge_protection = $request->temporary_edge_protection;
            $siteSafetyInspectionData->temporary_edge_protection_comments = $request->temporary_edge_protection_comments;
            $siteSafetyInspectionData->extension_ladders_secured = $request->extension_ladders_secured;
            $siteSafetyInspectionData->extension_ladders_secured_comments = $request->extension_ladders_secured_comments;
            $siteSafetyInspectionData->height_safety_equipment = $request->height_safety_equipment;
            $siteSafetyInspectionData->height_safety_equipment_comments = $request->height_safety_equipment_comments;
            $siteSafetyInspectionData->penetrations_voids = $request->penetrations_voids;
            $siteSafetyInspectionData->penetrations_voids_comments = $request->penetrations_voids_comments;
            $siteSafetyInspectionData->penetration_covers_mechanically = $request->penetration_covers_mechanically;
            $siteSafetyInspectionData->penetration_covers_mechanically_comments = $request->penetration_covers_mechanically_comments;
            $siteSafetyInspectionData->necessary_cast_mesh = $request->necessary_cast_mesh;
            $siteSafetyInspectionData->necessary_cast_mesh_comment = $request->necessary_cast_mesh_comment;
            $siteSafetyInspectionData->lift_shafts = $request->lift_shafts;
            $siteSafetyInspectionData->lift_shafts_comments = $request->lift_shafts_comments;
            $siteSafetyInspectionData->guards_place_stair_voids = $request->guards_place_stair_voids;
            $siteSafetyInspectionData->guards_place_stair_voids_comments = $request->guards_place_stair_voids_comments;
            $siteSafetyInspectionData->areas_delineated = $request->areas_delineated;
            $siteSafetyInspectionData->areas_delineated_comments = $request->areas_delineated_comments;
            $siteSafetyInspectionData->materials_fall_protection = $request->materials_fall_protection;
            $siteSafetyInspectionData->materials_fall_protection_comments = $request->materials_fall_protection_comments;
            $siteSafetyInspectionData->netting_covers_perimeter_scaffolding = $request->netting_covers_perimeter_scaffolding;
            $siteSafetyInspectionData->netting_covers_perimeter_scaffolding_comments = $request->netting_covers_perimeter_scaffolding_comments;
            $siteSafetyInspectionData->toe_boards_installed_all_guard_rails = $request->toe_boards_installed_all_guard_rails;
            $siteSafetyInspectionData->toe_boards_installed_all_guard_rails_comments = $request->toe_boards_installed_all_guard_rails_comments;
            $siteSafetyInspectionData->core_holes = $request->core_holes;
            $siteSafetyInspectionData->core_holes_comments = $request->core_holes_comments;
            $siteSafetyInspectionData->scaffolds = $request->scaffolds;
            $siteSafetyInspectionData->scaffolds_comments = $request->scaffolds_comments;
            $siteSafetyInspectionData->scaffold_current_test_tag_entry_points = $request->scaffold_current_test_tag_entry_points;
            $siteSafetyInspectionData->scaffold_current_test_tag_entry_points_comments = $request->scaffold_current_test_tag_entry_points_comments;
            $siteSafetyInspectionData->handover_certificate_available = $request->handover_certificate_available;
            $siteSafetyInspectionData->handover_certificate_available_comments = $request->handover_certificate_available_comments;
            $siteSafetyInspectionData->adequately_braced = $request->adequately_braced;
            $siteSafetyInspectionData->adequately_braced_comments = $request->adequately_braced_comments;
            $siteSafetyInspectionData->scaffold_working_face_exceed_225mm = $request->scaffold_working_face_exceed_225mm;
            $siteSafetyInspectionData->scaffold_working_face_exceed_225mm_comments	 = $request->scaffold_working_face_exceed_225mm_comments	;
            $siteSafetyInspectionData->all_scaffold_components_intact = $request->all_scaffold_components_intact;
            $siteSafetyInspectionData->all_scaffold_components_intact_comments = $request->all_scaffold_components_intact_comments;
            $siteSafetyInspectionData->access_ladders = $request->access_ladders;
            $siteSafetyInspectionData->access_ladders_comments = $request->access_ladders_comments;
            $siteSafetyInspectionData->bays_free_obstruction = $request->bays_free_obstruction;
            $siteSafetyInspectionData->bays_free_obstruction_comments = $request->bays_free_obstruction_comments;
            $siteSafetyInspectionData->minimum_450mm_wide_gap = $request->minimum_450mm_wide_gap;
            $siteSafetyInspectionData->minimum_450mm_wide_gap_comments = $request->minimum_450mm_wide_gap_comments;
            $siteSafetyInspectionData->Bays_not_point_loaded = $request->Bays_not_point_loaded;
            $siteSafetyInspectionData->Bays_not_point_loaded_comments	 = $request->Bays_not_point_loaded_comments	;
            $siteSafetyInspectionData->bays_being_overloaded = $request->bays_being_overloaded;
            $siteSafetyInspectionData->bays_being_overloaded_comments = $request->bays_being_overloaded_comments;
            $siteSafetyInspectionData->no_missing_scaffold_planks = $request->no_missing_scaffold_planks;
            $siteSafetyInspectionData->no_missing_scaffold_planks_comments = $request->no_missing_scaffold_planks_comments;
            $siteSafetyInspectionData->sole_plates_founded_solid_base = $request->sole_plates_founded_solid_base;
            $siteSafetyInspectionData->sole_plates_founded_solid_base_comments = $request->sole_plates_founded_solid_base_comments;
            $siteSafetyInspectionData->lapboards_mechanically_secured = $request->lapboards_mechanically_secured;
            $siteSafetyInspectionData->lapboards_mechanically_secured_comments = $request->lapboards_mechanically_secured_comments;
            $siteSafetyInspectionData->incomplete_scaffold_barricaded_closed = $request->incomplete_scaffold_barricaded_closed;
            $siteSafetyInspectionData->incomplete_scaffold_barricaded_closed_comments = $request->incomplete_scaffold_barricaded_closed_comments;
            $siteSafetyInspectionData->ppe = $request->ppe;
            $siteSafetyInspectionData->ppe_comments = $request->ppe_comments;
            $siteSafetyInspectionData->workers_wearing_mandatory_ppe = $request->workers_wearing_mandatory_ppe;
            $siteSafetyInspectionData->workers_wearing_mandatory_ppe_comments = $request->workers_wearing_mandatory_ppe_comments;
            $siteSafetyInspectionData->workers_observed_ppe_correctly_tasks = $request->workers_observed_ppe_correctly_tasks;
            $siteSafetyInspectionData->workers_observed_ppe_correctly_tasks_comments = $request->workers_observed_ppe_correctly_tasks_comments;
            $siteSafetyInspectionData->ppe_complies_regulatory_requirements = $request->ppe_complies_regulatory_requirements;
            $siteSafetyInspectionData->ppe_complies_regulatory_requirements_comments = $request->ppe_complies_regulatory_requirements_comments;
            $siteSafetyInspectionData->ladders = $request->ladders;
            $siteSafetyInspectionData->ladders_comments = $request->ladders_comments;
            $siteSafetyInspectionData->industrial_strength_ladder = $request->industrial_strength_ladder;
            $siteSafetyInspectionData->industrial_strength_ladder_comments = $request->industrial_strength_ladder_comments;
            $siteSafetyInspectionData->ladders_good_condition = $request->ladders_good_condition;
            $siteSafetyInspectionData->ladders_good_condition_comments = $request->ladders_good_condition_comments;
            $siteSafetyInspectionData->safety_labels_intact = $request->safety_labels_intact;
            $siteSafetyInspectionData->safety_labels_intact_comments = $request->safety_labels_intact_comments;
            $siteSafetyInspectionData->extension_adders_secured_top_bottom = $request->extension_adders_secured_top_bottom;
            $siteSafetyInspectionData->extension_adders_secured_top_bottom_comments = $request->extension_adders_secured_top_bottom_comments;
            $siteSafetyInspectionData->extension_ladders_extend_1m_past_top_landing = $request->extension_ladders_extend_1m_past_top_landing;
            $siteSafetyInspectionData->extension_ladders_extend_1m_past_top_landing_comments = $request->extension_ladders_extend_1m_past_top_landing_comments;
            $siteSafetyInspectionData->extension_ladders_placed_correct_angle_1_4 = $request->extension_ladders_placed_correct_angle_1_4;
            $siteSafetyInspectionData->extension_ladders_placed_correct_angle_1_4_comments = $request->extension_ladders_placed_correct_angle_1_4_comments;
            $siteSafetyInspectionData->ladders_not_used_scaffold = $request->ladders_not_used_scaffold;
            $siteSafetyInspectionData->ladders_not_used_scaffold_comments = $request->ladders_not_used_scaffold_comments;
            $siteSafetyInspectionData->ladders_not_used_entrance_ways = $request->ladders_not_used_entrance_ways;
            $siteSafetyInspectionData->ladders_not_used_entrance_ways_comments = $request->ladders_not_used_entrance_ways_comments;
            $siteSafetyInspectionData->trenches_xcavations = $request->trenches_xcavations;
            $siteSafetyInspectionData->trenches_xcavations_comments = $request->trenches_xcavations_comments;
            $siteSafetyInspectionData->DBYD_been_obtained_before_work = $request->DBYD_been_obtained_before_work;
            $siteSafetyInspectionData->DBYD_been_obtained_before_work_comments = $request->DBYD_been_obtained_before_work_comments;
            $siteSafetyInspectionData->services_have_been_located_potholed = $request->services_have_been_located_potholed;
            $siteSafetyInspectionData->services_have_been_located_potholed_comments = $request->services_have_been_located_potholed_comments;
            $siteSafetyInspectionData->excavations_trenches_barricaded_sign_posted = $request->excavations_trenches_barricaded_sign_posted;
            $siteSafetyInspectionData->excavations_trenches_barricaded_sign_posted_comments = $request->excavations_trenches_barricaded_sign_posted_comments;
            $siteSafetyInspectionData->correct_trench_support_used_where_necessary = $request->correct_trench_support_used_where_necessary;
            $siteSafetyInspectionData->correct_trench_support_used_where_necessary_comments = $request->correct_trench_support_used_where_necessary_comments;
            $siteSafetyInspectionData->trenches_greater_than_1_5m_have_edge_protection = $request->trenches_greater_than_1_5m_have_edge_protection;
            $siteSafetyInspectionData->trenches_greater_than_1_5m_have_edge_protection_comments = $request->trenches_greater_than_1_5m_have_edge_protection_comments;
            $siteSafetyInspectionData->edges_excavations = $request->edges_excavations;
            $siteSafetyInspectionData->edges_excavations_comments = $request->edges_excavations_comments;
            $siteSafetyInspectionData->hazardous_substances = $request->hazardous_substances;
            $siteSafetyInspectionData->hazardous_substances_comments = $request->hazardous_substances_comments;
            $siteSafetyInspectionData->register_kept_on_site_and_up_to_date = $request->register_kept_on_site_and_up_to_date;
            $siteSafetyInspectionData->register_kept_on_site_and_up_to_date_comments = $request->register_kept_on_site_and_up_to_date_comments;
            $siteSafetyInspectionData->SDS_available_hazardous_substances = $request->SDS_available_hazardous_substances;
            $siteSafetyInspectionData->SDS_available_hazardous_substances_comments = $request->SDS_available_hazardous_substances_comments;
            $siteSafetyInspectionData->appropriate_signage_displayed = $request->appropriate_signage_displayed;
            $siteSafetyInspectionData->appropriate_signage_displayed_comments = $request->appropriate_signage_displayed_comments;
            $siteSafetyInspectionData->adequately_stored_ventilated = $request->adequately_stored_ventilated;
            $siteSafetyInspectionData->adequately_stored_ventilated_comments = $request->adequately_stored_ventilated_comments;
            $siteSafetyInspectionData->kept_original_containers_with_labels = $request->kept_original_containers_with_labels;
            $siteSafetyInspectionData->kept_original_containers_with_labels_comments = $request->kept_original_containers_with_labels_comments;
            $siteSafetyInspectionData->spill_kit_available_site = $request->spill_kit_available_site;
            $siteSafetyInspectionData->spill_kit_available_site_comments = $request->spill_kit_available_site_comments;
            $siteSafetyInspectionData->emergency_first_aid = $request->emergency_first_aid;
            $siteSafetyInspectionData->emergency_first_aid_comments = $request->emergency_first_aid_comments;
            $siteSafetyInspectionData->emergency_access_kept_all_times = $request->emergency_access_kept_all_times;
            $siteSafetyInspectionData->emergency_access_kept_all_times_comments = $request->emergency_access_kept_all_times_comments;
            $siteSafetyInspectionData->emergency_exit_points_clearly_marked = $request->emergency_exit_points_clearly_marked;
            $siteSafetyInspectionData->emergency_exit_points_clearly_marked_comments = $request->emergency_exit_points_clearly_marked_comments;
            $siteSafetyInspectionData->emergency_evacuation_plan_displayed = $request->emergency_evacuation_plan_displayed;
            $siteSafetyInspectionData->emergency_evacuation_plan_displayed_comments = $request->emergency_evacuation_plan_displayed_comments;
            $siteSafetyInspectionData->emergency_assembly_point_displayed = $request->emergency_assembly_point_displayed;
            $siteSafetyInspectionData->emergency_assembly_point_displayed_comments = $request->emergency_assembly_point_displayed_comments;
            $siteSafetyInspectionData->emergency_contact_details_displayed = $request->emergency_contact_details_displayed;
            $siteSafetyInspectionData->emergency_contact_details_displayed_comments = $request->emergency_contact_details_displayed_comments;
            $siteSafetyInspectionData->adequate_firefighting_equipment_available = $request->adequate_firefighting_equipment_available;
            $siteSafetyInspectionData->adequate_firefighting_equipment_available_comments = $request->adequate_firefighting_equipment_available_comments;
            $siteSafetyInspectionData->firefighting_equipment_current_test_tag = $request->firefighting_equipment_current_test_tag;
            $siteSafetyInspectionData->firefighting_equipment_current_test_tag_comments = $request->firefighting_equipment_current_test_tag_comments;
            $siteSafetyInspectionData->first_aid_officer_contact_displayed = $request->first_aid_officer_contact_displayed;
            $siteSafetyInspectionData->first_aid_officer_contact_displayed_comments = $request->first_aid_officer_contact_displayed_comments;
            $siteSafetyInspectionData->first_aid_signage_displayed = $request->first_aid_signage_displayed;
            $siteSafetyInspectionData->first_aid_signage_displayed_comments = $request->first_aid_signage_displayed_comments;
            $siteSafetyInspectionData->first_aid_kit_fully_stocked = $request->first_aid_kit_fully_stocked;
            $siteSafetyInspectionData->first_aid_kit_fully_stocked_comments = $request->first_aid_kit_fully_stocked_comments;
            $siteSafetyInspectionData->first_aid_emergency_personnel_trained = $request->first_aid_emergency_personnel_trained;
            $siteSafetyInspectionData->first_aid_emergency_personnel_trained_comments = $request->first_aid_emergency_personnel_trained_comments;
            $siteSafetyInspectionData->injury_register_maintained_site = $request->injury_register_maintained_site;
            $siteSafetyInspectionData->injury_register_maintained_site_comments = $request->injury_register_maintained_site_comments;
            $siteSafetyInspectionData->hot_works_approved_adequately_controls = $request->hot_works_approved_adequately_controls;
            $siteSafetyInspectionData->hot_works_approved_adequately_controls_comments = $request->hot_works_approved_adequately_controls_comments;
            $siteSafetyInspectionData->cranes = $request->cranes;
            $siteSafetyInspectionData->cranes_comments = $request->cranes_comments;
            $siteSafetyInspectionData->certificate_registration_available = $request->certificate_registration_available;
            $siteSafetyInspectionData->certificate_registration_available_comments = $request->certificate_registration_available_comments;
            $siteSafetyInspectionData->insurances_available = $request->insurances_available;
            $siteSafetyInspectionData->insurances_available_comments = $request->insurances_available_comments;
            $siteSafetyInspectionData->maintenance_service_records_available_and_up_to_date = $request->maintenance_service_records_available_and_up_to_date;
            $siteSafetyInspectionData->maintenance_service_records_available_and_up_to_date_comments = $request->maintenance_service_records_available_and_up_to_date_comments;
            $siteSafetyInspectionData->pre_start_inspection_being_completed = $request->pre_start_inspection_being_completed;
            $siteSafetyInspectionData->pre_start_inspection_being_completed_comments = $request->pre_start_inspection_being_completed_comments;
            $siteSafetyInspectionData->crane_crew_hold_appropriate_licences = $request->crane_crew_hold_appropriate_licences;
            $siteSafetyInspectionData->crane_crew_hold_appropriate_licences_comments = $request->crane_crew_hold_appropriate_licences_comments;
            $siteSafetyInspectionData->exclusion_being_used_during_movement_loads = $request->exclusion_being_used_during_movement_loads;
            $siteSafetyInspectionData->exclusion_being_used_during_movement_loads_comments = $request->exclusion_being_used_during_movement_loads_comments;
            $siteSafetyInspectionData->emergency_response_measures_place = $request->emergency_response_measures_place;
            $siteSafetyInspectionData->emergency_response_measures_place_comments = $request->emergency_response_measures_place_comments;
            $siteSafetyInspectionData->mobile_plant = $request->mobile_plant;
            $siteSafetyInspectionData->mobile_plant_comments = $request->mobile_plant_comments;
            $siteSafetyInspectionData->certificate_registration_available1 = $request->certificate_registration_available1;
            $siteSafetyInspectionData->certificate_registration_available_comments1 = $request->certificate_registration_available_comments1;
            $siteSafetyInspectionData->insurances_available1 = $request->insurances_available1;
            $siteSafetyInspectionData->insurances_available_comments1 = $request->insurances_available_comments1;
            $siteSafetyInspectionData->maintenance_service_records_available_and_up_to_date1 = $request->maintenance_service_records_available_and_up_to_date1;
            $siteSafetyInspectionData->maintenance_service_records_available_and_up_to_date_comments1 = $request->maintenance_service_records_available_and_up_to_date_comments1;
            $siteSafetyInspectionData->operators_hold_appropriate_licences = $request->operators_hold_appropriate_licences;
            $siteSafetyInspectionData->operators_hold_appropriate_licences_comments = $request->operators_hold_appropriate_licences_comments;
            $siteSafetyInspectionData->exclusion_being_used_where_necessary = $request->exclusion_being_used_where_necessary;
            $siteSafetyInspectionData->exclusion_being_used_where_necessary_comments = $request->exclusion_being_used_where_necessary_comments;
            $siteSafetyInspectionData->emergency_response_measures_place1 = $request->emergency_response_measures_place1;
            $siteSafetyInspectionData->emergency_response_measures_place_comments1 = $request->emergency_response_measures_place_comments1;
            $siteSafetyInspectionData->lifting_equipment = $request->lifting_equipment;
            $siteSafetyInspectionData->lifting_equipment_comments = $request->lifting_equipment_comments;
            $siteSafetyInspectionData->register_available_maintained_site = $request->register_available_maintained_site;
            $siteSafetyInspectionData->register_available_maintained_site_comments = $request->register_available_maintained_site_comments;
            $siteSafetyInspectionData->equipment_has_current_test_tag = $request->equipment_has_current_test_tag;
            $siteSafetyInspectionData->equipment_has_current_test_tag_comments = $request->equipment_has_current_test_tag_comments;
            $siteSafetyInspectionData->equipment_correctly_stored = $request->equipment_correctly_stored;
            $siteSafetyInspectionData->equipment_correctly_stored_comments = $request->equipment_correctly_stored_comments;
            $siteSafetyInspectionData->equipment_inspected_before_use = $request->equipment_inspected_before_use;
            $siteSafetyInspectionData->equipment_inspected_before_use_comments = $request->equipment_inspected_before_use_comments;
            $siteSafetyInspectionData->traffic_control = $request->traffic_control;
            $siteSafetyInspectionData->traffic_control_comments = $request->traffic_control_comments;
            $siteSafetyInspectionData->traffic_management = $request->traffic_management;
            $siteSafetyInspectionData->traffic_management_comments = $request->traffic_management_comments;
            $siteSafetyInspectionData->fencing_barriers_to_stop_public_access_to_site = $request->fencing_barriers_to_stop_public_access_to_site;
            $siteSafetyInspectionData->fencing_barriers_to_stop_public_access_to_site_comments = $request->fencing_barriers_to_stop_public_access_to_site_comments;
            $siteSafetyInspectionData->public_areas_kept_clear_of_materials = $request->public_areas_kept_clear_of_materials;
            $siteSafetyInspectionData->public_areas_kept_clear_of_materials_comments = $request->public_areas_kept_clear_of_materials_comments;
            $siteSafetyInspectionData->traffic_controllers_certified = $request->traffic_controllers_certified;
            $siteSafetyInspectionData->traffic_controllers_certified_comments = $request->traffic_controllers_certified_comments;
            $siteSafetyInspectionData->signs_and_devices_in_use = $request->signs_and_devices_in_use;
            $siteSafetyInspectionData->signs_and_devices_in_use_comments = $request->signs_and_devices_in_use_comments;
            $siteSafetyInspectionData->general_additional_comments_notations = $request->general_additional_comments_notations;
            if($siteSafetyInspectionData->save()){
              return $this->sendSuccess('Submitted Successfully');
            } else {
              return $this -> sendFailed('Something Went wrong. Please Try again.');
            }
        }
        //end Function
        
        
        public function preStartRecordSave(Request $request) {
            $validator = Validator:: make($request -> all(), [
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
            ]);
            if ($validator->fails()) {
              return $this->sendFailed($validator -> errors() -> first());
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
            return $this->sendSuccess('Submitted Successfully');
            } else {
              return $this -> sendFailed('Something Went wrong. Please Try again.');
            }
        }
        
        //Start Function
        public function toolBoxTalkRecordSave(Request $request) {
            $validator = Validator:: make($request -> all(), [
                'project' => 'required',
                'tollbox_talk_record_date' => 'required',
                'conducted_by' => 'required',
                'site_topic' => 'required',
                'discussion' => 'required'
            ]);
            if ($validator->fails()) {
              return $this->sendFailed($validator -> errors() -> first());
            }
            $toolboxRecords = new ToolBoxTalkRecords();
            $toolboxRecords['webFormId'] = 7;
            $toolboxRecords['project'] = $request->project;
            $toolboxRecords['tollbox_talk_record_date'] = $request->tollbox_talk_record_date;
            $toolboxRecords['conducted_by'] = $request->conducted_by;
            $toolboxRecords['site_topic'] = $request->site_topic;
            $toolboxRecords['discussion']  = $request->discussion;
            if($toolboxRecords->save()){
                $actionDescriptionArray = $request->actionDescription;
                $actionResponsibleArray = $request->actionResponsible;
                $actionDueDateArray = $request->actionDueDate;
                for ($i = 0; $i < count($actionDescriptionArray); $i++) {
                    $actionDescval = $actionDescriptionArray[$i];
                    $actionResponsibalval = $actionResponsibleArray[$i];
                    $actionDueDateval = $actionDueDateArray[$i];
                    $toolBoxTalkAction = new ToolBoxTalkAction();
                    $toolBoxTalkAction['tool_box_talk_record_id'] = $toolboxRecords->id;
                    $toolBoxTalkAction['actionDescription'] = $actionDescval;
                    $toolBoxTalkAction['actionResponsible'] = $actionResponsibalval;
                    $toolBoxTalkAction['actionDueDate'] = $actionDueDateval;
                    $toolBoxTalkAction->save();
                }
            return $this->sendSuccess('Submitted Successfully');
            } else {
              return $this -> sendFailed('Something Went wrong. Please Try again.');
            }
        }
        
        public function inspectionTestPlanRecordSave(Request $request) {
            $validator = Validator:: make($request -> all(), [
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
            ]);
            if ($validator->fails()) {
              return $this->sendFailed($validator -> errors() -> first());
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
            return $this->sendSuccess('Submitted Successfully');
            } else {
              return $this -> sendFailed('Something Went wrong. Please Try again.');
            }
        }

        public function supplierContractorCarSave(Request $request) {
            $validator = Validator:: make($request -> all(), [
                'project' => 'required',
                'location' => 'required',
                'supplier' => 'required',
                'issued_by' => 'required',
                'supply_contractor_car_date' => 'required',
                'satisfactory' => 'required'
            ]);
            if ($validator->fails()) {
              return $this->sendFailed($validator -> errors() -> first());
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
            return $this->sendSuccess('Submitted Successfully');
            } else {
              return $this -> sendFailed('Something Went wrong. Please Try again.');
            }
        }

        
        

}




