<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SuperAdmin\ShoppingCentre;
use App\Http\Controllers\SuperAdmin\customerController;
use App\Http\Controllers\SuperAdmin\UserControllerSuperAdmin;
use App\Http\Controllers\SuperAdmin\UsereditProfilerController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomeAdminController;
use App\Http\Controllers\SuperAdmin\ToolboxTalkControllerSuperAdmin;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\Front\FrontHomeController::class, 'index'])->name('home-front');
Route::get('webforms/{slug?}', [App\Http\Controllers\Front\FrontHomeController::class, 'webforms'])->name('webforms_front');
Route::post('siteInductionRecordSave', [App\Http\Controllers\Front\FrontHomeController::class, 'siteInductionRecordSave'])->name('siteInductionRecordSave');
Route::post('siteSafetyInspectionSave', [App\Http\Controllers\Front\FrontHomeController::class, 'siteSafetyInspectionSave'])->name('siteSafetyInspectionSave');
Route::get('siteSafetyInspectionget/{id?}', [App\Http\Controllers\Front\FrontHomeController::class, 'siteSafetyInspectionget'])->name('siteSafetyInspectionget');
Route::get('toolBoxTalkAttendance/{id?}', [App\Http\Controllers\Front\FrontHomeController::class, 'toolBoxTalkAttendance'])->name('toolBoxTalkAttendance');
Route::post('toolBoxTalkAttendanceStore', [App\Http\Controllers\Front\FrontHomeController::class, 'toolBoxTalkAttendanceStore'])->name('toolBoxTalkAttendanceStore');

Route::get('preStartMeetings/{id?}', [App\Http\Controllers\Front\FrontHomeController::class, 'preStartMeeting'])->name('preStartMeeting');
Route::post('preStartMeetingStore', [App\Http\Controllers\Front\FrontHomeController::class, 'preStartMeetingStore'])->name('preStartMeetingStore');

Route::get('inspectionTestPlan/{id?}', [App\Http\Controllers\Front\FrontHomeController::class, 'inspectionTestPlan'])->name('inspectionTestPlan');
Route::post('inspectionTestPlanStore', [App\Http\Controllers\Front\FrontHomeController::class, 'inspectionTestPlanStore'])->name('inspectionTestPlanStore');

Route::get('supplierContractorEvaluation', [App\Http\Controllers\Front\FrontHomeController::class, 'supplierContractorEvaluation'])->name('supplierContractorEvaluation');
Route::post('supplierContractorEvalutionSave', [App\Http\Controllers\Front\FrontHomeController::class, 'supplierContractorEvalutionSave'])->name('supplierContractorEvalutionSave');

Route::get('supplierContractorCar/{id?}', [App\Http\Controllers\Front\FrontHomeController::class, 'supplierContractorCar'])->name('supplierContractorCar');
Route::post('supplierContractorCarStore', [App\Http\Controllers\Front\FrontHomeController::class, 'supplierContractorCarStore'])->name('supplierContractorCarStore');

Route::get('preStartChecklist', [App\Http\Controllers\Front\FrontHomeController::class, 'preStartChecklist'])->name('preStartChecklist');
Route::post('preStartChecklistSave', [App\Http\Controllers\Front\FrontHomeController::class, 'preStartChecklistSave'])->name('preStartChecklistSave');


Route::get('forgot-password', [UserController::class, 'forgotPassword'])->name('forgot-password');
Route::get('forgot-password/{token}', [UserController::class, 'forgotPasswordValidate']);
Route::post('forgot-password', [UserController::class, 'resetPassword'])->name('forgot-password');
Route::put('reset-password', [UserController::class, 'updatePassword'])->name('reset-password');
Route::get('/siteInductionReportsPdf/{id}', [App\Http\Controllers\Front\FrontHomeController::class, 'siteInductionReportsPdf'])->name('siteInductionReportsPdf');
Route::get('/siteSafeInspectionReportsPdf/{id}', [App\Http\Controllers\Front\FrontHomeController::class, 'siteSafeInspectionReportsPdf'])->name('siteSafeInspectionReportsPdf');
Route::get('/preStartMeetingsPdf/{id}', [App\Http\Controllers\Front\FrontHomeController::class, 'preStartMeetingsPdf'])->name('preStartMeetingsPdf');
Route::get('/inspectionTestPlanPdf/{id}', [App\Http\Controllers\Front\FrontHomeController::class, 'inspectionTestPlanPdf'])->name('inspectionTestPlanPdf');
Route::get('/supplierContractorCarPdf/{id}', [App\Http\Controllers\Front\FrontHomeController::class, 'supplierContractorCarPdf'])->name('supplierContractorCarPdf');
Route::get('/supplierContractorEvaluationPdf/{id}', [App\Http\Controllers\Front\FrontHomeController::class, 'supplierContractorEvaluationPdf'])->name('supplierContractorEvaluationPdf');
Route::get('/contractPreStartChecklistPdf/{id}', [App\Http\Controllers\Front\FrontHomeController::class, 'contractPreStartChecklistPdf'])->name('contractPreStartChecklistPdf');
Route::get('/supplierContractorEvaluationPdf/{id}', [App\Http\Controllers\Front\FrontHomeController::class, 'supplierContractorEvaluationPdf'])->name('supplierContractorEvaluationPdf');



Auth::routes();

Route::group(['middleware' => ["is_superadmin"], "prefix" => "superadmin"], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('users', App\Http\Controllers\SuperAdmin\UserControllerSuperAdmin::class);
    Route::post('login', [App\Http\Controllers\SuperAdmin\UserControllerSuperAdmin::class, 'login']);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('projects', App\Http\Controllers\SuperAdmin\ProjectsController::class);
    Route::post('project-status/update', [App\Http\Controllers\SuperAdmin\ProjectsController::class, 'update_status_project'])->name('status.update.project');
    Route::resource('webforms', App\Http\Controllers\SuperAdmin\WebFormControllerSuperAdmin::class);
    Route::resource('webforms', App\Http\Controllers\SuperAdmin\WebFormControllerSuperAdmin::class);
    Route::post('webformUpdate', [App\Http\Controllers\SuperAdmin\WebFormControllerSuperAdmin::class, 'webformUpdate'])->name('webformUpdate');
    Route::get('webformReports', [App\Http\Controllers\SuperAdmin\WebFormControllerSuperAdmin::class, 'webformReports'])->name('webformReports');
    Route::get('/webformReports/fetch_data', [App\Http\Controllers\SuperAdmin\WebFormControllerSuperAdmin::class, 'fetch_data'])->name('webformReports-fetchData');
    Route::get('/webformReportsPdf/{id}', [App\Http\Controllers\SuperAdmin\WebFormControllerSuperAdmin::class, 'webformReportsPdf'])->name('webformReportsPdf');
    Route::post('/resendMail', [App\Http\Controllers\SuperAdmin\WebFormControllerSuperAdmin::class, 'resendMail'])->name('resendMail');
    Route::get('siteSafetInspectionReports', [App\Http\Controllers\SuperAdmin\WebFormControllerSuperAdmin::class, 'siteSafetInspectionReports'])->name('siteSafetInspectionReports');
    Route::get('/siteSafetInspectionReports/site_Safe_inspection_fetch_data', [App\Http\Controllers\SuperAdmin\WebFormControllerSuperAdmin::class, 'site_Safe_inspection_fetch_data'])->name('siteSafetInspectionReports-site_Safe_inspection_fetch_data');
    Route::get('/siteSafeInspectionReportsPdf/{id}', [App\Http\Controllers\SuperAdmin\WebFormControllerSuperAdmin::class, 'siteSafeInspectionReportsPdf'])->name('siteSafeInspectionReportsPdf');
    Route::post('/siteSafeInspectionResendMail', [App\Http\Controllers\SuperAdmin\WebFormControllerSuperAdmin::class, 'siteSafeInspectionResendMail'])->name('siteSafeInspectionResendMail');
    Route::resource('toolBoxTalkRecords', App\Http\Controllers\SuperAdmin\ToolboxTalkControllerSuperAdmin::class);
    Route::resource('preStartMeetings', App\Http\Controllers\SuperAdmin\PreStartMeetingsSuperAdmin::class);
    Route::resource('inspectionTestPlan', App\Http\Controllers\SuperAdmin\InspectionTestPlanSuperAdmin::class);
    Route::resource('supplierContractorEvaluation', App\Http\Controllers\SuperAdmin\SupplierContractorEvaluationSuperAdmin::class);
    Route::get('suppContractorEvalAttach/{id}', [App\Http\Controllers\SuperAdmin\SupplierContractorEvaluationSuperAdmin::class, 'suppContractorEvalAttach'])->name('suppContractorEvalAttach');
    Route::resource('contractPreStartChecklist', App\Http\Controllers\SuperAdmin\ContractorPreStartChecklistSuperAdmin::class);
    Route::get('contractPreStartChecklistAttach/{id}', [App\Http\Controllers\SuperAdmin\ContractorPreStartChecklistSuperAdmin::class, 'contractPreStartChecklistAttach'])->name('contractPreStartChecklistAttach');
    Route::resource('supplierContractorCar', App\Http\Controllers\SuperAdmin\SupplierContractorCarSuperAdmin::class);


    Route::resource('programs', App\Http\Controllers\SuperAdmin\ProgramsControllerSuperAdmin::class);
    Route::get('/fetch_program', [App\Http\Controllers\SuperAdmin\ProgramsControllerSuperAdmin::class, 'fetch_program'])->name('fetch_program');
    Route::post('programUpdate/{id}', [App\Http\Controllers\SuperAdmin\ProgramsControllerSuperAdmin::class, 'update'])->name('programUpdate');
    Route::delete('/programTaskDelete/{id}', [App\Http\Controllers\SuperAdmin\ProgramsControllerSuperAdmin::class, 'destroyTask'])->name('programTaskDelete');

    Route::resource('diaries', App\Http\Controllers\SuperAdmin\DiariesControllerSuperAdmin::class);
    Route::get('/fetch_diary_program', [App\Http\Controllers\SuperAdmin\DiariesControllerSuperAdmin::class, 'fetch_diary_program'])->name('fetch_diary_program');
    Route::post('diaryUpdate/{id}', [App\Http\Controllers\SuperAdmin\DiariesControllerSuperAdmin::class, 'update'])->name('diaryUpdate');
    Route::delete('/diaryEmpDelete/{id}', [App\Http\Controllers\SuperAdmin\DiariesControllerSuperAdmin::class, 'destroyEmp'])->name('diaryEmpDelete');
    Route::delete('/diaryImageDelete/{id}', [App\Http\Controllers\SuperAdmin\DiariesControllerSuperAdmin::class, 'destroyImage'])->name('diaryImageDelete');


    Route::post('user-status/update', [App\Http\Controllers\SuperAdmin\UserControllerSuperAdmin::class, 'update_status_user'])->name('status.update.user');
    Route::post('user-status/status/update', [App\Http\Controllers\SuperAdmin\QuestionsController::class, 'update_status'])->name('status.update');
    Route::post('change-password-profile-super/{id}', [App\Http\Controllers\SuperAdmin\UsereditProfilerController::class, 'change_password_profile_super'])->name('change_password_profile_super');
    Route::get('usereditprofiler', [App\Http\Controllers\SuperAdmin\UsereditProfilerController::class, 'edit'])->name('editprofiler');
    Route::post('userupdateprofiler/{id}', [App\Http\Controllers\SuperAdmin\UsereditProfilerController::class, 'update'])->name('update_profile_super');

    Route::get('get-user-form-access/{id}', [App\Http\Controllers\SuperAdmin\UserControllerSuperAdmin::class, 'getUserFormAccess'])->name('get_user_form_access');
    Route::post('update-user-form-access/updateReportViewAccess', [App\Http\Controllers\SuperAdmin\UserControllerSuperAdmin::class, 'updateUserFormAccess'])->name('status.update.user.report');
});

Route::group(['middleware' => ["is_admin"], "prefix" => "admin"], function () {
    Route::get('dashboard', [HomeAdminController::class, 'adminHome'])->name('dashboard-admin');
    Route::post('user-status/update', [App\Http\Controllers\Admin\LocationControllerAdmin::class, 'update_status_location'])->name('status.update.admin.location');
    Route::post('user-status/status/update', [App\Http\Controllers\Admin\QuestionsControllerAdmin::class, 'update_status_questions_admin'])->name('status.update.admin.questions');
    Route::get('profiler', [App\Http\Controllers\Admin\AdminProfilerController::class, 'edit_profiler'])->name('admin-profiler');
    Route::post('update-profiler/{id}', [App\Http\Controllers\Admin\AdminProfilerController::class, 'update_profiler'])->name('admin-update');
    Route::post('change-password-Profile/{id}', [App\Http\Controllers\Admin\AdminProfilerController::class, 'change_password_Profile'])->name('change_password_Profile');   
    Route::resource('user_projects', App\Http\Controllers\Admin\AdminProjectsController::class);
    Route::post('user_project-status/update', [App\Http\Controllers\Admin\AdminProjectsController::class, 'update_status_project'])->name('status.update.user_project');
   
    Route::get('webformReport', [App\Http\Controllers\Admin\WebFormController::class, 'webformReport'])->name('webformReport');
 

    Route::get('webform/{slug?}', [App\Http\Controllers\Admin\WebFormController::class, 'webform'])->name('webform');
    Route::get('view-pre-start-meeting/{id}', [App\Http\Controllers\Admin\WebFormController::class, 'viewPreStartMeeting'])->name('view-pre-start-meeting');
    Route::get('view-tool-box-record/{id}', [App\Http\Controllers\Admin\WebFormController::class, 'viewToolBoxTalkRecord'])->name('view-tool-box-record');
    Route::get('/view-site-safety-inspection/{id}', [App\Http\Controllers\Admin\WebFormController::class, 'siteSafeInspectionReportsPdf'])->name('view-site-safety-inspection');
    Route::post('/siteSafeInspectionUserResendMail', [App\Http\Controllers\Admin\WebFormController::class, 'siteSafeInspectionUserResendMail'])->name('siteSafeInspectionUserResendMail');
    Route::get('/view-site-induction/{id}', [App\Http\Controllers\Admin\WebFormController::class, 'siteInductionPdf'])->name('view-site-induction');
    Route::post('/siteInductionResendMail', [App\Http\Controllers\Admin\WebFormController::class, 'siteInductionResendMail'])->name('siteInductionResendMail');
    Route::get('/view-site-induction-test-plan/{id}', [App\Http\Controllers\Admin\WebFormController::class, 'siteInductionTestPlanPdf'])->name('view-site-induction-test-plan');
    Route::post('/siteInductionTestPlanResendMail', [App\Http\Controllers\Admin\WebFormController::class, 'siteInductionTestPlanResendMail'])->name('siteInductionTestPlanResendMail');
    Route::get('/view-supplier-contractor-evalution/{id}', [App\Http\Controllers\Admin\WebFormController::class, 'supplierContractorEvalutionPdf'])->name('view-supplier-contractor-evalution');
    Route::get('/view-supplier-contractor-car/{id}', [App\Http\Controllers\Admin\WebFormController::class, 'supplierContractorCarPdf'])->name('view-supplier-contractor-car');

    Route::get('/view-contractor-pre-start-checklist/{id}', [App\Http\Controllers\Admin\WebFormController::class, 'contractPreStartChecklist'])->name('view-contractor-pre-start-checklist');
    Route::get('/view-contractor-pre-start-checklist-attach/{id}', [App\Http\Controllers\Admin\WebFormController::class, 'contractPreStartChecklistAttach'])->name('view-contractor-pre-start-checklist-attach');



    Route::resource('user_programs', App\Http\Controllers\Admin\AdminProgramsController::class);
    Route::resource('user_diaries', App\Http\Controllers\Admin\AdminDiariesController::class);
    Route::post('user_programUpdate/{id}', [App\Http\Controllers\Admin\AdminProgramsController::class, 'update'])->name('user_programUpdate');
    Route::get('/user_fetch_program', [App\Http\Controllers\Admin\AdminProgramsController::class, 'fetch_program'])->name('user_fetch_program');
    Route::get('/user_fetch_diary_program', [App\Http\Controllers\Admin\AdminDiariesController::class, 'fetch_diary_program'])->name('user_fetch_diary_program');
    Route::post('user_diaryUpdate/{id}', [App\Http\Controllers\Admin\AdminDiariesController::class, 'update'])->name('user_diaryUpdate');
    Route::delete('/user_diaryEmpDelete/{id}', [App\Http\Controllers\Admin\AdminDiariesController::class, 'destroyEmp'])->name('user_diaryEmpDelete');
    Route::delete('/user_diaryImageDelete/{id}', [App\Http\Controllers\Admin\AdminDiariesController::class, 'destroyImage'])->name('user_diaryImageDelete');

});



Auth::routes();
