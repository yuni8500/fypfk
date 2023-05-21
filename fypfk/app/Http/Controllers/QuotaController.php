<?php

namespace App\Http\Controllers;
use App\Models\supervisorapply;
use App\Models\supervisorQuota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuotaController extends Controller
{
    public function loadQuota()
    {
        $getquota = DB::table('supervisorquota')
                ->join('users', 'users.id', '=', 'supervisorquota.supervisorID')
                ->select([
                    'users.id AS userID',
                    'supervisorquota.id AS quotaID', 'users.*', 'supervisorquota.*'
                ])
                ->get();

        $supervisorIDs = $getquota->pluck('supervisorID')->toArray();

        $countsPSM2 = SupervisorApply::select('users.course_group', DB::raw('COUNT(*) as count'))
                ->join('users', 'supervisorapply.supervisorID', '=', 'users.id')
                ->join('supervisorquota', 'supervisorquota.supervisorID', '=', 'users.id')
                ->where('supervisorapply.statusApplied', 'Approved')
                ->whereIn('supervisorapply.supervisorID', $supervisorIDs)
                ->whereIn('users.course_group', ['PSM 2'])
                ->groupBy('users.course_group')
                ->first();

        return view('quota.supervisorquota', compact('getquota', 'countsPSM2')); 
    }

    public function createSupervisorQuota()
    {
        $userData = DB::table('users')
                ->where('category', 'Staff')
                ->whereNotIn('id', function($query) {
                        $query->select('supervisorID')->from('supervisorquota');
                })
                ->get();

                return view('quota.createquota', compact('userData'));
    }

    public function insertSupervisorQuota(Request $request)
    {
        $supervisorID = $request->input('staffName');
        $quota = $request->input('quota');

        $data = array(
            'supervisorID' => $supervisorID,
            'quota' => $quota,
        );

        // insert query
        DB::table('supervisorquota')->insert($data);

        return redirect()->back()->with('message', 'Supervisor Quota Record Successfully');
    }

    public function viewSupervisorQuota($id)
    {
        $getquota = DB::table('supervisorquota')
                ->join('users', 'users.id', '=', 'supervisorquota.supervisorID')
                ->select([
                    'users.id AS userID',
                    'supervisorquota.id AS quotaID', 'users.*', 'supervisorquota.*'
                ])
                ->where('supervisorquota.id', $id)
                ->first();

        return view('quota.viewquota', compact('getquota')); 
    }

    public function updateSupervisorQuota(Request $request, $id) //updatelogbook in database
    {
        $updatequota = supervisorQuota::find($id); //model name

        $updatequota->quota = $request->input('quota');

        $updatequota->update();

        return redirect()->back()->with('message', 'Supervisor Quota Updated Successfully');
    }

    public function deleteSupervisorQuota($id) //updatelogbook in database
    {
        $deletequota = supervisorQuota::find($id); //model name
        
        if ($deletequota) {
            // If the record exists, delete it
            $deletequota->delete();
        }

        return redirect()->route('supervisorQuota');

    }
}
