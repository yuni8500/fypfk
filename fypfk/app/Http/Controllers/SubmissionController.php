<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public function loadSubmission()
    {
        return view('submission.projectsubmit'); 
    }

    public function viewSubmission()
    {
        return view('submission.displaysubmit'); 
    }
}
