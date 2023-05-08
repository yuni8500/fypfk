<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubmissionController extends Controller
{
    public function loadSubmission()
    {
        return view('submission.projectsubmit'); 
    }

    public function viewSubmission()
    {
        $id = Auth::user()->id;

        $superviseedata = DB::table('supervisorapply')
                        ->join('users', 'users.id', '=', 'supervisorapply.superviseeID')
                        ->select([
                            'users.id AS userID',
                            'supervisorapply.id AS applyID', 'users.*', 'supervisorapply.*'
                            ])
                        ->where('supervisorapply.supervisorID', $id)
                        ->where('supervisorapply.statusApplied', 'Approved')
                        ->get();

        return view('submission.displaysubmit', compact('superviseedata')); 
    }

    public function viewSuperviseeSubmission()
    {
        $id = Auth::user()->id;
        
        $superviseedata = DB::table('supervisorapply')
                        ->join('users', 'users.id', '=', 'supervisorapply.superviseeID')
                        ->select([
                            'users.id AS userID',
                            'supervisorapply.id AS applyID', 'users.*', 'supervisorapply.*'
                            ])
                        ->where('supervisorapply.supervisorID', $id)
                        ->where('supervisorapply.statusApplied', 'Approved')
                        ->get();

        return view('submission.superviseesubmission', compact('superviseedata')); 
    }
}
