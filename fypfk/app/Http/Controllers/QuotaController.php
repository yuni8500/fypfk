<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuotaController extends Controller
{
    public function loadQuota()
    {
        return view('quota.supervisorquota'); 
    }
}
