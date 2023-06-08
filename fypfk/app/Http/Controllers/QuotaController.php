<?php

namespace App\Http\Controllers;
use App\Models\supervisorapply;
use App\Models\supervisorQuota;
use App\Mail\SuperviseeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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

        $supervisorIDs = $getquota->pluck('supervisorID')->toArray(); // Get an array of all supervisorIDs
        
        $countsPTA1 = DB::table('supervisorapply')
                    ->join('users', 'users.id', '=', 'supervisorapply.superviseeID')
                    ->select(DB::raw('count(*) as count'))
                    ->whereIn('supervisorapply.supervisorID', $supervisorIDs) // Use whereIn to match multiple supervisorIDs
                    ->where('supervisorapply.statusApplied', 'Approved')
                    ->where('users.course_group', 'PTA 1')
                    ->first();

        $countsPTA2 = DB::table('supervisorapply')
                    ->join('users', 'users.id', '=', 'supervisorapply.superviseeID')
                    ->select(DB::raw('count(*) as count'))
                    ->whereIn('supervisorapply.supervisorID', $supervisorIDs) // Use whereIn to match multiple supervisorIDs
                    ->where('supervisorapply.statusApplied', 'Approved')
                    ->where('users.course_group', 'PTA 2')
                    ->first();

        $countsPSM1 = DB::table('supervisorapply')
                    ->join('users', 'users.id', '=', 'supervisorapply.superviseeID')
                    ->select(DB::raw('count(*) as count'))
                    ->whereIn('supervisorapply.supervisorID', $supervisorIDs) // Use whereIn to match multiple supervisorIDs
                    ->where('supervisorapply.statusApplied', 'Approved')
                    ->where('users.course_group', 'PSM 1')
                    ->first();

        $countsPSM2 = DB::table('supervisorapply')
                    ->join('users', 'users.id', '=', 'supervisorapply.superviseeID')
                    ->select(DB::raw('count(*) as count'))
                    ->whereIn('supervisorapply.supervisorID', $supervisorIDs) // Use whereIn to match multiple supervisorIDs
                    ->where('supervisorapply.statusApplied', 'Approved')
                    ->where('users.course_group', 'PSM 2')
                    ->first();

        $totalCount = ($countsPTA1->count ?? 0) + ($countsPTA2->count ?? 0) + ($countsPSM1->count ?? 0) + ($countsPSM2->count ?? 0);
        
        //total application//
        $countapplied = DB::table('supervisorquota')
                        ->leftJoin('supervisorapply', function ($join) {
                            $join->on('supervisorquota.supervisorID', '=', 'supervisorapply.supervisorID')
                            ->where('supervisorapply.statusApplied', '=', 'In Progress');
                        })
                        ->whereIn('supervisorquota.supervisorID', $supervisorIDs)
                        ->select('supervisorquota.supervisorID', DB::raw('COUNT(supervisorapply.id) as count'))
                        ->groupBy('supervisorquota.supervisorID')
                        ->pluck('count', 'supervisorID')
                        ->map(function ($count) {
                            return $count ?: 0;
                        });
                        
        return view('quota.supervisorquota', compact('getquota', 'countsPTA1', 'countsPTA2', 'countsPSM1', 'countsPSM2', 'totalCount', 'countapplied')); 
    }

    public function getEmail(Request $request, $id)
        {

            $user = DB::table('users')
            ->select([
                'name', 'email',
            ])
            ->where('users.id', $id)
            ->first();

            $to = [

                [
                    'email' => $user->email,
                ]

            ];

            //send email
            $data = [
                
                'name' => $user->name,
            ];
           
            Mail::to($to)->send(new SuperviseeMail($data));
            
            return back()->with('success', 'Email Successfully Sent.');
           
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
