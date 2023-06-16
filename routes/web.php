<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//do not want to display welcome page 
Route::get('/', function () {
    if ($user = Auth::user()) {
        //if login
        return redirect('/dashboard');
    } else {
        //if not login
        return redirect('login');
    }
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'loadDashboard'])->name('dashboard');

Route::get('/createAnnouncement', [App\Http\Controllers\AnnouncementController::class, 'createAnnouncement'])->name('createAnnouncement');
Route::post('/insertAnnouncement', [App\Http\Controllers\AnnouncementController::class, 'insertAnnouncement'])->name('insertAnnouncement'); 
Route::get('/viewAnnouncement/{id}', [App\Http\Controllers\AnnouncementController::class, 'viewAnnouncement'])->name('viewAnnouncement'); 
Route::put('/updateAnnouncement/{id}', [App\Http\Controllers\AnnouncementController::class, 'updateAnnouncement'])->name('updateAnnouncement'); 
Route::get('/deleteAnnouncement/{id}', [App\Http\Controllers\AnnouncementController::class, 'deleteAnnouncement'])->name('deleteAnnouncement');

Route::get('/profile/{id}', [App\Http\Controllers\ProfileController::class, 'loadProfile'])->name('profile'); //link kat google //function kat controller //panggil route
Route::put('/profileUpdate/{id}', [App\Http\Controllers\ProfileController::class, 'updateProfile'])->name('updateProfile'); //update
Route::put('/profileUpdateAdmin/{id}', [App\Http\Controllers\ProfileController::class, 'updateProfileAdmin'])->name('updateProfileAdmin'); //admin//

Route::get('/supervisorQuota', [App\Http\Controllers\QuotaController::class, 'loadQuota'])->name('quotaSupervisor');
Route::get('/createSupervisorQuota', [App\Http\Controllers\QuotaController::class, 'createSupervisorQuota'])->name('createSupervisorQuota');
Route::post('/insertSupervisorQuota', [App\Http\Controllers\QuotaController::class, 'insertSupervisorQuota'])->name('insertSupervisorQuota');
Route::get('/viewSupervisorQuota/{id}', [App\Http\Controllers\QuotaController::class, 'viewSupervisorQuota'])->name('viewSupervisorQuota');
Route::put('/updateSupervisorQuota/{id}', [App\Http\Controllers\QuotaController::class, 'updateSupervisorQuota'])->name('updateSupervisorQuota');
Route::get('/deleteSupervisorQuota/{id}', [App\Http\Controllers\QuotaController::class, 'deleteSupervisorQuota'])->name('deleteSupervisorQuota');
Route::get('/superviseeEmail/{id}', [App\Http\Controllers\QuotaController::class, 'getEmail'])->name('superviseeEmail');//email

Route::get('/supervisorApplication', [App\Http\Controllers\SupervisorApplicationController::class, 'loadApplication'])->name('applicationform');
Route::post('/insertApplication', [App\Http\Controllers\SupervisorApplicationController::class, 'insertApplication'])->name('insertApplication'); //insert database
Route::get('/supervisorApplicationList', [App\Http\Controllers\SupervisorApplicationController::class, 'applicationList'])->name('applicationList');//supervisor
Route::get('/viewSupervisorApplication/{id}', [App\Http\Controllers\SupervisorApplicationController::class, 'viewApplication'])->name('viewApplication');
Route::put('/updateApplicationAgree/{id}', [App\Http\Controllers\SupervisorApplicationController::class, 'updateApplicationAgree'])->name('updateApplicationAgree');
Route::get('/addInfoSupervisorApplication/{id}', [App\Http\Controllers\SupervisorApplicationController::class, 'addRejectInfo'])->name('addRejectInfo');
Route::post('/updateApplicationDisagree/{id}', [App\Http\Controllers\SupervisorApplicationController::class, 'updateApplicationDisagree'])->name('updateApplicationDisagree');
Route::get('/superviseeList', [App\Http\Controllers\SupervisorApplicationController::class, 'superviseeList'])->name('superviseeList');
Route::get('/superviseeListPta2', [App\Http\Controllers\SupervisorApplicationController::class, 'superviseeListPta2'])->name('superviseeListPta2');
Route::get('/superviseeListPsm1', [App\Http\Controllers\SupervisorApplicationController::class, 'superviseeListPsm1'])->name('superviseeListPsm1');
Route::get('/superviseeListPsm2', [App\Http\Controllers\SupervisorApplicationController::class, 'superviseeListPsm2'])->name('superviseeListPsm2');
Route::get('/supervisorApplicationAdmin', [App\Http\Controllers\SupervisorApplicationController::class, 'supervisorApplicationAdmin'])->name('supervisorApplicationAdmin');//admin
Route::put('/updateApplicationAdmin/{id}', [App\Http\Controllers\SupervisorApplicationController::class, 'updateApplicationAdmin'])->name('updateApplicationAdmin');
Route::get('/supervisorApplicationRecord', [App\Http\Controllers\SupervisorApplicationController::class, 'supervisorApplicationRecord'])->name('supervisorApplicationRecord');
Route::post('/supervisorApplicationRecordDisplay', [App\Http\Controllers\SupervisorApplicationController::class, 'supervisorApplicationRecordDisplay'])->name('supervisorApplicationRecordDisplay');
Route::get('/displaySupervisorApplicationRecord/{id}', [App\Http\Controllers\SupervisorApplicationController::class, 'displaySupervisorApplicationRecord'])->name('displaySupervisorApplicationRecord');
Route::get('/supervisorReplacementForm/{id}', [App\Http\Controllers\SupervisorApplicationController::class, 'supervisorReplacement'])->name('supervisorReplacement');
Route::put('/updateSupervisorReplacement/{id}', [App\Http\Controllers\SupervisorApplicationController::class, 'updateSupervisorReplacement'])->name('updateSupervisorReplacement');

Route::get('/appointmentSupervisee', [App\Http\Controllers\appointmentController::class, 'appointmentSupervisee'])->name('appointmentSupervisee');
Route::get('/appointmentApprovalSupervisee', [App\Http\Controllers\appointmentController::class, 'appointmentApprovalSupervisee'])->name('appointmentApprovalSupervisee');
Route::get('/appointmentRejectedSupervisee', [App\Http\Controllers\appointmentController::class, 'appointmentRejectedSupervisee'])->name('appointmentRejectedSupervisee');
Route::get('/displayMeetingSupervisee/{id}', [App\Http\Controllers\appointmentController::class, 'displayMeetingSupervisee'])->name('displayMeetingSupervisee');
Route::get('/appointment', [App\Http\Controllers\appointmentController::class, 'loadAppointment'])->name('appointment');
Route::get('/createAppointment', [App\Http\Controllers\appointmentController::class, 'createAppointment'])->name('createAppointment');
Route::post('/insertAppointment', [App\Http\Controllers\appointmentController::class, 'insertAppointment'])->name('insertAppointment');
Route::get('/viewAppointment/{id}', [App\Http\Controllers\appointmentController::class, 'appointmentView'])->name('appointmentView');
Route::put('/updateAppointment/{id}', [App\Http\Controllers\appointmentController::class, 'updateAppointment'])->name('updateAppointment');
Route::get('/deleteAppointment/{id}', [App\Http\Controllers\appointmentController::class, 'deleteAppointment'])->name('deleteAppointment');
Route::get('/appointmentAgreed/{id}', [App\Http\Controllers\appointmentController::class, 'appointmentAgreed'])->name('appointmentAgreed');
Route::put('/updateAppointmentAgree/{id}', [App\Http\Controllers\appointmentController::class, 'updateAppointmentAgree'])->name('updateAppointmentAgree');
Route::get('/approvalMeeting', [App\Http\Controllers\appointmentController::class, 'approvalMeeting'])->name('approvalMeeting');//supervisor
Route::get('/appointmentReject/{id}', [App\Http\Controllers\appointmentController::class, 'appointmentReject'])->name('appointmentReject');
Route::put('/updateAppointmentReject/{id}', [App\Http\Controllers\appointmentController::class, 'updateAppointmentReject'])->name('updateAppointmentReject');

Route::get('/logbook', [App\Http\Controllers\LogbookController::class, 'loadLogbook'])->name('logbook');
Route::get('/logbookAdd', [App\Http\Controllers\LogbookController::class, 'logbookAdd'])->name('logbookAdd');
Route::post('/insertLogbook', [App\Http\Controllers\LogbookController::class, 'insertLogbook'])->name('insertLogbook');
Route::get('/editLogbook/{id}', [App\Http\Controllers\LogbookController::class, 'logbookEdit'])->name('logbookEdit');
Route::put('/updateLogbook/{id}', [App\Http\Controllers\LogbookController::class, 'updateLogbook'])->name('updateLogbook');
Route::get('/deleteLogbook/{id}', [App\Http\Controllers\LogbookController::class, 'logbookDelete'])->name('logbookDelete'); //delete
Route::get('/logbookSupervisee', [App\Http\Controllers\LogbookController::class, 'logbookSupervisee'])->name('logbookSupervisee');//supervisor
Route::get('/logbookSuperviseeView/{id}', [App\Http\Controllers\LogbookController::class, 'logbookSuperviseeView'])->name('logbookSuperviseeView');
Route::get('/editLogbookSupervisee/{id}', [App\Http\Controllers\LogbookController::class, 'logbookEditSupervisee'])->name('logbookEditSupervisee');
Route::put('/updateSuperviseeLogbook/{id}', [App\Http\Controllers\LogbookController::class, 'updateSuperviseeLogbook'])->name('updateSuperviseeLogbook');
Route::get('/logbookAdmin', [App\Http\Controllers\LogbookController::class, 'logbookAdmin'])->name('logbookAdmin');//admin
Route::get('/logbookSuperviseeList/{id}', [App\Http\Controllers\LogbookController::class, 'logbookSuperviseeList'])->name('logbookSuperviseeList');

Route::get('/mytask', [App\Http\Controllers\TaskController::class, 'loadTask'])->name('task');
Route::get('/createtask', [App\Http\Controllers\TaskController::class, 'createTask'])->name('createTask');
Route::post('/insertTask', [App\Http\Controllers\TaskController::class, 'insertTask'])->name('insertTask');
Route::get('/viewtask/{id}', [App\Http\Controllers\TaskController::class, 'viewTask'])->name('viewTask');
Route::put('/updateTask/{id}', [App\Http\Controllers\TaskController::class, 'updateTask'])->name('updateTask');
Route::get('/deletetask/{id}', [App\Http\Controllers\TaskController::class, 'deleteTask'])->name('deleteTask');
Route::get('/taskListSupervisee', [App\Http\Controllers\TaskController::class, 'taskListSupervisee'])->name('taskListSupervisee');//supervisor
Route::get('/taskSuperviseeView/{id}', [App\Http\Controllers\TaskController::class, 'taskSuperviseeView'])->name('taskSuperviseeView');
Route::get('/createSuperviseeTask/{id}', [App\Http\Controllers\TaskController::class, 'createSuperviseeTask'])->name('createSuperviseeTask');
Route::post('/insertSuperviseeTask/{id}', [App\Http\Controllers\TaskController::class, 'insertSuperviseeTask'])->name('insertSuperviseeTask');
Route::get('/viewtasksupervisee/{id}', [App\Http\Controllers\TaskController::class, 'viewTaskSupervisee'])->name('viewTaskSupervisee');
Route::put('/updateTaskSupervisee/{id}', [App\Http\Controllers\TaskController::class, 'updateTaskSupervisee'])->name('updateTaskSupervisee');
Route::get('/deleteSuperviseeTask/{id}', [App\Http\Controllers\TaskController::class, 'deleteSuperviseeTask'])->name('deleteSuperviseeTask');

Route::get('/evaluation', [App\Http\Controllers\EvaluationController::class, 'loadEvaluation'])->name('evaluation');
Route::get('/supervisorEvaluation', [App\Http\Controllers\EvaluationController::class, 'supervisorEvaluation'])->name('supervisorEvaluation');//supervisor
Route::get('/evaluationGraded/{id}', [App\Http\Controllers\EvaluationController::class, 'evaluationGraded'])->name('evaluationGraded');
Route::post('/insertEvaluationGraded/{id}', [App\Http\Controllers\EvaluationController::class, 'insertEvaluationGraded'])->name('insertEvaluationGraded');
Route::get('/updateEvaluationGraded/{id}', [App\Http\Controllers\EvaluationController::class, 'updateEvaluationGraded'])->name('updateEvaluationGraded');
Route::put('/editEvaluationGraded/{id}', [App\Http\Controllers\EvaluationController::class, 'editEvaluation'])->name('editEvaluation');
Route::get('/evaluationRecordPTA1', [App\Http\Controllers\EvaluationController::class, 'evaluationRecordPTA1'])->name('evaluationRecordPTA1');
Route::get('/evaluationRecordPTA2', [App\Http\Controllers\EvaluationController::class, 'evaluationRecordPTA2'])->name('evaluationRecordPTA2');
Route::get('/evaluationRecordPSM1', [App\Http\Controllers\EvaluationController::class, 'evaluationRecordPSM1'])->name('evaluationRecordPSM1');
Route::get('/evaluationRecordPSM2', [App\Http\Controllers\EvaluationController::class, 'evaluationRecordPSM2'])->name('evaluationRecordPSM2');
Route::get('/superviseeEvaluation/{id}', [App\Http\Controllers\EvaluationController::class, 'superviseeEvaluation'])->name('superviseeEvaluation');
Route::get('/evaluationAdmin', [App\Http\Controllers\EvaluationController::class, 'evaluationAdmin'])->name('evaluationAdmin');//admin
Route::get('/evaluationpta2', [App\Http\Controllers\EvaluationController::class, 'evaluationpta2'])->name('evaluationpta2');
Route::get('/evaluationpsm1', [App\Http\Controllers\EvaluationController::class, 'evaluationpsm1'])->name('evaluationpsm1');
Route::get('/evaluationpsm2', [App\Http\Controllers\EvaluationController::class, 'evaluationpsm2'])->name('evaluationpsm2');
Route::get('/createEvaluation', [App\Http\Controllers\EvaluationController::class, 'createEvaluation'])->name('createEvaluation');
Route::post('/superviseeListData', [App\Http\Controllers\EvaluationController::class, 'superviseeListData'])->name('superviseeListData');
Route::get('/evaluationForm/{id}', [App\Http\Controllers\EvaluationController::class, 'evaluationForm'])->name('evaluationForm');
Route::post('/insertEvaluation', [App\Http\Controllers\EvaluationController::class, 'insertEvaluation'])->name('insertEvaluation');
Route::get('/viewEvaluation/{id}', [App\Http\Controllers\EvaluationController::class, 'viewEvaluation'])->name('viewEvaluation');
Route::put('/updateEvaluation/{id}', [App\Http\Controllers\EvaluationController::class, 'updateEvaluation'])->name('updateEvaluation');
Route::get('/viewEvaluationRecord/{id}', [App\Http\Controllers\EvaluationController::class, 'viewEvaluationRecord'])->name('viewEvaluationRecord');

Route::get('/reporting', [App\Http\Controllers\ReportController::class, 'loadReport'])->name('report');
Route::get('/reportListSupervisee', [App\Http\Controllers\ReportController::class, 'reportListSupervisee'])->name('reportListSupervisee');//supervisor
Route::get('/reportSuperviseeView/{id}', [App\Http\Controllers\ReportController::class, 'reportSuperviseeView'])->name('reportSuperviseeView');
Route::get('/reportingFYP', [App\Http\Controllers\ReportController::class, 'reportingFYP'])->name('reportingFYP');//admin
Route::post('/fypReportAdmin', [App\Http\Controllers\ReportController::class, 'fypReportAdmin'])->name('fypReportAdmin');
Route::get('/reportingAdmin', [App\Http\Controllers\ReportController::class, 'reportingAdmin'])->name('reportingAdmin');
Route::post('/superviseeList', [App\Http\Controllers\ReportController::class, 'superviseeList'])->name('superviseeList');

Route::get('/submission', [App\Http\Controllers\SubmissionController::class, 'loadSubmission'])->name('submission');
Route::get('/viewSubmission/{id}', [App\Http\Controllers\SubmissionController::class, 'viewSubmission'])->name('viewSubmission');
Route::post('/insertSuperviseeSubmission/{id}', [App\Http\Controllers\SubmissionController::class, 'insertSuperviseeSubmission'])->name('insertSuperviseeSubmission');
Route::put('/updateSuperviseeSubmission/{id}', [App\Http\Controllers\SubmissionController::class, 'updateSuperviseeSubmission'])->name('updateSuperviseeSubmission');
Route::get('/viewFinalSubmission/{id}', [App\Http\Controllers\SubmissionController::class, 'viewFinalSubmission'])->name('viewFinalSubmission');
Route::post('/insertFinalSubmission/{id}', [App\Http\Controllers\SubmissionController::class, 'insertFinalSubmission'])->name('insertFinalSubmission');
Route::put('/updateFinalSubmission/{id}', [App\Http\Controllers\SubmissionController::class, 'updateFinalSubmission'])->name('updateFinalSubmission');
Route::post('/viewSuperviseeSubmission/{id}', [App\Http\Controllers\SubmissionController::class, 'viewSuperviseeSubmission'])->name('viewSuperviseeSubmission'); //supervisor
Route::get('/submissionGraded/{userID}/{submissionID}', [App\Http\Controllers\SubmissionController::class, 'submissionGraded'])->name('submissionGraded');
Route::put('/updateGradedSubmission/{id}', [App\Http\Controllers\SubmissionController::class, 'updateGradedSubmission'])->name('updateGradedSubmission');
Route::get('/editGradedSubmission/{userID}/{submissionID}', [App\Http\Controllers\SubmissionController::class, 'editGradedSubmission'])->name('editGradedSubmission');
Route::get('/createSubmission', [App\Http\Controllers\SubmissionController::class, 'createSubmission'])->name('createSubmission'); //admin
Route::post('/insertSubmission', [App\Http\Controllers\SubmissionController::class, 'insertSubmission'])->name('insertSubmission');
Route::get('/editSubmission/{id}', [App\Http\Controllers\SubmissionController::class, 'editSubmission'])->name('editSubmission');
Route::put('/updateSubmission/{id}', [App\Http\Controllers\SubmissionController::class, 'updateSubmission'])->name('updateSubmission');
Route::get('/deleteSubmission/{id}', [App\Http\Controllers\SubmissionController::class, 'deleteSubmission'])->name('deleteSubmission');
Route::post('/viewSubmissionAdmin/{id}', [App\Http\Controllers\SubmissionController::class, 'viewSubmissionAdmin'])->name('viewSubmissionAdmin');
Route::get('/viewSubmissionStudent/{userID}/{submissionID}', [App\Http\Controllers\SubmissionController::class, 'viewSubmissionStudent'])->name('viewSubmissionStudent');
Route::get('/viewFinalSubmissionStudent/{userID}/{submissionID}', [App\Http\Controllers\SubmissionController::class, 'viewFinalSubmissionStudent'])->name('viewFinalSubmissionStudent');

Route::get('/fypLibrary', [App\Http\Controllers\FyplibraryController::class, 'loadFypLibrary'])->name('fypLibrary');