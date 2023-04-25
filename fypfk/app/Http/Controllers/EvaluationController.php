<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    public function loadEvaluation()
    {
        return view('evaluation.evaluationinfo'); 
    }
}
