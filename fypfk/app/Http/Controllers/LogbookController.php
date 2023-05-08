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

        $logbookview = DB::table('logbook')
                ->where('superviseeID', $id)
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

                return view('logbook.addlogbook', compact('getdata'));
    }

    public function insertLogbook(Request $request)
    {
        $id = Auth::user()->id;

        $supervisorID = $request->input('supervisorID');
        $week = $request->input('week');
        $dateLog = $request->input('dateLog');
        $tStart = $request->input('tStart');
        $tEnd = $request->input('tEnd');
        $progress = $request->input('progress');


        $data = array(
            'superviseeID' => $id,
            'supervisorID' => $supervisorID,
            'weekLog' => $week,
            'dateLog' => $dateLog,
            'timeStart' => $tStart,
            'timeEnd' => $tEnd,
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
                ->where('id', $id)
                ->get();
            return view('logbook.editlogbook', compact('logbookview')); 
    }

    public function updateLogbook(Request $request, $id) //updatelogbook in database
    {
        $updateLog = logbook::find($id); //model name

        $updateLog->weekLog = $request->input('week');
        $updateLog->dateLog = $request->input('dateLog'); //blue from name input value
        $updateLog->timeStart = $request->input('tStart');
        $updateLog->timeEnd = $request->input('tEnd');
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
        $studentName = DB::table('users')
                ->where('id', $id)
                ->first();

        $superviseeLogbook = DB::table('logbook')
                            ->join('users', 'users.id', '=', 'logbook.superviseeID')
                            ->select([
                                'users.id AS userID',
                                'logbook.id AS logbookID', 'users.*', 'logbook.*'
                            ])
                            ->where('logbook.superviseeID', $id)
                            ->get();
        
        $logbookUpdate = DB::table('logbook')
                        ->where('approval', 'In Progress')
                        ->exists();

            return view('logbook.superviseeviewlog', compact('studentName', 'superviseeLogbook', 'logbookUpdate')); 
    }

    public function logbookEditSupervisee($id) //view updatelogbook page
    {
        $logbookdata = DB::table('logbook')
                        ->join('users', 'users.id', '=', 'logbook.superviseeID')
                        ->select([
                            'users.id AS userID',
                            'logbook.id AS logbookID', 'users.*', 'logbook.*'
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
}
