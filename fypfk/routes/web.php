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

Route::get('/profile/{id}', [App\Http\Controllers\ProfileController::class, 'loadProfile'])->name('profile'); //link kat google //function kat controller //panggil route
Route::put('/profileUpdate/{id}', [App\Http\Controllers\ProfileController::class, 'updateProfile'])->name('updateProfile'); //update

Route::get('/supervisorQuota', [App\Http\Controllers\QuotaController::class, 'loadQuota'])->name('quotaSupervisor');

Route::get('/supervisorApplication', [App\Http\Controllers\SupervisorApplicationController::class, 'loadApplication'])->name('applicationform');
Route::post('/insertApplication', [App\Http\Controllers\SupervisorApplicationController::class, 'insertApplication'])->name('insertApplication'); //insert database
Route::get('/supervisorApplicationList', [App\Http\Controllers\SupervisorApplicationController::class, 'applicationList'])->name('applicationList');//supervisor
Route::get('/viewSupervisorApplication/{id}', [App\Http\Controllers\SupervisorApplicationController::class, 'viewApplication'])->name('viewApplication');
Route::put('/updateApplicationAgree/{id}', [App\Http\Controllers\SupervisorApplicationController::class, 'updateApplicationAgree'])->name('updateApplicationAgree');
Route::get('/updateApplicationDisagree/{id}', [App\Http\Controllers\SupervisorApplicationController::class, 'updateApplicationDisagree'])->name('updateApplicationDisagree');
Route::get('/superviseeList', [App\Http\Controllers\SupervisorApplicationController::class, 'superviseeList'])->name('superviseeList');

Route::get('/appointment', [App\Http\Controllers\appointmentController::class, 'loadAppointment'])->name('appointment');
Route::get('/createAppointment', [App\Http\Controllers\appointmentController::class, 'createAppointment'])->name('createAppointment');
Route::post('/insertAppointment', [App\Http\Controllers\appointmentController::class, 'insertAppointment'])->name('insertAppointment');
Route::get('/viewAppointment/{id}', [App\Http\Controllers\appointmentController::class, 'appointmentView'])->name('appointmentView');
Route::put('/updateAppointment/{id}', [App\Http\Controllers\appointmentController::class, 'updateAppointment'])->name('updateAppointment');
Route::get('/deleteAppointment/{id}', [App\Http\Controllers\appointmentController::class, 'deleteAppointment'])->name('deleteAppointment');
Route::get('/appointmentAgreed/{id}', [App\Http\Controllers\appointmentController::class, 'appointmentAgreed'])->name('appointmentAgreed');
Route::put('/updateAppointmentAgree/{id}', [App\Http\Controllers\appointmentController::class, 'updateAppointmentAgree'])->name('updateAppointmentAgree');//supervisor
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
Route::get('/supervisorEvaluation', [App\Http\Controllers\EvaluationController::class, 'supervisorEvaluation'])->name('supervisorEvaluation');

Route::get('/reporting', [App\Http\Controllers\ReportController::class, 'loadReport'])->name('report');
Route::get('/reportListSupervisee', [App\Http\Controllers\ReportController::class, 'reportListSupervisee'])->name('reportListSupervisee');//supervisor
Route::get('/reportSuperviseeView/{id}', [App\Http\Controllers\ReportController::class, 'reportSuperviseeView'])->name('reportSuperviseeView');

Route::get('/submission', [App\Http\Controllers\SubmissionController::class, 'loadSubmission'])->name('submission');
Route::get('/viewSubmission', [App\Http\Controllers\SubmissionController::class, 'viewSubmission'])->name('viewSubmission');
Route::get('/viewSuperviseeSubmission', [App\Http\Controllers\SubmissionController::class, 'viewSuperviseeSubmission'])->name('viewSuperviseeSubmission');

Route::get('/fypLibrary', [App\Http\Controllers\FyplibraryController::class, 'loadFypLibrary'])->name('fypLibrary');