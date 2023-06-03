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
                ->join('fyplibrary', 'supervisee.id', '=', 'supervisorapply.superviseeID')
                ->select([
                    'fyplibrary.id AS fyplibraryID',
                    'supervisorapply.id AS applyID', 'supervisee.*', 'supervisor.*', 'supervisorapply.*', 'fyplibrary.*', 'supervisee.name as superviseeName', 'supervisor.name as supervisorName'
                ])
                ->whereExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('fyplibrary')
                        ->whereColumn('fyplibrary.superviseeID', 'supervisorapply.superviseeID');
                })
                ->get();

        return view('fyplibrary.listfyp', compact('libdata')); 
    }
}
