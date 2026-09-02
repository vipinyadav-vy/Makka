<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\WebFormController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\ProgramController;

Route::get('unauthorized', function () {
    return response()->json(['statusCode' => 401, 'status' => 'unauthorized', 'message' => 'unauthorized user']);
})->name('api.unauthorized');

Route::middleware('auth:createuser')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('get_user_profile', 'getUserProfile');
        Route::post('update_user_profile', 'updateUserProfile');
    });
});

Route::middleware('throttle:mobile-login')->group(function () {
    Route::post('/userLogin', [AuthController::class, 'userLogin']);
});

Route::middleware('throttle:mobile-api')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('/userWebFormAccess', 'userWebFormAccess');
        Route::post('/userWebFormAccessStatusUpdate', 'userWebFormAccessStatusUpdate');
    });

    Route::get('webFormList', [WebFormController::class, 'webFormList']);
    Route::post('changeWebFormStatus', [WebFormController::class, 'changeWebFormStatus']);
    Route::post('updateWebForm', [WebFormController::class, 'updateWebForm']);

    Route::get('userList', [UserController::class, 'userList']);
    Route::post('addUser', [UserController::class, 'addUser']);
    Route::post('changeUserStatus', [UserController::class, 'changeUserStatus']);
    Route::post('updateUser', [UserController::class, 'updateUser']);

    Route::get('projectList', [ProjectController::class, 'projectList']);
    Route::post('createProject', [ProjectController::class, 'createProject']);
    Route::post('editProject', [ProjectController::class, 'editProject']);
    Route::post('updateProject', [ProjectController::class, 'updateProject']);
    Route::post('changeProjectStatus', [ProjectController::class, 'changeProjectStatus']);

    Route::post('siteInductionRecordSave', [WebFormController::class, 'siteInductionRecordSave']);
    Route::post('toolBoxTalkRecordSave', [WebFormController::class, 'toolBoxTalkRecordSave']);
    Route::post('preStartRecordSave', [WebFormController::class, 'preStartRecordSave']);
    Route::post('inspectionTestPlanRecordSave', [WebFormController::class, 'inspectionTestPlanRecordSave']);
    Route::post('supplierContractorCarSave', [WebFormController::class, 'supplierContractorCarSave']);

    Route::post('siteInductionRecord', [WebFormController::class, 'siteInductionRecord']);
    Route::post('siteSafetInspectionRecord', [WebFormController::class, 'siteSafetInspectionRecord']);
    Route::post('preStartRecord', [WebFormController::class, 'preStartRecord']);
    Route::post('toolBoxTalkRecords', [WebFormController::class, 'toolBoxTalkRecords']);
    Route::post('inspectionTestPlan', [WebFormController::class, 'inspectionTestPlan']);
    Route::post('supplierContractorCar', [WebFormController::class, 'supplierContractorCar']);
    Route::post('preStartChecklist', [WebFormController::class, 'preStartChecklist']);
    Route::post('contractorEvaluation', [WebFormController::class, 'contractorEvaluation']);
    Route::post('contractorEvaluationAttachment', [WebFormController::class, 'contractorEvaluationAttachment']);
    Route::post('contractPreStartChecklistAttach', [WebFormController::class, 'contractPreStartChecklistAttach']);

    Route::post('addProgram', [ProgramController::class, 'addProgram']);
    Route::post('programDetails', [ProgramController::class, 'programDetails']);
    Route::post('programUpdate', [ProgramController::class, 'programUpdate']);

    Route::post('addDiary', [ProgramController::class, 'addDiary']);
    Route::post('diaryDetails', [ProgramController::class, 'diaryDetails']);
    Route::post('diaryUpdate', [ProgramController::class, 'diaryUpdate']);
});
