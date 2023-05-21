<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    public function loadEvaluation()
    {
        return view('evaluation.evaluationinfo'); 
    }

    //supervisor//
    public function supervisorEvaluation()
    {
        return view('evaluation.evaluationsupervisor'); 
    }

    public function evaluationGraded()
    {
        return view('evaluation.evaluationgraded'); 
    }
}
