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

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'loadDashboard'])->name('dashboard');

Route::get('/profile/{id}', [App\Http\Controllers\ProfileController::class, 'loadProfile'])->name('profile'); //link kat google //function kat controller //panggil route

Route::put('/profileUpdate/{id}', [App\Http\Controllers\ProfileController::class, 'updateProfile'])->name('updateProfile'); //update

Route::get('/supervisorQuota', [App\Http\Controllers\QuotaController::class, 'loadQuota'])->name('quotaSupervisor');

Route::get('/supervisorApplication', [App\Http\Controllers\SupervisorApplicationController::class, 'loadApplication'])->name('applicationform');
Route::post('/insertApplication', [App\Http\Controllers\SupervisorApplicationController::class, 'insertApplication'])->name('insertApplication'); //insert database

Route::get('/appointment', [App\Http\Controllers\appointmentController::class, 'loadAppointment'])->name('appointment');

Route::get('/logbook', [App\Http\Controllers\LogbookController::class, 'loadLogbook'])->name('logbook');
Route::get('/logbookAdd', [App\Http\Controllers\LogbookController::class, 'logbookAdd'])->name('logbookAdd');
Route::post('/insertLogbook', [App\Http\Controllers\LogbookController::class, 'insertLogbook'])->name('insertLogbook');
Route::get('/editLogbook/{id}', [App\Http\Controllers\LogbookController::class, 'logbookEdit'])->name('logbookEdit');
Route::put('/updateLogbook/{id}', [App\Http\Controllers\LogbookController::class, 'updateLogbook'])->name('updateLogbook');
Route::get('/deleteLogbook/{id}', [App\Http\Controllers\LogbookController::class, 'logbookDelete'])->name('logbookDelete'); //delete

Route::get('/mytask', [App\Http\Controllers\TaskController::class, 'loadTask'])->name('task');
Route::get('/createtask', [App\Http\Controllers\TaskController::class, 'createTask'])->name('createTask');
Route::post('/insertTask', [App\Http\Controllers\TaskController::class, 'insertTask'])->name('insertTask');
Route::get('/viewtask/{id}', [App\Http\Controllers\TaskController::class, 'viewTask'])->name('viewTask');
Route::put('/updateTask/{id}', [App\Http\Controllers\TaskController::class, 'updateTask'])->name('updateTask');
Route::get('/deletetask/{id}', [App\Http\Controllers\TaskController::class, 'deleteTask'])->name('deleteTask');

Route::get('/evaluation', [App\Http\Controllers\EvaluationController::class, 'loadEvaluation'])->name('evaluation');

Route::get('/reporting', [App\Http\Controllers\ReportController::class, 'loadReport'])->name('report');

Route::get('/submission', [App\Http\Controllers\SubmissionController::class, 'loadSubmission'])->name('submission');
Route::get('/viewSubmission', [App\Http\Controllers\SubmissionController::class, 'viewSubmission'])->name('viewSubmission');

Route::get('/fypLibrary', [App\Http\Controllers\FyplibraryController::class, 'loadFypLibrary'])->name('fypLibrary');