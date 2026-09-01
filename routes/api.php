<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiUserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\WebFormController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('unauthorized')->name('api.unauthorized');

Route::get('unauthorized', function () {
    return response()->json(['statusCode' => 401, 'status' => 'unauthorized', 'message' => 'unauthorized user']);
})->name('api.unauthorized');

// AFTER LOGIN ACCESS 
Route::middleware('auth:createuser')->group( function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('get_user_profile','getUserProfile');
        Route::post('update_user_profile','updateUserProfile');
    });
});


 Route::post('login', 'App\Http\Api\ApiUserController@login');

Route::controller(AuthController::class)->group(function () {
        Route::post('/userLogin', 'userLogin');
        Route::post('/userWebFormAccess', 'userWebFormAccess');
        Route::post('/userWebFormAccessStatusUpdate', 'userWebFormAccessStatusUpdate');
});


Route::group(['prefix' => 'auth'], function () {
    Route::middleware('auth:api')->group(function () {
    });
});

Route::get('webFormList', 'App\Http\Controllers\Api\WebFormController@webFormList');
Route::post('changeWebFormStatus', 'App\Http\Controllers\Api\WebFormController@changeWebFormStatus');
Route::post('updateWebForm', 'App\Http\Controllers\Api\WebFormController@updateWebForm');

//User Module
Route::get('userList', 'App\Http\Controllers\Api\UserController@userList');
Route::post('addUser', 'App\Http\Controllers\Api\UserController@addUser'); 
Route::post('changeUserStatus', 'App\Http\Controllers\Api\UserController@changeUserStatus');
Route::post('updateUser', 'App\Http\Controllers\Api\UserController@updateUser');


// Project Module
Route::get('projectList', 'App\Http\Controllers\Api\ProjectController@projectList');
Route::post('createProject', 'App\Http\Controllers\Api\ProjectController@createProject');
Route::post('editProject', 'App\Http\Controllers\Api\ProjectController@editProject'); 
Route::post('updateProject', 'App\Http\Controllers\Api\ProjectController@updateProject');
Route::post('changeProjectStatus', 'App\Http\Controllers\Api\ProjectController@changeProjectStatus');

Route::post('siteInductionRecordSave', 'App\Http\Controllers\Api\WebFormController@siteInductionRecordSave');
// Route::post('siteSafetyInspectionSave', 'App\Http\Controllers\Api\WebFormController@siteSafetyInspectionSave');
Route::post('toolBoxTalkRecordSave', 'App\Http\Controllers\Api\WebFormController@toolBoxTalkRecordSave'); 
Route::post('preStartRecordSave', 'App\Http\Controllers\Api\WebFormController@preStartRecordSave'); 
Route::post('inspectionTestPlanRecordSave', 'App\Http\Controllers\Api\WebFormController@inspectionTestPlanRecordSave'); 
Route::post('supplierContractorCarSave', 'App\Http\Controllers\Api\WebFormController@supplierContractorCarSave'); 



// Reports 
Route::post('siteInductionRecord', 'App\Http\Controllers\Api\WebFormController@siteInductionRecord');
Route::post('siteSafetInspectionRecord', 'App\Http\Controllers\Api\WebFormController@siteSafetInspectionRecord');
Route::post('preStartRecord', 'App\Http\Controllers\Api\WebFormController@preStartRecord');
Route::post('toolBoxTalkRecords', 'App\Http\Controllers\Api\WebFormController@toolBoxTalkRecords');
Route::post('inspectionTestPlan', 'App\Http\Controllers\Api\WebFormController@inspectionTestPlan');
Route::post('supplierContractorCar', 'App\Http\Controllers\Api\WebFormController@supplierContractorCar');
Route::post('preStartChecklist', 'App\Http\Controllers\Api\WebFormController@preStartChecklist');
Route::post('contractorEvaluation', 'App\Http\Controllers\Api\WebFormController@contractorEvaluation');
Route::post('contractorEvaluationAttachment', 'App\Http\Controllers\Api\WebFormController@contractorEvaluationAttachment');
Route::post('contractPreStartChecklistAttach', 'App\Http\Controllers\Api\WebFormController@contractPreStartChecklistAttach');



//Programs
Route::post('addProgram', 'App\Http\Controllers\Api\ProgramController@addProgram');
Route::post('programDetails', 'App\Http\Controllers\Api\ProgramController@programDetails');
Route::post('programUpdate', 'App\Http\Controllers\Api\ProgramController@programUpdate');

Route::post('addDiary', 'App\Http\Controllers\Api\ProgramController@addDiary');
Route::post('diaryDetails', 'App\Http\Controllers\Api\ProgramController@diaryDetails');
Route::post('diaryUpdate', 'App\Http\Controllers\Api\ProgramController@diaryUpdate');

