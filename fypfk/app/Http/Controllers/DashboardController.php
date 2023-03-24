<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //authorize session from user type
    public function loadDashboard()
    {
        $category = Auth::user()->category;

        if ($category == 'Student') {
            $id = Auth::user()->id;

            //if student info exists in the table 
            if (DB::table('infoprofile')
                ->where('userID', $id)
                ->exists()
            ) {
                return view('dashboard.student');
            } else {
                return view('student.profile');
            }
        }
        if ($category == 'Staff') {
            return view('dashboard.staff');
        }
        if ($category == 'Admin') {
            //dd(Auth::user()->id);
            return view('dashboard.admin');
        }
    }
}
