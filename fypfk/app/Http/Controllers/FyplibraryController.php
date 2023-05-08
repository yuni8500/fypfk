<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FyplibraryController extends Controller
{
    public function loadFypLibrary()
    {
        $libdata = DB::table('supervisorapply')
                ->join('users as supervisee', 'supervisorapply.superviseeID', '=', 'supervisee.id')
                ->join('users as supervisor', 'supervisorapply.supervisorID', '=', 'supervisor.id')
                ->select([
                    'supervisorapply.id AS applyID', 'supervisee.*', 'supervisor.*', 'supervisorapply.*', 'supervisee.name as superviseeName', 'supervisor.name as supervisorName'
                ])
                ->where('supervisorapply.statusApplied', 'Approved')
                ->get();


        return view('fyplibrary.listfyp', compact('libdata')); 
    }
}
