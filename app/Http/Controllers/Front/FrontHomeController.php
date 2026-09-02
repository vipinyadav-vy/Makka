<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Validator;
use Illuminate\Support\Facades\Mail;
use Hash;
use App\Models\WebForm;
use App\Models\Projects;
use App\Models\SiteInductionRecord;
use App\Models\SiteSafetyInspection;
use App\Models\ToolBoxTalkRecords;
use App\Models\ToolBoxTalkAction;
use App\Models\ToolBoxTalkAttendance;
use App\Models\PreStartMeeting;
use App\Models\PreMeetingTopics;
use App\Models\PreMeetingCorrective;
use App\Models\PreMeetingAttendance;
use App\Models\InspectionTestPlan;
use App\Models\InspectionTrade;
use App\Models\InspectionRepresentative;
use App\Models\SupplierContractorEvalution;
use App\Models\SupplierContractorCar;
use App\Models\SupplierContractorCarProblem;
use App\Models\SupplierContractorCarCorrective;
use App\Models\PreStartChecklist;
use PDF;
use App\Mail\SiteInductionRecordMail;
use Illuminate\Support\Facades\Storage;

class FrontHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {  
        $webForm = WebForm::where('status',1)->where('public_form',1)->orderBy('id','ASC')->get();
        return view('front.index', compact('webForm'));
    }

    public function webforms($slug = null)
    {
        if(empty($slug)){
            return redirect('/')->with('failed', 'Something went wrong. Please try again');
        } else { 
            $webForm = WebForm::where('slug',$slug)->where('status',1)->where('public_form',1)->first();

            $projects = Projects::where('status',1)->get();


            if(!empty($webForm)){
                
                if (view()->exists('front.webforms.' . $webForm->slug)) {
                    return view('front.webforms.' . $webForm->slug, compact('webForm', 'projects'));
                } else {
                    return redirect('/')->with('failed', 'Something went wrong. Please try again');
                }
            }else{
                return redirect('/')->with('failed', 'Something went wrong. Please try again');
            }
        }
        return view('front.index');
    }

    public function siteSafetyInspectionget($id = null)
    {
        $data = SiteSafetyInspection::where('id', $id)->first();

            $pdf = PDF::loadView('superadmin.webforms.siteSafetyInspectionPdf', compact('data'));

            return $pdf->stream('whateveryourviewname.pdf');

            // $savePath = public_path('webformInvoice'); // Change 'pdfs' to your desired folder name
            // if (!file_exists($savePath)) {
            //     mkdir($savePath, 0755, true);
            // }
            // $attachmentPath = $savePath . '/' . 'site_safety_inspection_' . $data->id . '.pdf';
            // $pdf->save($attachmentPath);
            // $ccmail = $formData->ccMail;
            // Mail::to($formData->toMail)->send(new SiteInductionRecordMail($data, $attachmentPath, $ccmail));
            // unlink($attachmentPath); // Delete the file

       
            // echo "ok";
            // exit;
       
    }


    public function siteInductionRecordSave(Request $request)
    {   
        $formData = WebForm::find($request->formId);
        if(!$formData){
            return redirect()->back()->with('error', 'Somthing went wrong.');
        }

        $validate = Validator::make($request->all(), [
            'project' => 'required|max:250',
            'inductionNumber' => 'required|max:250',
            'workerName' => 'required|max:250',
            'workerAddress' => 'required|max:500',
            'phone_no' => 'required|max:10',
            'identityType' => 'required|max:250',
            'identityNo' => 'required|max:250',
            'identityDocument' => 'required', 
            'inductionCardNo' => 'required|max:250',
            'occupation' => 'required|max:250',
            'qualification' => 'required|max:250',
            'citizen' => 'required',
            'employerName' => 'required|max:250',
            'abnNumber' => 'required|max:250',
            'employerrepresentative' => 'required|max:250',
            'employerPhone' => 'required|max:10',
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
            'inducteeName' => 'required|max:250',
            'inducteeSignature' => 'required',
            'applyDate' => 'required',
        ], [
            'project.required' => 'project is required',
            'inductionNumber.required' => 'Induction Number is required',
            'workerName.required' => 'Worker Name is required',
            'workerAddress.required' => 'Worker Address is required',
            'phone_no.required' => 'Worker phone no. is required',
            'identityType.required' => 'Identity is required',
            'identityNo.required' => 'Identity is required',
            'identityDocument.required' => 'Identity document is required.',
            'inductionCardNo.required' => 'Induction Card No. is required',
            'occupation.required' => 'Occupation is required',
            'qualification.required' => 'Qualification is required',
            'citizen.required' => 'Citizen is required',
            'employerName.required' => 'Employer Name is required',
            'abnNumber.required' => 'ABN Number is required',
            'employerrepresentative.required' => 'Employer Representative is required',
            'employerPhone.required' => 'Employer Phone no is required',
            'siteManagement.required' => 'Site Management is required',
            'siteHours.required' => 'Site Hours is required',
            'siteSafety.required' => 'Site Safety is required',
            'minimumPpe.required' => 'Minimum PPE is required',
            'whsManagementPlan.required' => 'WHS Management Plan is required',
            'healthSafetyRepresentatives.required' => 'Health Safety Representatives is required',
            'workerDuties.required' => 'Worker Duties is required',
            'firstAid.required' => 'First Aid is required',
            'emergencyResponse.required' => 'Emergency Response is required',
            'emergencyEvacuation.required' => 'Emergency Evacuation is required',
            'trafficManagement.required' => 'Traffic Management is required',
            'exclusiveZones.required' => 'Exclusive Zones is required',
            'mobilePlant.required' => 'Mobile Plant is required',
            'scaffoldSafety.required' => 'Scaffold Safety isrequired',
            'siteAmenities.required' => 'Site Amenities is required',
            'siteAccess.required' => 'Site Access is required',
            'dailySign.required' => 'Daily Signature is required',
            'siteNoticeboard.required' => 'Site Notice board is required',
            'siteNoSmoking.required' => 'Site No Smoking is required',
            'siteDrug.required' => 'Site Drug is required',
            'siteViolence.required' => 'Site Violence is required',
            'hazardIncidentReport.required' => 'Hazard Incident Report is required',
            'stopWorkPolicy.required' => 'Stop Work Policy is required',
            'swmsSafety.required' => 'SWMS Safety is required',
            'housekeepingPolicy.required' => 'House keeping Policy is required',
            'electricSafety.required' => 'Electric Safety is required',
            'nonCompliance.required' => 'Non Compliance is required',
            'safeWorkMethodConfirmation.required' => 'Safe Work Method Confirmation is required',
            'skillsConfirmation.required' => 'Skills Confirmation is required',
            'englishConfirmation.required' => 'English Confirmation is required',
            'inducteeName.required' => 'Inductee Name is required',
            'inducteeSignature.required' => 'Inductee Signature is required',
            'applyDate.required' => 'Apply Date is required',
        ]);
        
        if ($validate->fails()) {
            return back()->withErrors($validate->errors())->withInput();
        }
        $siteInductionRecord = new SiteInductionRecord();
        $siteInductionRecord->webFormId =  $request->formId;
        $siteInductionRecord->project = $request->project;
        $siteInductionRecord->inductionNumber = $request->inductionNumber;
        $siteInductionRecord->workerName = $request->workerName;
        $siteInductionRecord->workerAddress = $request->workerAddress;
        $siteInductionRecord->phone_no = $request->phone_no;
        if( $request->identityType == 'Others'){
            $siteInductionRecord->identityType = $request->otherIdentityType;
        }else{
            $siteInductionRecord->identityType = $request->identityType;
        }
        $siteInductionRecord->identityNo = $request->identityNo;
        
        try {
            if ($request->input('identityDocument')) {
                $stored = store_base64_upload(
                    $request->input('identityDocument'),
                    public_path('images/identities'),
                    '/public/images/identities',
                    ['jpg', 'jpeg', 'png', 'pdf']
                );
                if ($stored) {
                    $siteInductionRecord->identityDocument = $stored['public'];
                }
            }
        } catch (\Exception $e) {
            // Log the error or handle it appropriately
            return redirect()->back()->withErrors('error', 'Error uploading the file.');
        }
        $siteInductionRecord->inductionCardNo = $request->inductionCardNo;
        $siteInductionRecord->occupation = $request->occupation;
        $siteInductionRecord->qualification = $request->qualification;
        $siteInductionRecord->citizen = $request->citizen;
        if($request->citizen == 0){
            $siteInductionRecord->workType = $request->workType;
        }
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
            
            
            $querySiteInduction = SiteInductionRecord::query();
        $querySiteInduction->select('site_induction_record.*', 'projects.name as projectname', 'projects.id as projectId')
            ->join('projects', 'projects.id', '=', 'site_induction_record.project')
            ->orderBy('site_induction_record.id', 'DESC')
            ->where('site_induction_record.id',$siteInductionRecord->id);
        $data = $querySiteInduction->first();
            
            /////
            // Load the PDF view
        $pdf = PDF::loadView('superadmin.webforms.siteInductionRecordPdf', compact('data'));
        
        // Define the path where you want to save the PDF
        $savePath = public_path('webformInvoice'); // Change 'pdfs' to your desired folder name

        // Make sure the folder exists, create it if not
        if (!file_exists($savePath)) {
            mkdir($savePath, 0755, true);
        }
        // Save the PDF to the specified path
        $attachmentPath = $savePath . '/' . 'site_induction_record_' . $siteInductionRecord->id . '.pdf';
        $pdf->save($attachmentPath);
        $ccmail = $formData->ccMail;
        Mail::to($formData->toMail)->send(new SiteInductionRecordMail($data, $attachmentPath, $ccmail));
            unlink($attachmentPath); // Delete the file
            return redirect('/')->with('success','Site Induction Record Submitted.');
        } else {
            return redirect()->back()->with('failed','Something went wrong. Please try again.');
        }
    }


    public function siteSafetyInspectionSave(Request $request)
    {
        $formData = WebForm::find($request->formId);
        if(!$formData){
            return redirect()->back()->with('error', 'Somthing went wrong.');
        }

        $validate = Validator::make($request->all(), [
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
        ], [
            'project_reference.required' => 'Project Reference is required',
            'location.required' => 'Location is required',
            'area_inspected.required' => 'Area Inspected By is required',
            'inspected_by.required' => 'Inspected By is required',
            'date.required' => 'Date is required',
            'site_document.required' => 'Site Document is required',
            'site_document_comments.required' => 'Site Document Comment is required',
            'site_signage.required' => 'Site Signage is required',
            'site_signage_comments.required' => 'Induction Card No. is required',
            'safety_signs.required' => 'Safety Signs is required',
            'safety_signs_comments.required' => 'Safety Signs Comment is required',
            'mandatory_ppe.required' => 'Mandatory PPE is required',
            'mandatory_ppe_comments.required' => 'Mandatory PPE comments Name is required',
            'policies.required' => 'Policies is required',
            'policies_comments.required' => 'Policies Comments is required',
            'site_rules.required' => 'Site Rules is required',
            'site_rules_comments.required' => 'Site Rules Comments is required',
            'emergency_information.required' => 'Emergency Information is required',
            'emergency_information_comments.required' => 'Emergency Information Comments is required',
            'first_aid_officers.required' => 'First Aid Officers is required',
            'first_aid_officers_comments.required' => 'First Aid Officers Comments is required',
            'sign_in.required' => 'Sign In is required',
            'sign_in_comments.required' => 'Sign In Comments is required',
            'site_security.required' => 'Site Security is required',
            'site_security_comments.required' => 'Site Security Comments is required',
            'site_fence.required' => 'Site Fence is required',
            'site_fence_comments.required' => 'Site Fence Comments is required',
            'appropriate_barricades.required' => 'Appropriate Barricades is required',
            'appropriate_barricades_comments.required' => 'Appropriate Barricades Comments is required',
            'site_access.required' => 'Site Access is required',
            'site_access_comments.required' => 'Site Access Cpmments is required',
            'public_access.required' => 'Public Access is required',
            'public_access_comments.required' => 'Public Access Comments is required',
            'safe_access.required' => 'Safe Access is required',
            'safe_access_comments.required' => 'Safe Access Comments is required',
            'site_processes.required' => 'Site Processes is required',
            'site_processes_comments.required' => 'Site Processes Comments is required',
            'all_workers_inducted_on_site.required' => 'All Workers Inducted on Site is required',
            'all_workers_inducted_on_site_comments.required' => 'All workers inducted on site comments is required',
            'workers_inducted_swms_sops.required' => 'Workers inducted swms sops is required',
            'workers_inducted_swms_sops_comments.required' => 'Workers inducted swms sops Comment is required',
            'workers_white_cards.required' => 'Workers white cards is required',
            'workers_white_cards_comments.required' => 'Workers white cards comments is required',
            'workers_following_site_processes.required' => 'Workers following site processes is required',
            'workers_following_site_processes_comments.required' => 'Workers Following Site Processes Comments is required',
            'daily_pre_start_meetings.required' => 'Daily pre start meetings is required',
            'daily_pre_start_meetings_comments.required' => 'Daily pre start meetings comments is required',
            'toolbox_talks_regularly_conducted.required' => 'Toolbox talks regularly conducted is required',
            'toolbox_talks_regularly_conducted_comments.required' => 'Toolbox talks regularly conducted comments is required',
            'housekeeping.required' => 'Housekeeping is required',
            'housekeeping_comments.required' => 'Housekeeping Comments is required',
            'site_generally_clean.required' => 'Site Generally Clean is required',
            'site_generally_clean_comments.required' => 'Site generally clean comments is required',
            'walkways_clear_obstruction.required' => 'Walkways clear obstruction is required',
            'walkways_clear_obstruction_comments.required' => 'Walkways clear obstruction comments is required',
            'materials_safely_stowed.required' => 'materials_safely_stowed is required',
            'materials_safely_stowed_comments.required' => 'Materials safely stowed comments is required',
            'rubbish_debris_disposed.required' => 'Rubbish debris disposed is required',
            'rubbish_debris_disposed_comments.required' => 'Rubbish debris disposed comments is required',
            'slurry_water_dust_removed.required' => 'Slurry water dust removed is required',
            'slurry_water_dust_removed_comments.required' => 'Slurry water dust removed comments is required',
            'amenities.required' => 'Amenities is required',
            'amenities_comments.required' => 'Amenities comments is required',
            'sufficient_toilets_bubblers_provided.required' => 'Sufficient toilets bubblers provided is required',
            'sufficient_toilets_bubblers_provided_comments.required' => 'Sufficient toilets bubblers provided comments is required',
            'lunchroom_facilities_provided.required' => 'Lunchroom facilities provided is required',
            'lunchroom_facilities_provided_comments.required' => 'Lunchroom facilities provided comments is required',
            'amenities_clean_tidy.required' => 'Amenities clean tidy is required',
            'amenities_clean_tidy_comments.required' => 'Amenities clean tidy comments is required',
            'electrical.required' => 'Electrical is required',
            'electrical_comments.required' => 'Electrical Comments is required',
            'temporary_power_boards_present.required' => 'Temporary power boards present is required',
            'temporary_power_boards_present_comments.required' => 'Temporary power boards present comments is required',
            'temporary_power_boards_fitted_rcd.required' => 'Temporary power boards fitted rcd is required',
            'temporary_power_boards_fitted_rcd_comments.required' => 'Temporary power boards fitted rcd comments is required',
            'temporary_power_board_secured_ground.required' => 'Temporary power board secured ground is required',
            'temporary_power_board_secured_ground_comments.required' => 'Temporary power board secured ground comments is required',
            'temporary_power_board_compliant_AS_NZS.required' => 'Temporary power board compliant AS NZS is required',
            'temporary_power_board_compliant_AS_NZS_comments.required' => 'Temporary power board compliant AS NZS comments is required',
            'electrical_equipment_current_test_tag.required' => 'Electrical equipment current test tag is required',
            'electrical_equipment_current_test_tag_comments.required' => 'Electrical equipment current test tag comments is required',
            'electrical_equipment_connected_RCD.required' => 'Electrical equipment connected RCD is required',
            'electrical_equipment_connected_RCD_comments.required' => 'Electrical equipment connected RCD comments is required',
            'extension_leads_current_test_tag.required' => 'Extension leads current test tag is required',
            'extension_leads_current_test_tag_comments.required' => 'Extension leads current test tag comments is required',
            'electrical_leads_elevated_ground_lead_stands.required' => 'Electrical leads elevated ground lead stands is required',
            'electrical_leads_elevated_ground_lead_stands_comments.required' => 'Electrical leads elevated ground lead stands comments is required',
            'electrical_equipment_leads_good_condition.required' => 'Electrical equipment leads good condition is required',
            'electrical_equipment_leads_good_condition_comments.required' => 'Electrical equipment leads good condition comments is required',
            'working_heights.required' => 'Working heights is required',
            'working_heights_comments.required' => 'Working heights comments is required',
            'all_falls_2m_protected.required' => 'All falls 2m protected is required',
            'all_falls_2m_protected_comments.required' => 'All falls 2m protected comments is required',
            'temporary_edge_protection.required' => 'Temporary edge protection is required',
            'temporary_edge_protection_comments.required' => 'Temporary edge protection comments is required',
            'extension_ladders_secured.required' => 'Extension ladders secured is required',
            'extension_ladders_secured_comments.required' => 'Extension ladders secured comments is required',
            'height_safety_equipment.required' => 'Height safety equipment is required',
            'height_safety_equipment_comments.required' => 'Height safety equipment comments is required',
            'penetrations_voids' => 'penetrations_voids is required',
            'penetrations_voids_comments' => 'penetrations_voids_comments is required',
            'penetration_covers_mechanically' => 'penetration_covers_mechanically is required',
            'penetration_covers_mechanically_comments' => 'penetration_covers_mechanically_comments is required',
            'necessary_cast_mesh' => 'necessary_cast_mesh is required',
            'necessary_cast_mesh_comment' => 'necessary cast mesh comment is required',
            'lift_shafts' => 'lift shafts is required',
            'lift_shafts_comments' => 'lift shafts comments is required',
            'guards_place_stair_voids' => 'guards place stair voids is required',
            'guards_place_stair_voids_comments' => 'guards place stair voids comments is required',
            'areas_delineated' => 'areas delineated is required',
            'areas_delineated_comments' => 'areas delineated comments is required',
            'materials_fall_protection' => 'materials fall protection is required',
            'materials_fall_protection_comments' => 'materials fall protection comments is required',
            'netting_covers_perimeter_scaffolding' => 'netting covers perimeter scaffolding is required',
            'netting_covers_perimeter_scaffolding_comments' => 'netting covers perimeter scaffolding comments is required',
            'toe_boards_installed_all_guard_rails' => 'toe boards installed all guard rails is required',
            'toe_boards_installed_all_guard_rails_comments' => 'toe boards installed all guard rails comments is required',
            'core_holes' => 'core holes is required',
            'core_holes_comments' => 'core holes comments is required',
            'scaffolds' => 'scaffolds is required',
            'scaffolds_comments' => 'scaffolds comments is required',
            'scaffold_current_test_tag_entry_points' => 'scaffold current test tag entry points is required',
            'scaffold_current_test_tag_entry_points_comments' => 'scaffold current test tag entry points comments is required',
            'handover_certificate_available' => 'handover certificate available is required',
            'handover_certificate_available_comments' => 'handover certificate available comments is required',
            'adequately_braced' => 'adequately braced is required',
            'adequately_braced_comments' => 'adequately braced comments is required',
            'scaffold_working_face_exceed_225mm' => 'scaffold working face exceed 225mm is required',
            'scaffold_working_face_exceed_225mm_comments' => 'scaffold working face exceed 225mm comments is required',
            'all_scaffold_components_intact' => 'all scaffold components intact is required',
            'all_scaffold_components_intact_comments' => 'all scaffold components intact comments is required',
            'access_ladders' => 'access ladders is required',
            'access_ladders_comments' => 'access ladders comments is required',
            'bays_free_obstruction' => 'bays free obstruction is required',
            'bays_free_obstruction_comments' => 'bays free obstruction comments is required',
            'minimum_450mm_wide_gap' => 'minimum 450mm wide gap is required',
            'minimum_450mm_wide_gap_comments' => 'minimum 450mm wide gap comments is required',
            'Bays_not_point_loaded' => 'Bays not point loaded is required',
            'Bays_not_point_loaded_comments' => 'Bays not point loaded comments is required',
            'bays_being_overloaded' => 'bays being overloaded is required',
            'bays_being_overloaded_comments' => 'bays being overloaded comments is required',
            'no_missing_scaffold_planks' => 'no missing scaffold planks is required',
            'no_missing_scaffold_planks_comments' => 'no missing scaffold planks comments is required',
            'sole_plates_founded_solid_base' => 'sole plates founded solid base is required',
            'sole_plates_founded_solid_base_comments' => 'sole plates founded solid base comments is required',
            'lapboards_mechanically_secured' => 'lapboards mechanically secured is required',
            'lapboards_mechanically_secured_comments' => 'lapboards mechanically secured comments is required',
            'incomplete_scaffold_barricaded_closed' => 'incomplete scaffold barricaded closed is required',
            'incomplete_scaffold_barricaded_closed_comments' => 'incomplete scaffold barricaded closed comments is required',
            'ppe' => 'ppe is required',
            'ppe_comments' => 'ppe comments is required',
            'workers_wearing_mandatory_ppe' => 'workers wearing mandatory ppe is required',
            'workers_wearing_mandatory_ppe_comments' => 'workers wearing mandatory ppe comments is required',
            'workers_observed_ppe_correctly_tasks' => 'workers observed ppe correctly tasks is required',
            'workers_observed_ppe_correctly_tasks_comments' => 'workers observed ppe correctly tasks comments is required',
            'ppe_complies_regulatory_requirements' => 'ppe complies regulatory requirements is required',
            'ppe_complies_regulatory_requirements_comments' => 'ppe_complies_regulatory_requirements_comments is required',
            'ladders' => 'ladders is required',
            'ladders_comments' => 'ladders comments is required',
            'industrial_strength_ladder' => 'industrial strength ladder is required',
            'industrial_strength_ladder_comments' => 'industrial strength ladder comments is required',
            'ladders_good_condition' => 'ladders good condition is required',
            'ladders_good_condition_comments' => 'ladders good condition comments is required',
            'safety_labels_intact' => 'safety labels intact is required',
            'safety_labels_intact_comments' => 'safety labels intact comments is required',
            'extension_adders_secured_top_bottom' => 'extension adders secured top bottom is required',
            'extension_adders_secured_top_bottom_comments' => 'extension adders secured top bottom comments is required',
            'extension_ladders_extend_1m_past_top_landing' => 'extension ladders extend 1m past top landing is required',
            'extension_ladders_extend_1m_past_top_landing_comments' => 'extension ladders extend 1m past top landing comments is required',
            'extension_ladders_placed_correct_angle_1_4' => 'extension ladders placed correct angle 1_4 is required',
            'extension_ladders_placed_correct_angle_1_4_comments' => 'extension ladders placed correct angle 1_4 comments is required',
            'ladders_not_used_scaffold' => 'ladders not used scaffold is required',
            'ladders_not_used_scaffold_comments' => 'ladders not used scaffold comments is required',
            'ladders_not_used_entrance_ways' => 'ladders not used entrance ways is required',
            'ladders_not_used_entrance_ways_comments' => 'ladders not used entrance ways comments is required',
            'trenches_xcavations' => 'trenches xcavations is required',
            'trenches_xcavations_comments' => 'trenches xcavations comments is required',
            'DBYD_been_obtained_before_work' => 'DBYD been obtained before work is required',
            'DBYD_been_obtained_before_work_comments' => 'DBYD been obtained before work comments is required',
            'services_have_been_located_potholed' => 'services have been located potholed is required',
            'services_have_been_located_potholed_comments' => 'services have been located potholed comments is required',
            'excavations_trenches_barricaded_sign_posted' => 'excavations trenches barricaded sign posted is required',
            'excavations_trenches_barricaded_sign_posted_comments' => 'excavations trenches barricaded sign posted comments is required',
            'correct_trench_support_used_where_necessary' => 'correct trench support used where necessary is required',
            'correct_trench_support_used_where_necessary_comments' => 'correct trench support used where necessary comments is required',
            'trenches_greater_than_1_5m_have_edge_protection' => 'trenches greater than 1.5m have edge protection is required',
            'trenches_greater_than_1_5m_have_edge_protection_comments' => 'trenches greater than 1.5m have edge protection comments is required',
            'edges_excavations' => 'edges excavations is required',
            'edges_excavations_comments' => 'edges excavations comments is required',
            'hazardous_substances' => 'hazardous substances is required',
            'hazardous_substances_comments' => 'hazardous substances comments is required',
            'register_kept_on_site_and_up_to_date' => 'register kept on site and up to date is required',
            'register_kept_on_site_and_up_to_date_comments' => 'register kept on site and up to date comments is required',
            'SDS_available_hazardous_substances' => 'SDS available hazardous substances is required',
            'SDS_available_hazardous_substances_comments' => 'SDS available hazardous substances_comments is required',
            'appropriate_signage_displayed' => 'appropriate signage displayed is required',
            'appropriate_signage_displayed_comments' => 'appropriate signage displayed comments is required',
            'adequately_stored_ventilated' => 'adequately stored ventilated is required',
            'adequately_stored_ventilated_comments' => 'adequately stored ventilated_comments is required',
            'kept_original_containers_with_labels' => 'kept original containers with labels is required',
            'kept_original_containers_with_labels_comments' => 'kept original containers with labels comments is required',
            'spill_kit_available_site' => 'spill kit available site is required',
            'spill_kit_available_site_comments' => 'spill kit available site comments is required',
            'emergency_first_aid' => 'emergency first aid is required',
            'emergency_first_aid_comments' => 'emergency first aid comments is required',
            'emergency_access_kept_all_times' => 'emergency access kept all times is required',
            'emergency_access_kept_all_times_comments' => 'emergency access kept all times comments is required',
            'emergency_exit_points_clearly_marked' => 'emergency exit points clearly marked is required',
            'emergency_exit_points_clearly_marked_comments' => 'emergency exit points clearly marked comments is required',
            'emergency_evacuation_plan_displayed' => 'emergency evacuation plan displayed is required',
            'emergency_evacuation_plan_displayed_comments' => 'emergency evacuation plan displayed comments is required',
            'emergency_assembly_point_displayed' => 'emergency assembly point displayed is required',
            'emergency_assembly_point_displayed_comments' => 'emergency assembly point displayed comments is required',
            'emergency_contact_details_displayed' => 'emergency contact details displayed is required',
            'emergency_contact_details_displayed_comments' => 'emergency contact details displayed comments is required',
            'adequate_firefighting_equipment_available' => 'adequate firefighting equipment available is required',
            'adequate_firefighting_equipment_available_comments' => 'adequate firefighting equipment available comments is required',
            'firefighting_equipment_current_test_tag' => 'firefighting equipment current test tag is required',
            'firefighting_equipment_current_test_tag_comments' => 'firefighting equipment current test tag comments is required',
            'first_aid_officer_contact_displayed' => 'first aid officer contact displayed is required',
            'first_aid_officer_contact_displayed_comments' => 'first aid officer contact displayed comments is required',
            'first_aid_signage_displayed' => 'first aid signage displayed is required',
            'first_aid_signage_displayed_comments' => 'first aid signage displayed comments is required',
            'first_aid_kit_fully_stocked' => 'first aid kit fully stocked is required',
            'first_aid_kit_fully_stocked_comments' => 'first aid kit fully stocked comments is required',
            'first_aid_emergency_personnel_trained' => 'first aid emergency personnel trained is required',
            'first_aid_emergency_personnel_trained_comments' => 'first aid emergency personnel trained comments is required',
            'injury_register_maintained_site' => 'injury register maintained site is required',
            'injury_register_maintained_site_comments' => 'injury register maintained site comments is required',
            'hot_works_approved_adequately_controls' => 'hot works approved adequately controls is required',
            'hot_works_approved_adequately_controls_comments' => 'hot works approved adequately controls comments is required',
            'cranes' => 'cranes is required',
            'cranes_comments' => 'cranes comments is required',
            'certificate_registration_available' => 'certificate registration available is required',
            'certificate_registration_available_comments' => 'certificate registration available comments is required',
            'insurances_available' => 'insurances available is required',
            'insurances_available_comments' => 'insurances available comments is required',
            'maintenance_service_records_available_and_up_to_date' => 'maintenance service records available and up to date is required',
            'maintenance_service_records_available_and_up_to_date_comments' => 'maintenance service records available and up to date comments is required',
            'pre_start_inspection_being_completed' => 'pre start inspection being completed is required',
            'pre_start_inspection_being_completed_comments' => 'pre start inspection being completed comments is required',
            'crane_crew_hold_appropriate_licences' => 'crane crew hold appropriate licences is required',
            'crane_crew_hold_appropriate_licences_comments' => 'crane crew hold appropriate licences comments is required',
            'exclusion_being_used_during_movement_loads' => 'exclusion being used during movement loads is required',
            'exclusion_being_used_during_movement_loads_comments' => 'exclusion being used during movement loads comments is required',
            'emergency_response_measures_place' => 'emergency response measures place is required',
            'emergency_response_measures_place_comments' => 'emergency response measures place comments is required',
            'mobile_plant' => 'mobile plant is required',
            'mobile_plant_comments' => 'mobile plant comments is required',
            'certificate_registration_available1' => 'certificate registration available1 is required',
            'certificate_registration_available_comments1' => 'certificate registration available comments1 is required',
            'insurances_available1' => 'insurances available1 is required',
            'insurances_available_comments1' => 'insurances available comments1 is required',
            'maintenance_service_records_available_and_up_to_date1' => 'maintenance service records available and up to date1 is required',
            'maintenance_service_records_available_and_up_to_date_comments1' => 'maintenance service records available and up to date comments1 is required',
            'operators_hold_appropriate_licences' => 'operators hold appropriate licences is required',
            'operators_hold_appropriate_licences_comments' => 'operators hold appropriate licences comments is required',
            'exclusion_being_used_where_necessary' => 'exclusion being used where necessary is required',
            'exclusion_being_used_where_necessary_comments' => 'exclusion being used where necessary comments is required',
            'emergency_response_measures_place1' => 'emergency response measures place1 is required',
            'emergency_response_measures_place_comments1' => 'emergency response measures place comments1 is required',
            'lifting_equipment' => 'lifting equipment is required',
            'lifting_equipment_comments' => 'lifting equipment comments is required',
            'register_available_maintained_site' => 'register available maintained site is required',
            'register_available_maintained_site_comments' => 'register available maintained site comments is required',
            'equipment_has_current_test_tag' => 'equipment has current test tag is required',
            'equipment_has_current_test_tag_comments' => 'equipment has current test tag comments is required',
            'equipment_correctly_stored' => 'equipment correctly stored is required',
            'equipment_correctly_stored_comments' => 'equipment correctly stored comments is required',
            'equipment_inspected_before_use' => 'equipment inspected before use is required',
            'equipment_inspected_before_use_comments' => 'equipment inspected before use comments is required',
            'traffic_control' => 'traffic control is required',
            'traffic_control_comments' => 'traffic control comments is required',
            'traffic_management' => 'traffic management is required',
            'traffic_management_comments' => 'traffic management comments is required',
            'fencing_barriers_to_stop_public_access_to_site' => 'fencing barriers to stop public access to site is required',
            'fencing_barriers_to_stop_public_access_to_site_comments' => 'fencing barriers to stop public access to site comments is required',
            'public_areas_kept_clear_of_materials' => 'public areas kept clear of materials is required',
            'public_areas_kept_clear_of_materials_comments' => 'public areas kept clear of materials comments is required',
            'traffic_controllers_certified' => 'traffic controllers certified is required',
            'traffic_controllers_certified_comments' => 'traffic controllers certified comments is required',
            'signs_and_devices_in_use' => 'signs and devices in use is required',
            'signs_and_devices_in_use_comments' => 'signs and devices in use comments is required',
            'general_additional_comments_notations' => 'general additional comments notations is required',
        ]);
        if ($validate->fails()) {
            return back()->withErrors($validate->errors())->withInput();
        }
        $siteSafetyInspectionData = new SiteSafetyInspection();
        $siteSafetyInspectionData->webFormId = $request->formId;
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
            $data = SiteSafetyInspection::find($siteSafetyInspectionData->id);
            $pdf = PDF::loadView('superadmin.webforms.siteSafetyInspectionPdf', compact('data'));
            $savePath = public_path('webformInvoice'); // Change 'pdfs' to your desired folder name
            if (!file_exists($savePath)) {
                mkdir($savePath, 0755, true);
            }
            $attachmentPath = $savePath . '/' . 'site_safety_inspection_' . $siteSafetyInspectionData->id . '.pdf';
            $pdf->save($attachmentPath);
            $ccmail = $formData->ccMail;
            Mail::to($formData->toMail)->send(new SiteInductionRecordMail($data, $attachmentPath, $ccmail));
            unlink($attachmentPath); // Delete the file
            return redirect('/')->with('success','Site Safety Inspection Record Submitted.');
        } else {
            return redirect()->back()->with('failed','Something went wrong. Please try again.');
        }
    }


    public function toolBoxTalkAttendance(Request $request, $id)
    {   
        $queryToolbox = ToolBoxTalkRecords::query();
        $queryToolbox->select('tool_box_talk_records.*', 'projects.name as projectname', 'projects.id as projectId')
            ->join('projects', 'projects.id', '=', 'tool_box_talk_records.project')
            ->where('tool_box_talk_records.id',$id);
        $tollboxtalkrecord = $queryToolbox->first();
        $tollboxtalkrecordAction = ToolBoxTalkAction::where('tool_box_talk_record_id',$id)->get();
        if(!$tollboxtalkrecord){
            return redirect()->back()->with('error', 'Somthing went wrong.');
        }
        return view('front.webforms.toolbox-talk-record', compact('tollboxtalkrecord', 'tollboxtalkrecordAction'));
    }


    public function toolBoxTalkAttendanceStore(Request $request){
         
        $validate = Validator::make($request->all(), [
            'worker_name' => 'required',
            'worker_signature' => 'required',
            'attendance_date' => 'required',

        ], [
            'worker_name.required' => 'Worker Name is Required',
            'worker_signature.required' => 'Worker Signature is Required',
            'attendance_date.required' => 'Attendance Date is Required',

        ]);
     
        $tollRecord= ToolBoxTalkRecords::where(['id'=>$request->toolboxRecordId])->first();
        
        if(empty($tollRecord)){
            return redirect()->back()->with('danger', 'Something Worng');
        }else{
            $talkattandance = new ToolBoxTalkAttendance();
            $talkattandance['tool_box_talk_record_id'] = $request->toolboxRecordId;
            $talkattandance['worker_name'] = $request->worker_name;
            $talkattandance['signature_date'] = $request->attendance_date;


            if($request->worker_signature){
                $img = $request->worker_signature;
                $stored = store_base64_upload($img, public_path('/images/signatures'), '/public/images/signatures');
            $imageName = $stored['public'] ?? '';
                $talkattandance['worker_signature'] = $imageName;
                }


        if($talkattandance->save()){
            return redirect()->back()->with('success','Attendance Submitted.');

        }
        }
    }


 public function preStartMeeting(Request $request, $id)
    {  
        $queryPreMeeting = PreStartMeeting::query(); 
        $queryPreMeeting->select('pre_start_meetings.*', 'projects.name as projectname', 'projects.id as projectId')
            ->join('projects', 'projects.id', '=', 'pre_start_meetings.project')
            ->where('pre_start_meetings.id',$id);
        $preMeetingrecord = $queryPreMeeting->first();
        
        $preMeetingTopics = PreMeetingTopics::where('pre_meeting_id',$id)->get();
        $preMeetingCorrective = PreMeetingCorrective::where('pre_meeting_id',$id)->get();
        if(!$preMeetingrecord){
            return redirect()->back()->with('error', 'Something went wrong.');
        }
        return view('front.webforms.pre-start-meeting-record', compact('preMeetingrecord', 'preMeetingTopics', 'preMeetingCorrective'));
    }
    
    public function preStartMeetingStore(Request $request){
         
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'signature' => 'required',
        ], [
            'name.required' => 'Name is Required',
            'signature.required' => 'Signature is Required',
        ]);
     
        $tollRecord= PreStartMeeting::where(['id'=>$request->preMeetingId])->first();
        
        if(empty($tollRecord)){
            return redirect()->back()->with('danger', 'Something Worng');
        }else{
            $preMeetingAttandance = new PreMeetingAttendance();
            $preMeetingAttandance['name'] = $request->name;
            $preMeetingAttandance['pre_meeting_id'] = $request->preMeetingId;
            if($request->signature){
                $img = $request->signature;
                $stored = store_base64_upload($img, public_path('/images/signatures'), '/public/images/signatures');
            $imageName = $stored['public'] ?? '';
                $preMeetingAttandance['signature'] = $imageName;
            }
            if($preMeetingAttandance->save()){
                return redirect()->back()->with('success','Attendance Submitted.');
            }
        }
    }
    
    
 public function inspectionTestPlan(Request $request, $id)
    {   
        $queryInspection = InspectionTestPlan::query(); 
        $queryInspection->select('inspectiontestplans.*', 'projects.name as projectname', 'projects.id as projectId')
            ->join('projects', 'projects.id', '=', 'inspectiontestplans.project')
            ->where('inspectiontestplans.id',$id);
        $inspectionrecord = $queryInspection->first();
        if(!$inspectionrecord){
            return redirect()->back()->with('error', 'Something went wrong.');
        }
        $inspectionTrade = InspectionTrade::where('inspection_id',$id)->get();
        $inspectionRepresentative = InspectionRepresentative::where('inspection_id',$id)->get();
        return view('front.webforms.inspection-test-plan', compact('inspectionrecord', 'inspectionTrade','inspectionRepresentative'));
    }
    
    public function inspectionTestPlanStore(Request $request){
         
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'signature' => 'required',
            'area_completion_date'=>'required',
        ], [
            'name.required' => 'Name is Required',
            'signature.required' => 'Signature is Required',
            'area_completion_date.required' => 'Area Completion Date is Required',
        ]);
     
        $inspectionTestPlanRecord = InspectionTestPlan::where(['id'=>$request->inspection_id])->first();
        
        if(empty($inspectionTestPlanRecord)){
            return redirect()->back()->with('danger', 'Something Worng');
        }else{
            
                $inspectionRepresentative = new InspectionRepresentative();
                $inspectionRepresentative['inspection_id'] = $request->inspection_id;
                $inspectionRepresentative['representative'] = $request->representative;
                $inspectionRepresentative['area_completion_date'] = $request->area_completion_date;
                if($request->type == 'PC'){
                    $inspectionRepresentative['representativeType'] = 1;
                }else{
                    $inspectionRepresentative['representativeType'] = 2;
                }                
                if($request->signature){
                    $img = $request->signature;
                    $stored = store_base64_upload($img, public_path('/images/signatures'), '/public/images/signatures');
            $imageName = $stored['public'] ?? '';
                    $inspectionRepresentative['signature'] = $imageName;
                }
                if($inspectionRepresentative->save()){
                    return redirect()->back()->with('success','Successfully Submitted.');
                }
        }
    }
    
    
    public function supplierContractorEvaluation(Request $request){
        
        return view('front.webforms.supplier-contractor-evalution');
        
    }
    public function supplierContractorEvalutionSave(Request $request){
         $formData = WebForm::find(10);
        if(!$formData){
            return redirect()->back()->with('error', 'Somthing went wrong.');
        }
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'abn_can' => 'required',
            'address' => 'required',
            'phone_no' => 'required',
            'email' => 'required',
            'website' => 'required',
            'product' => 'required',
            'inspected_by' => 'required',
            'representative_name' => 'required',
            'representative_phone' => 'required',
            'representative_email' => 'required',
            'certified_quality' => 'required',
            'quality_assurance' => 'required',
            'whsmp_risk_assessments' => 'required',
            'quality_whs_environmental' => 'required',
            'elected_employee_health_safety' => 'required',
            'quality_safety_environmental_responsibilities' => 'required',
            'personnel_inducted' => 'required',
            'verify_worker_competency' => 'required',
            'safety_meetings_regularly_conducted' => 'required',
            'organisation_insurances_licences_qualifications' => 'required',
            'personnel_licences_qualifications' => 'required',
            'prosecuted_issue' => 'required',
            'under_investigation_environmental_laws' => 'required',
            'company_officers_criminal_offence' => 'required',
            'company_necessary_resources' => 'required',
            'procedures_systems' => 'required',
            'staff_qualified_administering_first_aid' => 'required',
            'materials_return_credit_policy' => 'required',
            'organisation_inspection' => 'required',
            'trade_references' => 'required',
            'general_comment' => 'required',
            'supplier_name' => 'required',
            'supplier_position' => 'required',
            'supplier_signature' => 'required',
            'supplier_date' => 'required',
            'evaluation_description' => 'required',
            'organisation_approved' => 'required',
            'organisation_reason' => 'required',
            'organisation_name' => 'required',
            'organisation_position' => 'required',
            'organisation_date' => 'required',
        ], [
            'name.required' => 'Name is Required',
            'abn_can.required' => 'ABN / CAN is Required',
            'address.required' => 'Address is Required',
            'phone_no.required' => 'Phone No is Required',
            'email.required' => 'Email is Required',
            'website.required' => 'Website is Required',
            'product.required' => 'Product is Required',
            'inspected_by.required' => 'Inspected by is Required',
            'representative_name.required' => 'Representative Name is Required',
            'representative_phone.required' => 'Representative Phone is Required',
            'representative_email.required' => 'Representative Email is Required',
            'certified_quality.required' => 'Name is Required',
            'quality_assurance.required' => 'ABN / CAN is Required',
            'whsmp_risk_assessments.required' => 'Address is Required',
            'quality_whs_environmental.required' => 'Phone No is Required',
            'elected_employee_health_safety.required' => 'Email is Required',
            'quality_safety_environmental_responsibilities.required' => 'Email is Required',
            'personnel_inducted.required' => 'Product is Required',
            'verify_worker_competency.required' => 'Inspected by is Required',
            'safety_meetings_regularly_conducted.required' => 'Representative Name is Required',
            'organisation_insurances_licences_qualifications.required' => 'Representative Phone is Required',
            'personnel_licences_qualifications.required' => 'Representative Email is Required',
            'prosecuted_issue.required' => 'Name is Required',
            'under_investigation_environmental_laws.required' => 'Address is Required',
            'company_officers_criminal_offence.required' => 'Phone No is Required',
            'company_necessary_resources.required' => 'Email is Required',
            'procedures_systems.required' => 'Email is Required',
            'staff_qualified_administering_first_aid.required' => 'Product is Required',
            'materials_return_credit_policy.required' => 'Inspected by is Required',
            'organisation_inspection.required' => 'Representative Name is Required',
            'trade_references.required' => 'Representative Phone is Required',
            'general_comment.required' => 'Representative Email is Required',
            'supplier_name.required' => 'Name is Required',
            'supplier_position.required' => 'Address is Required',
            'supplier_signature.required' => 'Phone No is Required',
            'supplier_date.required' => 'Email is Required',
            'evaluation_description.required' => 'Website is Required',
            'organisation_approved.required' => 'Product is Required',
            'organisation_reason.required' => 'Inspected by is Required',
            'organisation_name.required' => 'Representative Name is Required',
            'organisation_position.required' => 'Representative Phone is Required',
            'organisation_date.required' => 'Representative Email is Required',
        ]);
        
                $supplierContractorEvalution = new SupplierContractorEvalution();
                $supplierContractorEvalution['webFormId'] = 10;
                $supplierContractorEvalution['name'] = $request->name;
                $supplierContractorEvalution['abn_can'] = $request->abn_can;
                $supplierContractorEvalution['address'] = $request->address;
                $supplierContractorEvalution['phone_no'] = $request->phone_no;
                $supplierContractorEvalution['email'] = $request->email;
                $supplierContractorEvalution['website'] = $request->website;
                $supplierContractorEvalution['product'] = $request->product;
                $supplierContractorEvalution['inspected_by'] = $request->inspected_by;
                $supplierContractorEvalution['representative_name'] = $request->representative_name;
                $supplierContractorEvalution['representative_phone'] = $request->representative_phone;
                $supplierContractorEvalution['representative_email'] = $request->representative_email;
                $supplierContractorEvalution['certified_quality'] = $request->certified_quality;
                $supplierContractorEvalution['quality_assurance'] = $request->quality_assurance;
                $supplierContractorEvalution['whsmp_risk_assessments'] = $request->whsmp_risk_assessments;
                $supplierContractorEvalution['quality_whs_environmental'] = $request->quality_whs_environmental;
                $supplierContractorEvalution['elected_employee_health_safety'] = $request->elected_employee_health_safety;
                $supplierContractorEvalution['quality_safety_environmental_responsibilities'] = $request->quality_safety_environmental_responsibilities;
                $supplierContractorEvalution['personnel_inducted'] = $request->personnel_inducted;
                $supplierContractorEvalution['verify_worker_competency'] = $request->verify_worker_competency;
                $supplierContractorEvalution['safety_meetings_regularly_conducted'] = $request->safety_meetings_regularly_conducted;
                $supplierContractorEvalution['organisation_insurances_licences_qualifications'] = $request->organisation_insurances_licences_qualifications;
                $supplierContractorEvalution['personnel_licences_qualifications'] = $request->personnel_licences_qualifications;
                $supplierContractorEvalution['prosecuted_issue'] = $request->prosecuted_issue;
                $supplierContractorEvalution['under_investigation_environmental_laws'] = $request->under_investigation_environmental_laws;
                $supplierContractorEvalution['company_officers_criminal_offence'] = $request->company_officers_criminal_offence;
                $supplierContractorEvalution['company_necessary_resources'] = $request->company_necessary_resources;
                $supplierContractorEvalution['procedures_systems'] = $request->procedures_systems;
                $supplierContractorEvalution['staff_qualified_administering_first_aid'] = $request->staff_qualified_administering_first_aid;
                $supplierContractorEvalution['materials_return_credit_policy'] = $request->materials_return_credit_policy;
                $supplierContractorEvalution['organisation_inspection'] = $request->organisation_inspection;
                $supplierContractorEvalution['trade_references'] = $request->trade_references;
                $supplierContractorEvalution['general_comment'] = $request->general_comment;
                $supplierContractorEvalution['supplier_name'] = $request->supplier_name;
                $supplierContractorEvalution['supplier_position'] = $request->supplier_position;
                
                if($request->supplier_signature){
                    $img = $request->supplier_signature;
                    $stored = store_base64_upload($img, public_path('/images/signatures'), '/public/images/signatures');
            $imageName = $stored['public'] ?? '';
                    $supplierContractorEvalution['supplier_signature'] = $imageName;
                }
                
                $supplierContractorEvalution['supplier_date'] = $request->supplier_date;
                $supplierContractorEvalution['evaluation_description'] = $request->evaluation_description;
                $supplierContractorEvalution['organisation_approved'] = $request->organisation_approved;
                $supplierContractorEvalution['organisation_reason'] = $request->organisation_reason;
                $supplierContractorEvalution['organisation_name'] = $request->organisation_name;
                $supplierContractorEvalution['organisation_position'] = $request->organisation_position;
                $supplierContractorEvalution['organisation_date'] = $request->organisation_date;

                // Process the files
                if ($request->hasFile('certified_quality_doc')) {
                    $files = $request->file('certified_quality_doc');
                    $fileNames = [];
                    foreach ($files as $file) {
                        $stored = store_uploaded_file_safe($file, public_path('/suppliercontractorevalution'), '/suppliercontractorevalution', ['jpg', 'jpeg', 'png', 'gif', 'webp', 'pdf']);
                        if ($stored) {
                            $fileNames[] = $stored['name'];
                        }
                    }
                    // Save comma-separated file names to the database
                    $supplierContractorEvalution->certified_quality_doc = implode(',', $fileNames);
                }
                    
                 
                 if ($request->file('quality_assurance_doc')) {
                     $file = $request->file('quality_assurance_doc');
                     $stored = store_uploaded_file_safe($file, public_path('/suppliercontractorevalution'), '/suppliercontractorevalution', ['jpg', 'jpeg', 'png', 'gif', 'webp', 'pdf']);
                     $filename = $stored['name'] ?? '';
                     $supplierContractorEvalution->quality_assurance_doc = $filename;
                 }
                 
                 if ($request->file('verify_worker_competency_doc')) {
                     $file = $request->file('verify_worker_competency_doc');
                     $stored = store_uploaded_file_safe($file, public_path('/suppliercontractorevalution'), '/suppliercontractorevalution', ['jpg', 'jpeg', 'png', 'gif', 'webp', 'pdf']);
                     $filename = $stored['name'] ?? '';
                     $supplierContractorEvalution->verify_worker_competency_doc = $filename;
                 }
                 
                 if ($request->file('organisation_insurances_licences_qualifications_doc')) {
                     $file = $request->file('organisation_insurances_licences_qualifications_doc');
                     $stored = store_uploaded_file_safe($file, public_path('/suppliercontractorevalution'), '/suppliercontractorevalution', ['jpg', 'jpeg', 'png', 'gif', 'webp', 'pdf']);
                     $filename = $stored['name'] ?? '';
                     $supplierContractorEvalution->organisation_insurances_licences_qualifications_doc = $filename;
                 }
                 
                 if ($request->file('prosecuted_issue_doc')) {
                     $file = $request->file('prosecuted_issue_doc');
                     $stored = store_uploaded_file_safe($file, public_path('/suppliercontractorevalution'), '/suppliercontractorevalution', ['jpg', 'jpeg', 'png', 'gif', 'webp', 'pdf']);
                     $filename = $stored['name'] ?? '';
                     $supplierContractorEvalution->prosecuted_issue_doc = $filename;
                 }
                 
                 if ($request->file('under_investigation_environmental_laws_doc')) {
                     $file = $request->file('under_investigation_environmental_laws_doc');
                     $stored = store_uploaded_file_safe($file, public_path('/suppliercontractorevalution'), '/suppliercontractorevalution', ['jpg', 'jpeg', 'png', 'gif', 'webp', 'pdf']);
                     $filename = $stored['name'] ?? '';
                     $supplierContractorEvalution->under_investigation_environmental_laws_doc = $filename;
                 }
                 
                 if ($request->file('company_officers_criminal_offence_doc')) {
                     $file = $request->file('company_officers_criminal_offence_doc');
                     $stored = store_uploaded_file_safe($file, public_path('/suppliercontractorevalution'), '/suppliercontractorevalution', ['jpg', 'jpeg', 'png', 'gif', 'webp', 'pdf']);
                     $filename = $stored['name'] ?? '';
                     $supplierContractorEvalution->company_officers_criminal_offence_doc = $filename;
                 }
                 
                 if ($request->file('procedures_systems_doc')) {
                     $file = $request->file('procedures_systems_doc');
                     $stored = store_uploaded_file_safe($file, public_path('/suppliercontractorevalution'), '/suppliercontractorevalution', ['jpg', 'jpeg', 'png', 'gif', 'webp', 'pdf']);
                     $filename = $stored['name'] ?? '';
                     $supplierContractorEvalution->procedures_systems_doc = $filename;
                 }
                 
                 if ($request->file('staff_qualified_administering_first_aid_doc')) {
                     $file = $request->file('staff_qualified_administering_first_aid_doc');
                     $stored = store_uploaded_file_safe($file, public_path('/suppliercontractorevalution'), '/suppliercontractorevalution', ['jpg', 'jpeg', 'png', 'gif', 'webp', 'pdf']);
                     $filename = $stored['name'] ?? '';
                     $supplierContractorEvalution->staff_qualified_administering_first_aid_doc = $filename;
                 }
                 
                 if ($request->file('materials_return_credit_policy_doc')) {
                     $file = $request->file('materials_return_credit_policy_doc');
                     $stored = store_uploaded_file_safe($file, public_path('/suppliercontractorevalution'), '/suppliercontractorevalution', ['jpg', 'jpeg', 'png', 'gif', 'webp', 'pdf']);
                     $filename = $stored['name'] ?? '';
                     $supplierContractorEvalution->materials_return_credit_policy_doc = $filename;
                 }
                 
                 if ($request->file('trade_references_doc')) {
                     $file = $request->file('trade_references_doc');
                     $stored = store_uploaded_file_safe($file, public_path('/suppliercontractorevalution'), '/suppliercontractorevalution', ['jpg', 'jpeg', 'png', 'gif', 'webp', 'pdf']);
                     $filename = $stored['name'] ?? '';
                     $supplierContractorEvalution->trade_references_doc = $filename;
                 }

                
                if($supplierContractorEvalution->save()){
                    
                    
                    
                    $querySuperContrEval = SupplierContractorEvalution::query();
        $querySuperContrEval->select('supplier_contractor_evalution.*')
            ->orderBy('supplier_contractor_evalution.id', 'DESC')
            ->where('supplier_contractor_evalution.id',$supplierContractorEvalution->id);
        $data = $querySuperContrEval->first();
        
       $pdf = PDF::loadView('superadmin.supplierContractorEvaluation.show',compact('data'));
                    
                    // Define the path where you want to save the PDF
                    $savePath = public_path('webformInvoice'); // Change 'pdfs' to your desired folder name
                    // Make sure the folder exists, create it if not
                    if (!file_exists($savePath)) {
                        mkdir($savePath, 0755, true);
                    }
                    // Save the PDF to the specified path
                    $attachmentPath = $savePath . '/' . 'supplier_contractor_evalution_record_' . $supplierContractorEvalution->id . '.pdf';
                    $pdf->save($attachmentPath);
                    $ccmail = $formData->ccMail;
                    Mail::to($formData->toMail)->send(new SiteInductionRecordMail($data, $attachmentPath, $ccmail));
                    unlink($attachmentPath); // Delete the file
                    
                    
                    
                    return redirect()->back()->with('success','Successfully Submitted.');
                }
        
    }
    
    
    public function swmsReviewChecklist(Request $request){
        $validate = Validator::make($request->all(), [
            'project' => 'required',
            'contractor' => 'required',
            'work_scope' => 'required',
            'swms_particulars' => 'required',
            'swms_date' => 'required',
            'name_address_abn' => 'required',
            'signed_date_by_senior_management' => 'required',
            'managing_swms_implementation' => 'required',
            'Includes_description' => 'required',
            'step_by_step_work_method' => 'required',
            'hazards_associated' => 'required',
            'assesses_risk_associated' => 'required',
            'appropriate_safety_environmental' => 'required',
            'hierarchy_control' => 'required',
            'records_consulted' => 'required',
            'identifies_training' => 'required',
            'identifies_plant_tools_equipment' => 'required',
            'inspection_maintenance' => 'required',
            'regulatory_permits' => 'required',
            'swms_outline' => 'required',
            'hazardous_chemical' => 'required',
            'hazardous_substance' => 'required',
            'corrective_action' => 'required',
            'inspection_methods' => 'required',
            'communicating_method' => 'required',
            'identifies_safety' => 'required',
            'emergency_information' => 'required',
            'inspection_testing' => 'required',
            'swms_address' => 'required',
            'trained_names' => 'required',
            'signatures_carrying' => 'required',
            'hazards_risks_controls' => 'required',
            'electrical' => 'required',
            'noise' => 'required',
            'radiation' => 'required',
            'confined_space' => 'required',
            'laboratory' => 'required',
            'hazardous_chemicals_fumes' => 'required',
            'biological' => 'required',
            'cranes' => 'required',
            'excavation' => 'required',
            'overhead_power_lines' => 'required',
            'work_height' => 'required',
            'work_roofs' => 'required',
            'slip_trip' => 'required',
            'hot_works' => 'required',
            'traffic_vehicles' => 'required',
            'mobile_plant' => 'required',
            'striking_struck' => 'required',
            'lone_work' => 'required',
            'shutdowns' => 'required',
            'hazardous_manual_tasks' => 'required',
            'fatigue' => 'required',
            'fire_explosion' => 'required',
            'gas_installation' => 'required',
            'asbestos' => 'required',
            'lead' => 'required',
        ], [
            'project.required' => 'Project is Required',
            'contractor.required' => 'Contractor is Required',
            'work_scope.required' => 'Work Scope is Required',
            'swms_particulars.required' => 'SWMS Particulars is Required',
            'swms_date.required' => 'SWMS Date is Required',
            'name_address_abn.required' => 'Name Address Abn is Required',
            'signed_date_by_senior_management.required' => 'signed Date By Senior Management is Required',
            'managing_swms_implementation.required' => 'Managing SWMS Implementation by is Required',
            'Includes_description.required' => 'Includes Description is Required',
            'step_by_step_work_method.required' => 'Step-by-step work method is Required',
            'hazards_associated.required' => 'Hazards Associated is Required',
            'assesses_risk_associated.required' => 'Assesses Risk Associated is Required',
            'appropriate_safety_environmental.required' => 'Appropriate Safety Environmental is Required',
            'hierarchy_control.required' => 'Hierarchy Control is Required',
            'records_consulted.required' => 'Records Consulted is Required',
            'identifies_training.required' => 'Identifies Training is Required',
            'identifies_plant_tools_equipment.required' => 'Identifies plant tools equipment is Required',
            'inspection_maintenance.required' => 'Inspection Maintenance is Required',
            'regulatory_permits.required' => 'Regulatory Permits is Required',
            'swms_outline.required' => 'SWMS Outline is Required',
            'hazardous_chemical.required' => 'Hazardous Chemical is Required',
            'hazardous_substance.required' => 'Hazardous Substance is Required',
            'corrective_action.required' => 'Corrective Action is Required',
            'inspection_methods.required' => 'Inspection Methods is Required',
            'communicating_method.required' => 'Communicating Method is Required',
            'identifies_safety.required' => 'Identifies Safety is Required',
            'emergency_information.required' => 'Emergency Information is Required',
            'inspection_testing.required' => 'inspection Testing is Required',
            'swms_address.required' => 'SWMS Address by is Required',
            'trained_names.required' => 'Trained Names is Required',
            'signatures_carrying.required' => 'Signatures Carrying is Required',
            'hazards_risks_controls.required' => 'Hazards Risks Controls is Required',
            'electrical.required' => 'Electrical is Required',
            'noise.required' => 'Noise is Required',
            'radiation.required' => 'Radiation is Required',
            'confined_space.required' => 'Confined Space is Required',
            'laboratory.required' => 'Laboratory is Required',
            'hazardous_chemicals_fumes.required' => 'Hazardous chemicals fumes is Required',
            'biological.required' => 'Biological is Required',
            'cranes.required' => 'Cranes is Required',
            'excavation.required' => 'Excavation is Required',
            'overhead_power_lines.required' => 'Overhead Power Lines is Required',
            'work_height.required' => 'Work height is Required',
            'work_roofs.required' => 'Work Roofs is Required',
            'slip_trip.required' => 'Slip Trip is Required',
            'hot_works.required' => 'Hot Works is Required',
            'traffic_vehicles.required' => 'Traffic Vehicles is Required',
            'mobile_plant.required' => 'Mobile Plant is Required',
            'striking_struck.required' => 'Striking Struck is Required',
            'lone_work.required' => 'Lone Work is Required',
            'shutdowns.required' => 'Shutdowns is Required',
            'hazardous_manual_tasks.required' => 'Hazardous Manual Tasks is Required',
            'fatigue.required' => 'Fatigue is Required',
            'fire_explosion.required' => 'Fire Explosion is Required',
            'gas_installation.required' => 'Gas Installation is Required',
            'asbestos.required' => 'Asbestos is Required',
            'lead.required' => 'Lead is Required',
        ]);
                $supplierContractorEvalution = new SupplierContractorEvalution(); 
                $supplierContractorEvalution['project'] = $request->project;
                $supplierContractorEvalution['contractor'] = $request->contractor;
                $supplierContractorEvalution['work_scope'] = $request->work_scope;
                $supplierContractorEvalution['swms_particulars'] = $request->swms_particulars;
                $supplierContractorEvalution['swms_date'] = $request->swms_date;
                $supplierContractorEvalution['name_address_abn'] = $request->name_address_abn;
                $supplierContractorEvalution['signed_date_by_senior_management'] = $request->signed_date_by_senior_management;
                $supplierContractorEvalution['managing_swms_implementation'] = $request->managing_swms_implementation;
                $supplierContractorEvalution['Includes_description'] = $request->Includes_description;
                $supplierContractorEvalution['step_by_step_work_method'] = $request->step_by_step_work_method;
                $supplierContractorEvalution['hazards_associated'] = $request->hazards_associated;
                $supplierContractorEvalution['assesses_risk_associated'] = $request->assesses_risk_associated;
                $supplierContractorEvalution['appropriate_safety_environmental'] = $request->appropriate_safety_environmental;
                $supplierContractorEvalution['hierarchy_control'] = $request->hierarchy_control;
                $supplierContractorEvalution['records_consulted'] = $request->records_consulted;
                $supplierContractorEvalution['identifies_training'] = $request->identifies_training;
                $supplierContractorEvalution['identifies_plant_tools_equipment'] = $request->identifies_plant_tools_equipment;
                $supplierContractorEvalution['inspection_maintenance'] = $request->inspection_maintenance;
                $supplierContractorEvalution['regulatory_permits'] = $request->regulatory_permits;
                $supplierContractorEvalution['swms_outline'] = $request->swms_outline;
                $supplierContractorEvalution['hazardous_chemical'] = $request->hazardous_chemical;
                $supplierContractorEvalution['hazardous_substance'] = $request->hazardous_substance;
                $supplierContractorEvalution['corrective_action'] = $request->corrective_action;
                $supplierContractorEvalution['inspection_methods'] = $request->inspection_methods;
                $supplierContractorEvalution['communicating_method'] = $request->communicating_method;
                $supplierContractorEvalution['identifies_safety'] = $request->identifies_safety;
                $supplierContractorEvalution['emergency_information'] = $request->emergency_information;
                $supplierContractorEvalution['inspection_testing'] = $request->inspection_testing;
                $supplierContractorEvalution['swms_address'] = $request->swms_address;
                $supplierContractorEvalution['trained_names'] = $request->trained_names;
                $supplierContractorEvalution['signatures_carrying'] = $request->signatures_carrying;
                $supplierContractorEvalution['hazards_risks_controls'] = $request->hazards_risks_controls;
                
                $supplierContractorEvalution['electrical'] = $request->electrical;
                $supplierContractorEvalution['noise'] = $request->noise;
                $supplierContractorEvalution['radiation'] = $request->radiation;
                $supplierContractorEvalution['confined_space'] = $request->confined_space;
                $supplierContractorEvalution['laboratory'] = $request->laboratory;
                $supplierContractorEvalution['hazardous_chemicals_fumes'] = $request->hazardous_chemicals_fumes;
                $supplierContractorEvalution['biological'] = $request->biological;
                $supplierContractorEvalution['cranes'] = $request->cranes;
                $supplierContractorEvalution['excavation'] = $request->excavation;
                $supplierContractorEvalution['overhead_power_lines'] = $request->overhead_power_lines;
                $supplierContractorEvalution['work_height'] = $request->work_height;
                $supplierContractorEvalution['work_roofs'] = $request->work_roofs;
                $supplierContractorEvalution['slip_trip'] = $request->slip_trip;
                $supplierContractorEvalution['hot_works'] = $request->hot_works;
                $supplierContractorEvalution['traffic_vehicles'] = $request->traffic_vehicles;
                $supplierContractorEvalution['mobile_plant'] = $request->mobile_plant;
                $supplierContractorEvalution['striking_struck'] = $request->striking_struck; 
                $supplierContractorEvalution['lone_work'] = $request->lone_work; 
                $supplierContractorEvalution['shutdowns'] = $request->shutdowns;
                $supplierContractorEvalution['hazardous_manual_tasks'] = $request->hazardous_manual_tasks;
                $supplierContractorEvalution['fatigue'] = $request->fatigue;
                $supplierContractorEvalution['fire_explosion'] = $request->fire_explosion;
                $supplierContractorEvalution['gas_installation'] = $request->gas_installation;
                $supplierContractorEvalution['asbestos'] = $request->asbestos;
                $supplierContractorEvalution['lead'] = $request->lead;

                if($request->supplier_signature){
                    $img = $request->supplier_signature;
                    $stored = store_base64_upload($img, public_path('/images/signatures'), '/public/images/signatures');
            $imageName = $stored['public'] ?? '';
                    $supplierContractorEvalution['supplier_signature'] = $imageName;
                }
                

                
                if($supplierContractorEvalution->save()){
                    return redirect()->back()->with('success','Successfully Submitted.');
                }
        
    }
    
    
    
    public function supplierContractorCar(Request $request, $id)
    {  
        $querysupContCar = SupplierContractorCar::query(); 
        $querysupContCar->select('supplier_contractor_car.*', 'projects.name as projectname', 'projects.id as projectId')
            ->join('projects', 'projects.id', '=', 'supplier_contractor_car.project')
            ->where('supplier_contractor_car.id',$id);
        $supContracrCarRecord = $querysupContCar->first();
        
        $supContractorProblem = SupplierContractorCarProblem::where('supplier_contractor_car_id',$id)->get();
        if(!$supContracrCarRecord){
            return redirect()->back()->with('error', 'Something went wrong.');
        }
        return view('front.webforms.supplier-contractor-car-record', compact('supContracrCarRecord', 'supContractorProblem'));
    }
    public function supplierContractorCarStore(Request $request){
         
        $validate = Validator::make($request->all(), [
            'corrective_action' => 'required',
            'name' => 'required',
            'position' => 'required',
            'date' => 'required',
        ], [
            'corrective_action.required' => 'Corrective Action is Required',
            'name.required' => 'Name is Required',
            'position.required' => 'Position is Required',
            'date.required' => 'Date is Required',
        ]);
        $supplierContractorCarRec = SupplierContractorCar::where(['id'=>$request->supplierContractorCarId])->first();
        if(empty($supplierContractorCarRec)){
            return redirect()->back()->with('danger', 'Something Worng');
        }else{
            $supplierContractorCarData = new SupplierContractorCarCorrective();
            $supplierContractorCarData['supplier_contractor_car_id'] = $request->supplierContractorCarId;
            $supplierContractorCarData['corrective_action'] = $request->corrective_action;
            $supplierContractorCarData['name'] = $request->name;
            $supplierContractorCarData['position'] = $request->position;
            $supplierContractorCarData['date'] = $request->date;
            if($supplierContractorCarData->save()){
                return redirect()->back()->with('success','Successfully Submitted.');
            }
        }
    }
    
    
     public function preStartChecklist(Request $request){
        
        return view('front.webforms.contractor-pre-start-Checklist');
        
    }
    public function preStartChecklistSave(Request $request){
        
        $formData = WebForm::find(12);
        if(!$formData){
            return redirect()->back()->with('error', 'Somthing went wrong.');
        }
         
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'abn_can' => 'required',
            'address' => 'required',
            'phone_no' => 'required',
            'email' => 'required',
            'website' => 'required',
            'product' => 'required',
            'representative' => 'required',
            'representative_name' => 'required',
            'representative_phone' => 'required',
            'representative_email' => 'required',
            'insurance_policy' => 'required',
            'compensation_policy' => 'required',
            'qualifications' => 'required',
            'risk_injury' => 'required',
            'necessary_emergency' => 'required',
            'reporting_requirements' => 'required',
            'specific_emergency_plan' => 'required',
            'records_plant_equipment' => 'required',
            'plant_working_condition' => 'required',
            'plant_brought_site' => 'required',
            'hazardous_chemicals' => 'required',
            'exposure_standards' => 'required',
            'containers_labelled' => 'required',
            'electrical_equipment' => 'required',
            'testing_records' => 'required',
            'workers_brought_site' => 'required',
            'training_competency' => 'required',
            'workers_white_card' => 'required',
            'workers_risk_licences' => 'required',
            'workers_training_evidence' => 'required',
            'general_comment' => 'required',
            'manager_name' => 'required',
            'manager_signature' => 'required', 
            'manager_date' => 'required',
        ], [
            'name.required' => 'Name is Required',
            'abn_can.required' => 'ABN / CAN is Required',
            'address.required' => 'Address is Required',
            'phone_no.required' => 'Phone No is Required',
            'email.required' => 'Email is Required',
            'website.required' => 'Website is Required',
            'product.required' => 'Product is Required',
            'representative.required' => 'Representative is Required',
            'representative_name.required' => 'Representative Name is Required',
            'representative_phone.required' => 'Representative Phone is Required',
            'representative_email.required' => 'Representative Email is Required',
            'insurance_policy.required' => 'Insurance Policy is Required',
            'compensation_policy.required' => 'Compensation Policy is Required',
            'qualifications.required' => 'Qualifications is Required',
            'risk_injury.required' => 'Risk Injury is Required',
            'necessary_emergency.required' => 'Necessary Emergency is Required',
            'reporting_requirements.required' => 'Reporting Requirements is Required',
            'specific_emergency_plan.required' => 'Specific Emergency Plan is Required',
            'records_plant_equipment.required' => 'Records Plant Equipment is Required',
            'plant_working_condition.required' => 'Plant Working Condition is Required',
            'plant_brought_site.required' => 'Plant Brought Site is Required',
            'hazardous_chemicals.required' => 'Hazardous Chemicals is Required',
            'exposure_standards.required' => 'Exposure Standards is Required',
            'containers_labelled.required' => 'Containers Labelled is Required',
            'electrical_equipment.required' => 'Electrical Equipment is Required',
            'testing_records.required' => 'Testing Records is Required',
            'workers_brought_site.required' => 'Workers Brought Site is Required',
            'training_competency.required' => 'Training Competency is Required',
            'workers_white_card.required' => 'Workers White Card is Required',
            'workers_risk_licences.required' => 'Workers Risk Licences is Required',
            'workers_training_evidence.required' => 'Workers Training Evidence is Required',
            'general_comment.required' => 'General Comment is Required',
            'manager_name.required' => 'Manager Name is Required',
            'manager_signature.required' => 'Manager Signature is Required',
            'manager_date.required' => 'Date is Required',
        ]);
        
                $contractorPreCheckList = new PreStartChecklist();
                $contractorPreCheckList['webFormId'] = 12;
                $contractorPreCheckList['name'] = $request->name;
                $contractorPreCheckList['abn_can'] = $request->abn_can;
                $contractorPreCheckList['address'] = $request->address;
                $contractorPreCheckList['phone_no'] = $request->phone_no;
                $contractorPreCheckList['email'] = $request->email;
                $contractorPreCheckList['website'] = $request->website;
                $contractorPreCheckList['product'] = $request->product;
                $contractorPreCheckList['representative'] = $request->representative;
                $contractorPreCheckList['representative_name'] = $request->representative_name;
                $contractorPreCheckList['representative_phone'] = $request->representative_phone;
                $contractorPreCheckList['representative_email'] = $request->representative_email;
                $contractorPreCheckList['insurance_policy'] = $request->insurance_policy;
                $contractorPreCheckList['compensation_policy'] = $request->compensation_policy;
                $contractorPreCheckList['qualifications'] = $request->qualifications;
                $contractorPreCheckList['risk_injury'] = $request->risk_injury;
                $contractorPreCheckList['necessary_emergency'] = $request->necessary_emergency;
                $contractorPreCheckList['reporting_requirements'] = $request->reporting_requirements;
                $contractorPreCheckList['specific_emergency_plan'] = $request->specific_emergency_plan;
                $contractorPreCheckList['records_plant_equipment'] = $request->records_plant_equipment;
                $contractorPreCheckList['plant_working_condition'] = $request->plant_working_condition;
                $contractorPreCheckList['plant_brought_site'] = $request->plant_brought_site;
                $contractorPreCheckList['hazardous_chemicals'] = $request->hazardous_chemicals;
                $contractorPreCheckList['exposure_standards'] = $request->exposure_standards;
                $contractorPreCheckList['containers_labelled'] = $request->containers_labelled;
                $contractorPreCheckList['electrical_equipment'] = $request->electrical_equipment;
                $contractorPreCheckList['testing_records'] = $request->testing_records;
                $contractorPreCheckList['workers_brought_site'] = $request->workers_brought_site;
                $contractorPreCheckList['training_competency'] = $request->training_competency;
                $contractorPreCheckList['workers_white_card'] = $request->workers_white_card;
                $contractorPreCheckList['workers_risk_licences'] = $request->workers_risk_licences;
                $contractorPreCheckList['workers_training_evidence'] = $request->workers_training_evidence;
                $contractorPreCheckList['general_comment'] = $request->general_comment;
                $contractorPreCheckList['manager_name'] = $request->manager_name;
                $contractorPreCheckList['manager_date'] = $request->manager_date;
                if($request->manager_signature){
                    $img = $request->manager_signature;
                    $stored = store_base64_upload($img, public_path('/images/signatures'), '/public/images/signatures');
            $imageName = $stored['public'] ?? '';
                    $contractorPreCheckList['manager_signature'] = $imageName;
                }
                

                // Process the files
                if ($request->hasFile('insurance_policy_doc')) {
                    $files = $request->file('insurance_policy_doc');
                    $fileNames = [];
                    foreach ($files as $file) {
                        $stored = store_uploaded_file_safe($file, public_path('/preStartChecklist'), '/preStartChecklist', ['jpg', 'jpeg', 'png', 'gif', 'webp', 'pdf']);
                        if ($stored) {
                            $fileNames[] = $stored['name'];
                        }
                    }
                    $contractorPreCheckList->insurance_policy_doc = implode(',', $fileNames);
                }
                
                 if ($request->hasFile('compensation_policy_doc')) {
                    $files = $request->file('compensation_policy_doc');
                    $fileNames = [];
                    foreach ($files as $file) {
                        $stored = store_uploaded_file_safe($file, public_path('/preStartChecklist'), '/preStartChecklist', ['jpg', 'jpeg', 'png', 'gif', 'webp', 'pdf']);
                        if ($stored) {
                            $fileNames[] = $stored['name'];
                        }
                    }
                    $contractorPreCheckList->compensation_policy_doc = implode(',', $fileNames);
                }
                
                if ($request->hasFile('qualifications_doc')) {
                    $files = $request->file('qualifications_doc');
                    $fileNames = [];
                    foreach ($files as $file) {
                        $stored = store_uploaded_file_safe($file, public_path('/preStartChecklist'), '/preStartChecklist', ['jpg', 'jpeg', 'png', 'gif', 'webp', 'pdf']);
                        if ($stored) {
                            $fileNames[] = $stored['name'];
                        }
                    }
                    $contractorPreCheckList->qualifications_doc = implode(',', $fileNames);
                }
                 if ($request->hasFile('risk_injury_doc')) {
                    $files = $request->file('risk_injury_doc');
                    $fileNames = [];
                    foreach ($files as $file) {
                        $stored = store_uploaded_file_safe($file, public_path('/preStartChecklist'), '/preStartChecklist', ['jpg', 'jpeg', 'png', 'gif', 'webp', 'pdf']);
                        if ($stored) {
                            $fileNames[] = $stored['name'];
                        }
                    }
                    $contractorPreCheckList->risk_injury_doc = implode(',', $fileNames);
                }
                if ($request->hasFile('specific_emergency_plan_doc')) {
                    $files = $request->file('specific_emergency_plan_doc');
                    $fileNames = [];
                    foreach ($files as $file) {
                        $stored = store_uploaded_file_safe($file, public_path('/preStartChecklist'), '/preStartChecklist', ['jpg', 'jpeg', 'png', 'gif', 'webp', 'pdf']);
                        if ($stored) {
                            $fileNames[] = $stored['name'];
                        }
                    }
                    $contractorPreCheckList->specific_emergency_plan_doc = implode(',', $fileNames);
                }
                if ($request->hasFile('records_plant_equipment_doc')) {
                    $files = $request->file('records_plant_equipment_doc');
                    $fileNames = [];
                    foreach ($files as $file) {
                        $stored = store_uploaded_file_safe($file, public_path('/preStartChecklist'), '/preStartChecklist', ['jpg', 'jpeg', 'png', 'gif', 'webp', 'pdf']);
                        if ($stored) {
                            $fileNames[] = $stored['name'];
                        }
                    }
                    $contractorPreCheckList->records_plant_equipment_doc = implode(',', $fileNames);
                }
                if ($request->hasFile('plant_brought_site_doc')) {
                    $files = $request->file('plant_brought_site_doc');
                    $fileNames = [];
                    foreach ($files as $file) {
                        $stored = store_uploaded_file_safe($file, public_path('/preStartChecklist'), '/preStartChecklist', ['jpg', 'jpeg', 'png', 'gif', 'webp', 'pdf']);
                        if ($stored) {
                            $fileNames[] = $stored['name'];
                        }
                    }
                    $contractorPreCheckList->plant_brought_site_doc = implode(',', $fileNames);
                }
                if ($request->hasFile('exposure_standards_doc')) {
                    $files = $request->file('exposure_standards_doc');
                    $fileNames = [];
                    foreach ($files as $file) {
                        $stored = store_uploaded_file_safe($file, public_path('/preStartChecklist'), '/preStartChecklist', ['jpg', 'jpeg', 'png', 'gif', 'webp', 'pdf']);
                        if ($stored) {
                            $fileNames[] = $stored['name'];
                        }
                    }
                    $contractorPreCheckList->exposure_standards_doc = implode(',', $fileNames);
                }
                if ($request->hasFile('testing_records_doc')) {
                    $files = $request->file('testing_records_doc');
                    $fileNames = [];
                    foreach ($files as $file) {
                        $stored = store_uploaded_file_safe($file, public_path('/preStartChecklist'), '/preStartChecklist', ['jpg', 'jpeg', 'png', 'gif', 'webp', 'pdf']);
                        if ($stored) {
                            $fileNames[] = $stored['name'];
                        }
                    }
                    $contractorPreCheckList->testing_records_doc = implode(',', $fileNames);
                }
                 if ($request->hasFile('training_competency_doc')) {
                    $files = $request->file('training_competency_doc');
                    $fileNames = [];
                    foreach ($files as $file) {
                        $stored = store_uploaded_file_safe($file, public_path('/preStartChecklist'), '/preStartChecklist', ['jpg', 'jpeg', 'png', 'gif', 'webp', 'pdf']);
                        if ($stored) {
                            $fileNames[] = $stored['name'];
                        }
                    }
                    $contractorPreCheckList->training_competency_doc = implode(',', $fileNames);
                }
                
                if($contractorPreCheckList->save()){
                    

                    $querySuperContrEval = PreStartChecklist::query();
                    $querySuperContrEval->select('pre_start_checklist.*')
                        ->where('pre_start_checklist.id',$contractorPreCheckList->id);
                    $data = $querySuperContrEval->first();
                   $pdf = PDF::loadView('superadmin.contractPreStartChecklist.show',compact('data'));
                    // Define the path where you want to save the PDF
                    $savePath = public_path('webformInvoice'); // Change 'pdfs' to your desired folder name
                    // Make sure the folder exists, create it if not
                    if (!file_exists($savePath)) {
                        mkdir($savePath, 0755, true);
                    }
                    // Save the PDF to the specified path
                    $attachmentPath = $savePath . '/' . 'contractor_pre_check_record_' . $contractorPreCheckList->id . '.pdf';
                    $pdf->save($attachmentPath);
                    $ccmail = $formData->ccMail;
                    Mail::to($formData->toMail)->send(new SiteInductionRecordMail($data, $attachmentPath, $ccmail));
                    unlink($attachmentPath); // Delete the file
                    
                    
                    return redirect()->back()->with('success','Successfully Submitted.');
                }
        
    }
    
    
    
     function siteInductionReportsPdf(Request $request, $id)
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
        
        function preStartMeetingsPdf(Request $request, $id){
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
        function inspectionTestPlanPdf(Request $request, $id){
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
        function supplierContractorCarPdf(Request $request, $id){
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
        function supplierContractorEvaluationPdf(Request $request, $id){
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
    
     public function contractPreStartChecklistPdf($id)
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
        
        
        
    
    
}
