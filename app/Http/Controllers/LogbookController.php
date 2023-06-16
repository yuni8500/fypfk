<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\logbook;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LogbookController extends Controller
{
    public function loadLogbook()
    {
        $id = Auth::user()->id;

        //$logbookview = DB::table('logbook')
               // ->where('superviseeID', $id)
                //->get();

        $logbookview = DB::table('logbook')
                ->join('appointment', 'appointment.id', '=', 'logbook.appointmentID')
                ->select([
                    'appointment.id AS appointmentID',
                    'logbook.id AS logbookID', 'appointment.*', 'logbook.*'
                ])
                ->where('logbook.superviseeID', $id)
                ->get();

            return view('logbook.supervisorlb', compact('logbookview')); 
    }

    public function logbookAdd()
    {

        $id = Auth::user()->id;

        $getdata = DB::table('supervisorapply')
                ->join('users', 'users.id', '=', 'supervisorapply.supervisorID')
                ->select([
                    'users.id AS userID',
                    'supervisorapply.id AS applyID', 'users.*', 'supervisorapply.*'
                ])
                ->where('supervisorapply.superviseeID', $id)
                ->get();

        $appointmentData = DB::table('appointment')
                ->where('superviseeID', $id)
                ->where('statusAppoint', 'Approved')
                ->whereNotIn('id', function($query) {
                        $query->select('appointmentID')->from('logbook');
                })
                ->get();

                return view('logbook.addlogbook', compact('getdata', 'appointmentData'));
    }

    public function insertLogbook(Request $request)
    {
        $id = Auth::user()->id;

        $supervisorID = $request->input('supervisorID');
        $appointmentID = $request->input('date');
        $progress = $request->input('progress');


        $data = array(
            'superviseeID' => $id,
            'supervisorID' => $supervisorID,
            'appointmentID' => $appointmentID,
            'progress' => $progress,
            'approval' => "In Progress",
        );

        // insert query
        DB::table('logbook')->insert($data);

        return redirect()->back()->with('message', 'Logbook Record Successfully');
    }

    public function logbookEdit($id) //view updatelogbook page
    {
        $logbookview = DB::table('logbook')
                    ->join('appointment', 'appointment.id', '=', 'logbook.appointmentID')
                    ->select([
                        'appointment.id AS appointmentID',
                        'logbook.id AS logbookID', 'appointment.*', 'logbook.*'
                        ])
                    ->where('logbook.id', $id)
                    ->get();

            return view('logbook.editlogbook', compact('logbookview')); 
    }

    public function updateLogbook(Request $request, $id) //updatelogbook in database
    {
        $updateLog = logbook::find($id); //model name

        $updateLog->progress = $request->input('progress');

        $updateLog->update();

        return redirect()->back()->with('message', 'Logbook Updated Successfully');
    }

    public function logbookDelete($id) //updatelogbook in database
    {
        $deleteLog = logbook::find($id); //model name
        
        if ($deleteLog) {
            // If the record exists, delete it
            $deleteLog->delete();
        }

        return redirect()->route('logbook');

    }

    //supervisor//
    public function logbookSupervisee()
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

        return view('logbook.listsuperviseelogbook', compact('pta1', 'pta2', 'psm1', 'psm2', 'pta1exist', 'pta2exist', 'psm1exist', 'psm2exist')); 
    }

    public function logbookSuperviseeView($id)
    {
        $category = Auth::user()->category;

        $studentName = DB::table('users')
                ->where('id', $id)
                ->first();

        //staff//
        $superviseeLogbook = DB::table('logbook')
                            ->join('appointment', 'appointment.id', '=', 'logbook.appointmentID')
                            ->select([
                                'appointment.id AS appointID', 
                                'logbook.id AS logbookID', 'appointment.*', 'logbook.*'
                            ])
                            ->where('logbook.superviseeID', $id)
                            ->get();
        
        $logbookUpdate = DB::table('logbook')
                        ->where('approval', 'In Progress')
                        ->exists();

        //admin//
        $superviseeLogbookAdmin = DB::table('logbook')
                                ->join('appointment', 'appointment.id', '=', 'logbook.appointmentID')
                                ->select([
                                    'appointment.id AS appointID', 
                                    'logbook.id AS logbookID', 'appointment.*', 'logbook.*'
                                ])
                                ->where('logbook.superviseeID', $id)
                                ->where('logbook.approval', 'Approved')
                                ->get();

        if ($category == 'Staff') {
            return view('logbook.superviseeviewlog', compact('studentName', 'superviseeLogbook', 'logbookUpdate'));
        }

        if ($category == 'Admin') {
            return view('logbook.superviseeviewlog', compact('studentName', 'superviseeLogbookAdmin'));
        }
    }

    public function logbookEditSupervisee($id) //view updatelogbook page
    {
        $logbookdata = DB::table('logbook')
                        ->join('users', 'users.id', '=', 'logbook.superviseeID')
                        ->join('appointment', 'appointment.id', '=', 'logbook.appointmentID')
                        ->select([
                            'users.id AS userID',
                            'appointment.id AS appointID',
                            'logbook.id AS logbookID', 'users.*', 'appointment.*', 'logbook.*'
                        ])
                        ->where('logbook.id', $id)
                        ->get();

            return view('logbook.editlogSupervisee', compact('logbookdata')); 
    }

    public function updateSuperviseeLogbook(Request $request, $id) //updatelogbookSupervisee in database
    {
        $updateLog = logbook::find($id); //model name

        $updateLog->comment = $request->input('comment');
        $updateLog->approval = 'Approved'; //blue from name input value

        $updateLog->update();

        return redirect()->back()->with('message', 'Supervisee Logbook Updated Successfully');
    }

    //admin//
    public function logbookAdmin()
    {
        $staff = DB::table('users')
                        ->where('category', 'Staff')
                        ->get();

        return view('logbook.logbookadmin', compact('staff'));     
    }

    public function logbookSuperviseeList($id)
    {
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

        return view('logbook.listsuperviseeadmin', compact('pta1', 'pta2', 'psm1', 'psm2', 'pta1exist', 'pta2exist', 'psm1exist', 'psm2exist')); 
    }
}
