<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\supervisorapply;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
        $category = Auth::user()->category;

        if ($category == 'Staff') {

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

            $currentDate = Carbon::now()->format('Y-m-d');

            return view('supervisorform.viewapplication', compact('studData', 'applydata', 'currentDate'));
        }
        if ($category == 'Admin') {

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

            $currentDate = Carbon::now()->format('Y-m-d');

            $staffData = DB::table('users')
                ->where('category', 'Staff')
                ->get();

            return view('supervisorform.viewapplication', compact('studData', 'applydata', 'currentDate', 'staffData'));
        }    
    }

    public function updateApplicationAgree(Request $request, $id) //updatelogbook in database
    {
        $updateApplication = supervisorapply::find($id); //model name

        $updateApplication->dateAgree = $request->input('dateApproved'); //blue from name input value
        $updateApplication->statusApplied = 'Approved';

        $updateApplication->update();

        return redirect()->back()->with('message', 'Supervisor Application Updated Successfully');
    }

    public function addRejectInfo($id)
    {
        $idApply = DB::table('supervisorapply')
                ->join('users', 'users.id', '=', 'supervisorapply.supervisorID')
                ->select([
                    'users.id AS userID',
                    'supervisorapply.id AS applyID', 'users.*', 'supervisorapply.*'
                ])
                ->where('supervisorapply.id', $id)
                ->first();

            return view('supervisorform.additionalApplication', compact('idApply'));     
    }

    public function updateApplicationDisagree(Request $request, $id) //updatelogbook in database
    {
        $updateApplication = supervisorapply::find($id); //model name

        $updateApplication->statusApplied = 'Rejected';
        $updateApplication->reasonReject = $request->input('reason');

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
                        ->where('users.course_group', 'PTA 1')
                        ->get();

        $pta1Exist = DB::table('supervisorapply')
                        ->join('users', 'users.id', '=', 'supervisorapply.superviseeID')
                        ->select([
                            'users.id AS userID',
                            'supervisorapply.id AS applyID', 'users.*', 'supervisorapply.*'
                        ])
                        ->where('supervisorapply.supervisorID', $id)
                        ->where('supervisorapply.statusApplied', 'Approved')
                        ->where('users.course_group', 'PTA 1')
                        ->exists();
        
        return view('supervisorform.superviseelist', compact('superviseeList', 'pta1Exist'));  
    }

    public function superviseeListPta2()
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
                        ->where('users.course_group', 'PTA 2')
                        ->get();

        $pta2Exist = DB::table('supervisorapply')
                        ->join('users', 'users.id', '=', 'supervisorapply.superviseeID')
                        ->select([
                            'users.id AS userID',
                            'supervisorapply.id AS applyID', 'users.*', 'supervisorapply.*'
                        ])
                        ->where('supervisorapply.supervisorID', $id)
                        ->where('supervisorapply.statusApplied', 'Approved')
                        ->where('users.course_group', 'PTA 2')
                        ->exists();
        
        return view('supervisorform.superviseelistpta2', compact('superviseeList', 'pta2Exist'));  
    }

    public function superviseeListPsm1()
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
                        ->where('users.course_group', 'PSM 1')
                        ->get();

        $psm1Exist = DB::table('supervisorapply')
                        ->join('users', 'users.id', '=', 'supervisorapply.superviseeID')
                        ->select([
                            'users.id AS userID',
                            'supervisorapply.id AS applyID', 'users.*', 'supervisorapply.*'
                        ])
                        ->where('supervisorapply.supervisorID', $id)
                        ->where('supervisorapply.statusApplied', 'Approved')
                        ->where('users.course_group', 'PSM 1')
                        ->exists();
        
        return view('supervisorform.superviseelistpsm1', compact('superviseeList', 'psm1Exist'));  
    }

    public function superviseeListPsm2()
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
                        ->where('users.course_group', 'PSM 2')
                        ->get();

        $psm2Exist = DB::table('supervisorapply')
                        ->join('users', 'users.id', '=', 'supervisorapply.superviseeID')
                        ->select([
                            'users.id AS userID',
                            'supervisorapply.id AS applyID', 'users.*', 'supervisorapply.*'
                        ])
                        ->where('supervisorapply.supervisorID', $id)
                        ->where('supervisorapply.statusApplied', 'Approved')
                        ->where('users.course_group', 'PSM 2')
                        ->exists();
        
        return view('supervisorform.superviseelistpsm2', compact('superviseeList', 'psm2Exist'));  
    }

    //admin//
    public function supervisorApplicationAdmin()
    {
        $pta1 = DB::table('supervisorapply')
                ->join('users', 'users.id', '=', 'supervisorapply.superviseeID')
                ->select([
                    'users.id AS userID',
                    'supervisorapply.id AS applyID', 'users.*', 'supervisorapply.*'
                ])
                ->where('supervisorapply.statusApplied', 'Rejected')
                ->where('users.course_group', 'PTA 1')
                ->get();

        $pta2 = DB::table('supervisorapply')
                ->join('users', 'users.id', '=', 'supervisorapply.superviseeID')
                ->select([
                    'users.id AS userID',
                    'supervisorapply.id AS applyID', 'users.*', 'supervisorapply.*'
                ])
                ->where('supervisorapply.statusApplied', 'Rejected')
                ->where('users.course_group', 'PTA 2')
                ->get();

        $psm1 = DB::table('supervisorapply')
                ->join('users', 'users.id', '=', 'supervisorapply.superviseeID')
                ->select([
                    'users.id AS userID',
                    'supervisorapply.id AS applyID', 'users.*', 'supervisorapply.*'
                ])
                ->where('supervisorapply.statusApplied', 'Rejected')
                ->where('users.course_group', 'PSM 1')
                ->get();

        $psm2 = DB::table('supervisorapply')
                ->join('users', 'users.id', '=', 'supervisorapply.superviseeID')
                ->select([
                    'users.id AS userID',
                    'supervisorapply.id AS applyID', 'users.*', 'supervisorapply.*'
                ])
                ->where('supervisorapply.statusApplied', 'Rejected')
                ->where('users.course_group', 'PSM 2')
                ->get();
        
        //verification data existing//
        $pta1exist = DB::table('supervisorapply')
                ->join('users', 'users.id', '=', 'supervisorapply.superviseeID')
                ->select([
                    'users.id AS userID',
                    'supervisorapply.id AS applyID', 'users.*', 'supervisorapply.*'
                ])
                ->where('supervisorapply.statusApplied', 'Rejected')
                ->where('users.course_group', 'PTA 1')
                ->exists();

        $pta2exist = DB::table('supervisorapply')
                ->join('users', 'users.id', '=', 'supervisorapply.superviseeID')
                ->select([
                    'users.id AS userID',
                    'supervisorapply.id AS applyID', 'users.*', 'supervisorapply.*'
                ])
                ->where('supervisorapply.statusApplied', 'Rejected')
                ->where('users.course_group', 'PTA 2')
                ->exists();

        $psm1exist = DB::table('supervisorapply')
                ->join('users', 'users.id', '=', 'supervisorapply.superviseeID')
                ->select([
                    'users.id AS userID',
                    'supervisorapply.id AS applyID', 'users.*', 'supervisorapply.*'
                ])
                ->where('supervisorapply.statusApplied', 'Rejected')
                ->where('users.course_group', 'PSM 1')
                ->exists();

        $psm2exist = DB::table('supervisorapply')
                ->join('users', 'users.id', '=', 'supervisorapply.superviseeID')
                ->select([
                    'users.id AS userID',
                    'supervisorapply.id AS applyID', 'users.*', 'supervisorapply.*'
                ])
                ->where('supervisorapply.statusApplied', 'Rejected')
                ->where('users.course_group', 'PSM 2')
                ->exists();

        return view('supervisorform.applicationrejectedadmin', compact('pta1', 'pta2', 'psm1', 'psm2', 'pta1exist', 'pta2exist', 'psm1exist', 'psm2exist'));
            
    }

    public function updateApplicationAdmin(Request $request, $id) //updatelogbook in database
    {
        $updateApplication = supervisorapply::find($id); //model name

        $updateApplication->supervisorID = $request->input('staffName');
        $updateApplication->dateAgree = $request->input('dateApproved'); //blue from name input value
        $updateApplication->statusApplied = 'Approved';

        $updateApplication->update();

        return redirect()->back()->with('message', 'Supervisor Application Updated Successfully');
    }

    public function supervisorApplicationRecord()
    {
        return view('supervisorform.applicationrecord');     
    }

    public function supervisorApplicationRecordDisplay(Request $request)
    {
        $expertGroup = $request->input('expertGroup');

        $staffdata = DB::table('users')
                    ->where('course_group', $expertGroup)
                    ->get();
    
        return view('supervisorform.applicationrecord', compact('staffdata'));     
    }

    public function displaySupervisorApplicationRecord($id)
    {
        $staff = DB::table('users')
                ->where('id', $id)
                ->first();

        $applydata = DB::table('supervisorapply')
                ->join('users as supervisee', 'supervisorapply.superviseeID', '=', 'supervisee.id')
                ->join('users as supervisor', 'supervisorapply.supervisorID', '=', 'supervisor.id')
                ->select([
                    'supervisorapply.id AS applyID', 'supervisee.*', 'supervisor.*', 'supervisorapply.*', 'supervisee.name as superviseeName', 'supervisor.name as supervisorName', 'supervisee.course_group as superviseeCourse', 'supervisor.course_group as supervisorGroup',
                ])
                ->where('supervisorapply.statusApplied', 'Approved')
                ->where('supervisorapply.supervisorID', $id)
                ->get();


        return view('supervisorform.displayapplicationreport', compact('applydata', 'staff'));     
    }

    public function supervisorReplacement($id)
    {
        $applydata = DB::table('supervisorapply')
                ->join('users as supervisee', 'supervisorapply.superviseeID', '=', 'supervisee.id')
                ->join('users as supervisor', 'supervisorapply.supervisorID', '=', 'supervisor.id')
                ->select([
                    'supervisorapply.id AS applyID', 'supervisee.*', 'supervisor.*', 'supervisorapply.*', 'supervisee.id as superviseeID', 'supervisor.id as supervisorID', 'supervisee.matric as superviseeMatric', 'supervisor.matric as supervisorMatric', 'supervisee.name as superviseeName', 'supervisor.name as supervisorName', 'supervisee.course_group as superviseeCourse', 'supervisor.course_group as supervisorGroup',
                ])
                ->where('supervisorapply.superviseeID', $id)
                ->first();
        
        $staff = DB::table('users')
                ->where('category', 'Staff')
                ->whereNotIn('id', function ($query) use ($id) {
                    $query->select('supervisorID')
                    ->from('supervisorapply')
                    ->where('superviseeID', $id);
                })
                ->get();

        return view('supervisorform.changesupervisorform', compact('applydata', 'staff'));     
    }

    public function updateSupervisorReplacement(Request $request, $id) //updatelogbook in database
    {
        $updateApply = supervisorapply::find($id); //model name

        $updateApply->supervisorID = $request->input('currentSupervisor');

        $updateApply->update();

        return redirect()->back()->with('message', 'Supervisor Replacement Updated Successfully');
    }
}
