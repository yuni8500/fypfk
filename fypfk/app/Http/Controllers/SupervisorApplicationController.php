<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\supervisorapply;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SupervisorApplicationController extends Controller
{
    public function loadApplication()
    {

        $id = Auth::user()->id;

        $getstudData = DB::table('users')
                    ->where('id', $id)
                    ->get();

        $idexist = DB::table('supervisorapply')
                ->where('superviseeID', $id)
                ->exists();

        //list supervisor name at select
        $supervisorlist = DB::table('users')
                ->where('category', 'Staff')
                ->get();

        $getdata = DB::table('supervisorapply')
                ->join('users', 'users.id', '=', 'supervisorapply.supervisorID')
                ->select([
                    'users.id AS userID',
                    'supervisorapply.id AS applyID', 'users.*', 'supervisorapply.*'
                ])
                ->where('supervisorapply.superviseeID', $id)
                ->get();

                return view('supervisorform.applicationform', compact('getstudData','getdata','idexist', 'supervisorlist'));
            
    }

    public function insertApplication(Request $request)
    {
        $id = Auth::user()->id;

        $supervisorID = $request->input('supervisorName');
        $semester = $request->input('semester');
        $proposedTitle = $request->input('title');
        $problem = $request->input('problem');
        $objective = $request->input('objective');
        $scope = $request->input('scope');
        $domain = $request->input('domain');
        $declaration = $request->input('radio1');


        $data = array(
            'superviseeID' => $id,
            'supervisorID' => $supervisorID,
            'semester' => $semester,
            'proposedTitle' => $proposedTitle,
            'problemStatement' => $problem,
            'objective' => $objective,
            'scope' => $scope,
            'domain' => $domain,
            'declaration' => $declaration,
            'statusApplied' => "In Progress",
        );

        // insert query
        DB::table('supervisorapply')->insert($data);

        return redirect()->back()->with('message', 'Supervisor Application Successfully');
    }

    public function applicationList()
    {
        $id = Auth::user()->id;

        $applicationList = DB::table('supervisorapply')
                ->join('users', 'users.id', '=', 'supervisorapply.superviseeID')
                ->select([
                    'users.id AS userID',
                    'supervisorapply.id AS applyID', 'users.*', 'supervisorapply.*'
                ])
                ->where('supervisorapply.supervisorID', $id)
                ->where('supervisorapply.statusApplied', 'In Progress')
                ->get();
        
        $applicationexist = DB::table('supervisorapply')
                ->where('supervisorID', $id)
                ->where('statusApplied', 'In Progress')
                ->exists();

            return view('supervisorform.applicationlist', compact('applicationList', 'applicationexist'));     
    }

    public function viewApplication($id)
    {
        $studData = DB::table('supervisorapply')
                ->join('users', 'users.id', '=', 'supervisorapply.superviseeID')
                ->select([
                    'users.id AS userID',
                    'supervisorapply.id AS applyID', 'users.*', 'supervisorapply.*'
                ])
                ->where('supervisorapply.id', $id)
                ->get();
        
        $applydata = DB::table('supervisorapply')
                ->join('users', 'users.id', '=', 'supervisorapply.supervisorID')
                ->select([
                    'users.id AS userID',
                    'supervisorapply.id AS applyID', 'users.*', 'supervisorapply.*'
                ])
                ->where('supervisorapply.id', $id)
                ->get();

            return view('supervisorform.viewapplication', compact('studData', 'applydata'));     
    }

    public function updateApplicationAgree(Request $request, $id) //updatelogbook in database
    {
        $updateApplication = supervisorapply::find($id); //model name

        $updateApplication->dateAgree = $request->input('dateApproved'); //blue from name input value
        $updateApplication->statusApplied = 'Approved';

        $updateApplication->update();

        return redirect()->back()->with('message', 'Supervisor Application Updated Successfully');
    }

    public function updateApplicationDisagree(Request $request, $id) //updatelogbook in database
    {
        $updateApplication = supervisorapply::find($id); //model name

        $updateApplication->statusApplied = 'Rejected';

        $updateApplication->update();

        return redirect()->back()->with('message', 'Supervisor Application Updated Successfully');
    }

    public function superviseeList()
    {
        $id = Auth::user()->id;

        $superviseeList = DB::table('supervisorapply')
                ->join('users', 'users.id', '=', 'supervisorapply.superviseeID')
                ->select([
                    'users.id AS userID',
                    'supervisorapply.id AS applyID', 'users.*', 'supervisorapply.*'
                ])
                ->where('supervisorapply.supervisorID', $id)
                ->where('supervisorapply.statusApplied', 'Approved')
                ->get();
        
        return view('supervisorform.superviseelist', compact('superviseeList'));
            
    }
}
