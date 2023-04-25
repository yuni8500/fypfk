<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function loadReport()
    {
        return view('reporting.projectreport'); 
    }
}
