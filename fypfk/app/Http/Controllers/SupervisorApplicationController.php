<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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
        $proposedTitle = $request->input('title');
        $problem = $request->input('problem');
        $domain = $request->input('domain');
        $declaration = $request->input('radio1');


        $data = array(
            'superviseeID' => $id,
            'supervisorID' => $supervisorID,
            'proposedTitle' => $proposedTitle,
            'problemStatement' => $problem,
            'domain' => $domain,
            'declaration' => $declaration,
            'statusApplied' => "In Progress",
        );

        // insert query
        DB::table('supervisorapply')->insert($data);

        return redirect()->back()->with('message', 'Supervisor Application Successfully');
    }
}
