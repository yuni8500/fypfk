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

        $announcementData = DB::table('announcement')
                            ->get();

        if ($category == 'Student') {
            return view('dashboard.student', compact('announcementData'));
        }
        if ($category == 'Staff') {
            return view('dashboard.staff', compact('announcementData'));
        }
        if ($category == 'Admin') {
            //dd(Auth::user()->id);
            return view('dashboard.admin', compact('announcementData'));
        }
    }
}
