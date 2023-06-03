<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function loadReport()
    {
        $id = Auth::user()->id;

        $countTask = DB::table('task')
                    ->where('superviseeID', $id)
                    ->count();
        //status//
        $countOntrack = DB::table('task')
                        ->select('status', DB::raw('count(*) as count'))
                        ->groupBy('status')
                        ->where('superviseeID', $id)
                        ->where('status', 'On Track')
                        ->first();
        
        $countOfftrack = DB::table('task')
                        ->select('status', DB::raw('count(*) as count'))
                        ->groupBy('status')
                        ->where('superviseeID', $id)
                        ->where('status', 'Off Track')
                        ->first();
        
        $countRisk = DB::table('task')
                        ->select('status', DB::raw('count(*) as count'))
                        ->groupBy('status')
                        ->where('superviseeID', $id)
                        ->where('status', 'Risk')
                        ->first();

        //priority//
        $countHigh = DB::table('task')
                        ->select('priority', DB::raw('count(*) as count'))
                        ->groupBy('priority')
                        ->where('superviseeID', $id)
                        ->where('priority', 'High')
                        ->first();

        $countMedium = DB::table('task')
                        ->select('priority', DB::raw('count(*) as count'))
                        ->groupBy('priority')
                        ->where('superviseeID', $id)
                        ->where('priority', 'Medium')
                        ->first();

        $countLow = DB::table('task')
                        ->select('priority', DB::raw('count(*) as count'))
                        ->groupBy('priority')
                        ->where('superviseeID', $id)
                        ->where('priority', 'Low')
                        ->first();

        //taskCompletion//
        $countComplete = DB::table('task')
                        ->select('progress', DB::raw('count(*) as count'))
                        ->groupBy('progress')
                        ->where('superviseeID', $id)
                        ->where('progress', 'Done')
                        ->first();

        $countIncomplete = DB::table('task')
                        ->select(DB::raw('COUNT(*) as count'))
                        ->where('superviseeID', $id)
                        ->where(function ($query) 
                        {
                            $query  ->where('progress', 'To Do')
                                    ->orWhere('progress', 'Doing');
                        })
                        ->first();

        return view('reporting.projectreport', compact('countTask', 'countOntrack', 'countOfftrack', 'countRisk', 'countHigh', 'countMedium', 'countLow', 'countComplete', 'countIncomplete')); 
    }

    //supervisor//
    public function reportListSupervisee()
    {
        $id = Auth::user()->id;

        $pta1 = DB::table('supervisorapply')
                ->join('users', 'users.id', '=', 'supervisorapply.superviseeID')
                ->select([
                    'users.id AS userID',
                    'supervisorapply.id AS applyID', 'users.*', 'supervisorapply.*'
                ])
                ->where('supervisorapply.supervisorID', $id)
                ->where('supervisorapply.statusApplied', 'Approved')
                ->where('users.course_group', 'PTA 1')
                ->get();

        $pta2 = DB::table('supervisorapply')
                ->join('users', 'users.id', '=', 'supervisorapply.superviseeID')
                ->select([
                    'users.id AS userID',
                    'supervisorapply.id AS applyID', 'users.*', 'supervisorapply.*'
                ])
                ->where('supervisorapply.supervisorID', $id)
                ->where('supervisorapply.statusApplied', 'Approved')
                ->where('users.course_group', 'PTA 2')
                ->get();

        $psm1 = DB::table('supervisorapply')
                ->join('users', 'users.id', '=', 'supervisorapply.superviseeID')
                ->select([
                    'users.id AS userID',
                    'supervisorapply.id AS applyID', 'users.*', 'supervisorapply.*'
                ])
                ->where('supervisorapply.supervisorID', $id)
                ->where('supervisorapply.statusApplied', 'Approved')
                ->where('users.course_group', 'PSM 1')
                ->get();

        $psm2 = DB::table('supervisorapply')
                ->join('users', 'users.id', '=', 'supervisorapply.superviseeID')
                ->select([
                    'users.id AS userID',
                    'supervisorapply.id AS applyID', 'users.*', 'supervisorapply.*'
                ])
                ->where('supervisorapply.supervisorID', $id)
                ->where('supervisorapply.statusApplied', 'Approved')
                ->where('users.course_group', 'PSM 2')
                ->get();
        
        //verification data existing//
        $pta1exist = DB::table('supervisorapply')
                ->join('users', 'users.id', '=', 'supervisorapply.superviseeID')
                ->select([
                    'users.id AS userID',
                    'supervisorapply.id AS applyID', 'users.*', 'supervisorapply.*'
                ])
                ->where('supervisorapply.supervisorID', $id)
                ->where('supervisorapply.statusApplied', 'Approved')
                ->where('users.course_group', 'PTA 1')
                ->exists();

        $pta2exist = DB::table('supervisorapply')
                ->join('users', 'users.id', '=', 'supervisorapply.superviseeID')
                ->select([
                    'users.id AS userID',
                    'supervisorapply.id AS applyID', 'users.*', 'supervisorapply.*'
                ])
                ->where('supervisorapply.supervisorID', $id)
                ->where('supervisorapply.statusApplied', 'Approved')
                ->where('users.course_group', 'PTA 2')
                ->exists();

        $psm1exist = DB::table('supervisorapply')
                ->join('users', 'users.id', '=', 'supervisorapply.superviseeID')
                ->select([
                    'users.id AS userID',
                    'supervisorapply.id AS applyID', 'users.*', 'supervisorapply.*'
                ])
                ->where('supervisorapply.supervisorID', $id)
                ->where('supervisorapply.statusApplied', 'Approved')
                ->where('users.course_group', 'PSM 1')
                ->exists();

        $psm2exist = DB::table('supervisorapply')
                ->join('users', 'users.id', '=', 'supervisorapply.superviseeID')
                ->select([
                    'users.id AS userID',
                    'supervisorapply.id AS applyID', 'users.*', 'supervisorapply.*'
                ])
                ->where('supervisorapply.supervisorID', $id)
                ->where('supervisorapply.statusApplied', 'Approved')
                ->where('users.course_group', 'PSM 2')
                ->exists();

        return view('reporting.listsuperviseereport', compact('pta1', 'pta2', 'psm1', 'psm2', 'pta1exist', 'pta2exist', 'psm1exist', 'psm2exist')); 
    }

    public function reportSuperviseeView($id)
    {
        $studData = DB::table('users')
                ->where('id', $id)
                ->first();
        
        $countTask = DB::table('task')
                    ->where('superviseeID', $id)
                    ->count();

        //status//
        $countOntrack = DB::table('task')
                        ->select('status', DB::raw('count(*) as count'))
                        ->groupBy('status')
                        ->where('superviseeID', $id)
                        ->where('status', 'On Track')
                        ->first();
        
        $countOfftrack = DB::table('task')
                        ->select('status', DB::raw('count(*) as count'))
                        ->groupBy('status')
                        ->where('superviseeID', $id)
                        ->where('status', 'Off Track')
                        ->first();
        
        $countRisk = DB::table('task')
                        ->select('status', DB::raw('count(*) as count'))
                        ->groupBy('status')
                        ->where('superviseeID', $id)
                        ->where('status', 'Risk')
                        ->first();

        //priority//
        $countHigh = DB::table('task')
                        ->select('priority', DB::raw('count(*) as count'))
                        ->groupBy('priority')
                        ->where('superviseeID', $id)
                        ->where('priority', 'High')
                        ->first();

        $countMedium = DB::table('task')
                        ->select('priority', DB::raw('count(*) as count'))
                        ->groupBy('priority')
                        ->where('superviseeID', $id)
                        ->where('priority', 'Medium')
                        ->first();

        $countLow = DB::table('task')
                        ->select('priority', DB::raw('count(*) as count'))
                        ->groupBy('priority')
                        ->where('superviseeID', $id)
                        ->where('priority', 'Low')
                        ->first();

        //taskCompletion//
        $countComplete = DB::table('task')
                        ->select('progress', DB::raw('count(*) as count'))
                        ->groupBy('progress')
                        ->where('superviseeID', $id)
                        ->where('progress', 'Done')
                        ->first();

        $countIncomplete = DB::table('task')
                        ->select(DB::raw('COUNT(*) as count'))
                        ->where('superviseeID', $id)
                        ->where(function ($query) 
                        {
                            $query  ->where('progress', 'To Do')
                                    ->orWhere('progress', 'Doing');
                        })
                        ->first();

        return view('reporting.superviseereport', compact('studData', 'countTask', 'countOntrack', 'countOfftrack', 'countRisk', 'countHigh', 'countMedium', 'countLow', 'countComplete', 'countIncomplete')); 
    }

    //admin//
    public function reportingAdmin()
    {
        $staff = DB::table('users')
                ->where('category', 'Staff')
                ->get();

        $pta1 = false;
        $pta2 = false;
        $psm1 = false;
        $psm2 = false;
        $pta1exist = false;
        $pta2exist = false;
        $psm1exist = false;
        $psm2exist = false;
    
        return view('reporting.adminreport', compact('staff', 'pta1', 'pta2', 'psm1', 'psm2', 'pta1exist', 'pta2exist', 'psm1exist', 'psm2exist')); 
    }

    public function superviseeList(Request $request)
    {
        $staff = DB::table('users')
                ->where('category', 'Staff')
                ->get();

        $staffID = $request->input('staffName');

        $pta1 = DB::table('supervisorapply')
                ->join('users', 'users.id', '=', 'supervisorapply.superviseeID')
                ->select([
                    'users.id AS userID',
                    'supervisorapply.id AS applyID', 'users.*', 'supervisorapply.*'
                ])
                ->where('supervisorapply.supervisorID', $staffID)
                ->where('supervisorapply.statusApplied', 'Approved')
                ->where('users.course_group', 'PTA 1')
                ->get();

        $pta2 = DB::table('supervisorapply')
                ->join('users', 'users.id', '=', 'supervisorapply.superviseeID')
                ->select([
                    'users.id AS userID',
                    'supervisorapply.id AS applyID', 'users.*', 'supervisorapply.*'
                ])
                ->where('supervisorapply.supervisorID', $staffID)
                ->where('supervisorapply.statusApplied', 'Approved')
                ->where('users.course_group', 'PTA 2')
                ->get();

        $psm1 = DB::table('supervisorapply')
                ->join('users', 'users.id', '=', 'supervisorapply.superviseeID')
                ->select([
                    'users.id AS userID',
                    'supervisorapply.id AS applyID', 'users.*', 'supervisorapply.*'
                ])
                ->where('supervisorapply.supervisorID', $staffID)
                ->where('supervisorapply.statusApplied', 'Approved')
                ->where('users.course_group', 'PSM 1')
                ->get();

        $psm2 = DB::table('supervisorapply')
                ->join('users', 'users.id', '=', 'supervisorapply.superviseeID')
                ->select([
                    'users.id AS userID',
                    'supervisorapply.id AS applyID', 'users.*', 'supervisorapply.*'
                ])
                ->where('supervisorapply.supervisorID', $staffID)
                ->where('supervisorapply.statusApplied', 'Approved')
                ->where('users.course_group', 'PSM 2')
                ->get();
        
        //verification data existing//
        $pta1exist = DB::table('supervisorapply')
                ->join('users', 'users.id', '=', 'supervisorapply.superviseeID')
                ->select([
                    'users.id AS userID',
                    'supervisorapply.id AS applyID', 'users.*', 'supervisorapply.*'
                ])
                ->where('supervisorapply.supervisorID', $staffID)
                ->where('supervisorapply.statusApplied', 'Approved')
                ->where('users.course_group', 'PTA 1')
                ->exists();

        $pta2exist = DB::table('supervisorapply')
                ->join('users', 'users.id', '=', 'supervisorapply.superviseeID')
                ->select([
                    'users.id AS userID',
                    'supervisorapply.id AS applyID', 'users.*', 'supervisorapply.*'
                ])
                ->where('supervisorapply.supervisorID', $staffID)
                ->where('supervisorapply.statusApplied', 'Approved')
                ->where('users.course_group', 'PTA 2')
                ->exists();

        $psm1exist = DB::table('supervisorapply')
                ->join('users', 'users.id', '=', 'supervisorapply.superviseeID')
                ->select([
                    'users.id AS userID',
                    'supervisorapply.id AS applyID', 'users.*', 'supervisorapply.*'
                ])
                ->where('supervisorapply.supervisorID', $staffID)
                ->where('supervisorapply.statusApplied', 'Approved')
                ->where('users.course_group', 'PSM 1')
                ->exists();

        $psm2exist = DB::table('supervisorapply')
                ->join('users', 'users.id', '=', 'supervisorapply.superviseeID')
                ->select([
                    'users.id AS userID',
                    'supervisorapply.id AS applyID', 'users.*', 'supervisorapply.*'
                ])
                ->where('supervisorapply.supervisorID', $staffID)
                ->where('supervisorapply.statusApplied', 'Approved')
                ->where('users.course_group', 'PSM 2')
                ->exists();
    
        return view('reporting.adminreport', compact('staff', 'pta1', 'pta2', 'psm1', 'psm2', 'pta1exist', 'pta2exist', 'psm1exist', 'psm2exist'));     
    }
}
