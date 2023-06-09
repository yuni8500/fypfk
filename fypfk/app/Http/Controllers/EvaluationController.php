<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Evaluation;

class EvaluationController extends Controller
{
    public function loadEvaluation()
    {
        $id = Auth::user()->id;

        $user = DB::table('supervisorapply')
                ->join('users as supervisee', 'supervisorapply.superviseeID', '=', 'supervisee.id')
                ->join('users as supervisor', 'supervisorapply.supervisorID', '=', 'supervisor.id')
                ->select([
                    'supervisee.id AS superviseeID', 
                    'supervisor.id AS supervisorID', 
                    'supervisorapply.id AS supervisorapplyID', 'supervisee.*', 'supervisor.*', 'supervisorapply.*',
                    'supervisee.name as superviseeName', 'supervisor.name as supervisorName', 'supervisee.matric as superviseeMatric', 'supervisor.matric as supervisorMatric', 'supervisee.course_group as superviseeCourse', 'supervisor.course_group as supervisorGroup'
                ])
                ->where('supervisorapply.superviseeID', $id)
                ->first();
        
        $evaluation = DB::table('evaluation')
                    ->where('evaluation.superviseeID', $id)
                    ->get();
                        
        $evaluationMarks = DB::table('evaluationmarks')
                        ->join('evaluation', 'evaluationmarks.evaluationID', '=', 'evaluation.id')
                        ->select('evaluation.evaluator1', 'evaluation.evaluator2', 'evaluationmarks.marks')
                        ->where('evaluation.superviseeID', $id)
                        ->get();

        $evaluator1name = null;
        $evaluator2name = null;

        $evaluateMarks = []; // Define and initialize the variable

        foreach ($evaluationMarks as $marks) {
            if ($marks->evaluator1 === $evaluator1name) {
                $evaluateMarks['Evaluator 1'] = $marks->marks;
            } elseif ($marks->evaluator1 === $evaluator2name) {
                $evaluateMarks['Evaluator 2'] = $marks->marks;
            }
        }

        $totalMarks = DB::table('evaluationmarks')
                    ->join('evaluation', 'evaluationmarks.evaluationID', '=', 'evaluation.id')
                    ->select('evaluation.evaluator1', 'evaluation.evaluator2')
                    ->where('evaluation.superviseeID', $id)
                    ->groupBy('evaluation.superviseeID', 'evaluation.evaluator1', 'evaluation.evaluator2')
                    ->selectRaw('evaluation.superviseeID, SUM(evaluationmarks.marks) as totalMarks')
                    ->first();
                    
        $applyexist = DB::table('supervisorapply')
                    ->where('superviseeID', $id)
                    ->exists();

        $userdata = DB::table('users')
                    ->where('id', $id)
                    ->first();

        return view('evaluation.evaluationinfo', compact('evaluation', 'evaluateMarks', 'totalMarks', 'user', 'applyexist', 'userdata')); 
    }

    //supervisor//
    public function supervisorEvaluation()
    {
        $name = Auth::user()->name;

        $pta1 = DB::table('evaluation')
                ->join('users as supervisee', 'evaluation.superviseeID', '=', 'supervisee.id')
                ->join('users as supervisor', 'evaluation.supervisorID', '=', 'supervisor.id')
                ->select([
                    'evaluation.id AS evaluationID', 'supervisee.*', 'supervisor.*', 'evaluation.*', 'supervisee.name as superviseeName', 'supervisor.name as supervisorName', 'supervisee.id as superviseeID', 'supervisor.id as supervisorID', 'supervisee.matric as superviseeMatric', 'supervisor.matric as supervisorMatric', 'supervisee.course_group as superviseeCourse', 'supervisor.course_group as supervisorGroup'
                ])
                ->where('supervisee.course_group', 'PTA 1')
                ->where(function ($query) use ($name) {
                    $query->where('evaluation.evaluator1', $name)
                    ->orWhere('evaluation.evaluator2', $name);
                })
                ->get();

        $pta1exist = DB::table('evaluation')
                    ->join('users as supervisee', 'evaluation.superviseeID', '=', 'supervisee.id')
                    ->join('users as supervisor', 'evaluation.supervisorID', '=', 'supervisor.id')
                    ->select([
                        'evaluation.id AS evaluationID', 'supervisee.*', 'supervisor.*', 'evaluation.*', 'supervisee.name as superviseeName', 'supervisor.name as supervisorName', 'supervisee.id as superviseeID', 'supervisor.id as supervisorID', 'supervisee.matric as superviseeMatric', 'supervisor.matric as supervisorMatric', 'supervisee.course_group as superviseeCourse', 'supervisor.course_group as supervisorGroup'
                    ])
                    ->where('supervisee.course_group', 'PTA 1')
                    ->where(function ($query) use ($name) {
                        $query->where('evaluation.evaluator1', $name)
                        ->orWhere('evaluation.evaluator2', $name);
                    })
                    ->exists();

        $pta2 = DB::table('evaluation')
                ->join('users as supervisee', 'evaluation.superviseeID', '=', 'supervisee.id')
                ->join('users as supervisor', 'evaluation.supervisorID', '=', 'supervisor.id')
                ->select([
                    'evaluation.id AS evaluationID', 'supervisee.*', 'supervisor.*', 'evaluation.*', 'supervisee.name as superviseeName', 'supervisor.name as supervisorName', 'supervisee.id as superviseeID', 'supervisor.id as supervisorID', 'supervisee.matric as superviseeMatric', 'supervisor.matric as supervisorMatric', 'supervisee.course_group as superviseeCourse', 'supervisor.course_group as supervisorGroup'
                ])
                ->where('supervisee.course_group', 'PTA 2')
                ->where(function ($query) use ($name) {
                    $query->where('evaluation.evaluator1', $name)
                    ->orWhere('evaluation.evaluator2', $name);
                })
                ->get();

        $pta2exist = DB::table('evaluation')
                    ->join('users as supervisee', 'evaluation.superviseeID', '=', 'supervisee.id')
                    ->join('users as supervisor', 'evaluation.supervisorID', '=', 'supervisor.id')
                    ->select([
                        'evaluation.id AS evaluationID', 'supervisee.*', 'supervisor.*', 'evaluation.*', 'supervisee.name as superviseeName', 'supervisor.name as supervisorName', 'supervisee.id as superviseeID', 'supervisor.id as supervisorID', 'supervisee.matric as superviseeMatric', 'supervisor.matric as supervisorMatric', 'supervisee.course_group as superviseeCourse', 'supervisor.course_group as supervisorGroup'
                    ])
                    ->where('supervisee.course_group', 'PTA 2')
                    ->where(function ($query) use ($name) {
                        $query->where('evaluation.evaluator1', $name)
                        ->orWhere('evaluation.evaluator2', $name);
                    })
                    ->exists();

        $psm1 = DB::table('evaluation')
                ->join('users as supervisee', 'evaluation.superviseeID', '=', 'supervisee.id')
                ->join('users as supervisor', 'evaluation.supervisorID', '=', 'supervisor.id')
                ->select([
                    'evaluation.id AS evaluationID', 'supervisee.*', 'supervisor.*', 'evaluation.*', 'supervisee.name as superviseeName', 'supervisor.name as supervisorName', 'supervisee.id as superviseeID', 'supervisor.id as supervisorID', 'supervisee.matric as superviseeMatric', 'supervisor.matric as supervisorMatric', 'supervisee.course_group as superviseeCourse', 'supervisor.course_group as supervisorGroup'
                ])
                ->where('supervisee.course_group', 'PSM 1')
                ->where(function ($query) use ($name) {
                    $query->where('evaluation.evaluator1', $name)
                ->orWhere('evaluation.evaluator2', $name);
                })
                ->get();

        $psm1exist = DB::table('evaluation')
                    ->join('users as supervisee', 'evaluation.superviseeID', '=', 'supervisee.id')
                    ->join('users as supervisor', 'evaluation.supervisorID', '=', 'supervisor.id')
                    ->select([
                        'evaluation.id AS evaluationID', 'supervisee.*', 'supervisor.*', 'evaluation.*', 'supervisee.name as superviseeName', 'supervisor.name as supervisorName', 'supervisee.id as superviseeID', 'supervisor.id as supervisorID', 'supervisee.matric as superviseeMatric', 'supervisor.matric as supervisorMatric', 'supervisee.course_group as superviseeCourse', 'supervisor.course_group as supervisorGroup'
                    ])
                    ->where('supervisee.course_group', 'PSM 1')
                    ->where(function ($query) use ($name) {
                        $query->where('evaluation.evaluator1', $name)
                    ->orWhere('evaluation.evaluator2', $name);
                    })
                    ->exists();

        $psm2 = DB::table('evaluation')
                ->join('users as supervisee', 'evaluation.superviseeID', '=', 'supervisee.id')
                ->join('users as supervisor', 'evaluation.supervisorID', '=', 'supervisor.id')
                ->select([
                    'evaluation.id AS evaluationID', 'supervisee.*', 'supervisor.*', 'evaluation.*', 'supervisee.name as superviseeName', 'supervisor.name as supervisorName', 'supervisee.id as superviseeID', 'supervisor.id as supervisorID', 'supervisee.matric as superviseeMatric', 'supervisor.matric as supervisorMatric', 'supervisee.course_group as superviseeCourse', 'supervisor.course_group as supervisorGroup'
                ])
                ->where('supervisee.course_group', 'PSM 2')
                ->where(function ($query) use ($name) {
                    $query->where('evaluation.evaluator1', $name)
                    ->orWhere('evaluation.evaluator2', $name);
                })
                ->get();

        $psm2exist = DB::table('evaluation')
                    ->join('users as supervisee', 'evaluation.superviseeID', '=', 'supervisee.id')
                    ->join('users as supervisor', 'evaluation.supervisorID', '=', 'supervisor.id')
                    ->select([
                        'evaluation.id AS evaluationID', 'supervisee.*', 'supervisor.*', 'evaluation.*', 'supervisee.name as superviseeName', 'supervisor.name as supervisorName', 'supervisee.id as superviseeID', 'supervisor.id as supervisorID', 'supervisee.matric as superviseeMatric', 'supervisor.matric as supervisorMatric', 'supervisee.course_group as superviseeCourse', 'supervisor.course_group as supervisorGroup'
                    ])
                    ->where('supervisee.course_group', 'PSM 2')
                    ->where(function ($query) use ($name) {
                        $query->where('evaluation.evaluator1', $name)
                        ->orWhere('evaluation.evaluator2', $name);
                    })
                    ->exists();

        $gradeexist = DB::table('evaluationmarks')
                    ->join('evaluation', 'evaluationmarks.evaluationID', '=', 'evaluation.id')
                    ->where(function ($query) use ($name) {
                        $query->where('evaluation.evaluator1', $name)
                              ->orWhere('evaluation.evaluator2', $name);
                    })
                    ->exists();

        return view('evaluation.evaluationsupervisor', compact('pta1', 'pta1exist', 'pta2', 'pta2exist', 'psm1', 'psm1exist', 'psm2', 'psm2exist', 'gradeexist')); 
    }

    public function evaluationGraded($id)
    {
        $name = Auth::user()->name;

        $evaluationinfo = DB::table('evaluation')
                        ->join('users as supervisee', 'evaluation.superviseeID', '=', 'supervisee.id')
                        ->join('users as supervisor', 'evaluation.supervisorID', '=', 'supervisor.id')
                        ->select([
                            'evaluation.id AS evaluationID', 'supervisee.*', 'supervisor.*', 'evaluation.*', 'supervisee.name as superviseeName', 'supervisor.name as supervisorName', 'supervisee.id as superviseeID', 'supervisor.id as supervisorID', 'supervisee.matric as superviseeMatric', 'supervisor.matric as supervisorMatric', 'supervisee.course_group as superviseeCourse', 'supervisor.course_group as supervisorGroup'
                            ])
                        ->where('evaluation.id', $id)
                        ->where('evaluation.evaluator1', $name)
                        ->orWhere('evaluation.evaluator2', $name)
                        ->first();

        return view('evaluation.evaluationgraded', compact('evaluationinfo', 'name')); 
    }

    public function updateEvaluationGraded($id)
    {
        $evaluationinfo = DB::table('evaluation')
                        ->join('users as supervisee', 'evaluation.superviseeID', '=', 'supervisee.id')
                        ->join('users as supervisor', 'evaluation.supervisorID', '=', 'supervisor.id')
                        ->join('evaluationmarks', 'evaluationmarks.evaluationID', '=', 'evaluation.id')
                        ->select([
                            'evaluationmarks.id AS evaluationmarksID',
                            'evaluation.id AS evaluationID', 'supervisee.*', 'supervisor.*', 'evaluation.*', 'evaluationmarks.*', 'supervisee.name as superviseeName', 'supervisor.name as supervisorName', 'supervisee.id as superviseeID', 'supervisor.id as supervisorID', 'supervisee.matric as superviseeMatric', 'supervisor.matric as supervisorMatric', 'supervisee.course_group as superviseeCourse', 'supervisor.course_group as supervisorGroup'
                            ])
                        ->where('evaluation.id', $id)
                        ->first();

        $fileexist = DB::table('evaluationmarks')
                        ->where('evaluationID', $id)
                        ->exists();

        return view('evaluation.editevaluationsupervisor', compact('evaluationinfo', 'fileexist')); 
    }

    public function insertEvaluationGraded(Request $request, $id)
    {
        $superviseeID = $request->input('studID');
        $supervisorID = $request->input('staffID');
        $evaluatorName = $request->input('evaluatorName');
        $file = $request->file('fileEvaluate');
        $marks = $request->input('marks');
        $comment = $request->input('comment');

        // to rename the proposal file
        $filename = time() . '.' . $file->getClientOriginalExtension();
        // to store the new file by moving to assets folder
        $file->move('assets', $filename);

        $data = array(
            'evaluationID' => $id,
            'superviseeID' => $superviseeID,
            'supervisorID' => $supervisorID,
            'evaluatorName' => $evaluatorName,
            'file' => $filename,
            'marks' => $marks,
            'comment' => $comment,
        );

        // insert query
        DB::table('evaluationmarks')->insert($data);

        return redirect()->back()->with('message', 'Evaluation Marks Record Successfully');
    }

    public function evaluationRecordPTA1()
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
        
        return view('evaluation.evaluationrecordpta1', compact('superviseeList', 'pta1Exist'));  
    }

    public function evaluationRecordPTA2()
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
        
        return view('evaluation.evaluationrecordpta2', compact('superviseeList', 'pta2Exist'));  
    }

    public function evaluationRecordPSM1()
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
        
        return view('evaluation.evaluationrecordpsm1', compact('superviseeList', 'psm1Exist'));  
    }

    public function evaluationRecordPSM2()
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
        
        return view('evaluation.evaluationrecordpsm2', compact('superviseeList', 'psm2Exist'));  
    }

    public function superviseeEvaluation($id)
    {
        $user = DB::table('supervisorapply')
                ->join('users as supervisee', 'supervisorapply.superviseeID', '=', 'supervisee.id')
                ->join('users as supervisor', 'supervisorapply.supervisorID', '=', 'supervisor.id')
                ->select([
                    'supervisee.id AS superviseeID', 
                    'supervisor.id AS supervisorID', 
                    'supervisorapply.id AS supervisorapplyID', 'supervisee.*', 'supervisor.*', 'supervisorapply.*',
                    'supervisee.name as superviseeName', 'supervisor.name as supervisorName', 'supervisee.matric as superviseeMatric', 'supervisor.matric as supervisorMatric', 'supervisee.course_group as superviseeCourse', 'supervisor.course_group as supervisorGroup'
                ])
                ->where('supervisorapply.superviseeID', $id)
                ->first();
        
        $evaluation = DB::table('evaluation')
                    ->where('evaluation.superviseeID', $id)
                    ->get();
                        
        $evaluationMarks = DB::table('evaluationmarks')
                        ->join('evaluation', 'evaluationmarks.evaluationID', '=', 'evaluation.id')
                        ->select('evaluation.evaluator1', 'evaluation.evaluator2', 'evaluationmarks.evaluatorName', 'evaluationmarks.file', 'evaluationmarks.marks', 'evaluationmarks.comment')
                        ->where('evaluation.superviseeID', $id)
                        ->get();

        $evaluateData = [];

        foreach ($evaluationMarks as $marks) {
            if (!empty($marks->file) && $marks->evaluator1 === $marks->evaluatorName) {
                $evaluateData['Evaluator 1'] = [
                    'file' => $marks->file,
                    'marks' => $marks->marks,
                    'comment' => $marks->comment
                ];
            } elseif (!empty($marks->file) && $marks->evaluator2 === $marks->evaluatorName) {
                $evaluateData['Evaluator 2'] = [
                    'file' => $marks->file,
                    'marks' => $marks->marks,
                    'comment' => $marks->comment
                ];
            }
        }

        $totalMarks = DB::table('evaluationmarks')
                    ->join('evaluation', 'evaluationmarks.evaluationID', '=', 'evaluation.id')
                    ->select('evaluation.evaluator1', 'evaluation.evaluator2')
                    ->where('evaluation.superviseeID', $id)
                    ->groupBy('evaluation.superviseeID', 'evaluation.evaluator1', 'evaluation.evaluator2')
                    ->selectRaw('evaluation.superviseeID, SUM(evaluationmarks.marks) as totalMarks')
                    ->first();  

        return view('evaluation.viewSuperviseeEvaluation', compact('evaluation', 'evaluateData', 'totalMarks', 'user')); 
    }

    //admin//
    public function evaluationAdmin()
    {
        $pta1 = DB::table('evaluation')
                ->join('users', 'users.id', '=', 'evaluation.superviseeID')
                ->join('supervisorapply', 'supervisorapply.superviseeID', '=', 'evaluation.superviseeID')
                ->select([
                    'users.id AS userID',
                    'supervisorapply.id AS applyID',
                    'evaluation.id AS evaluationID', 'users.*', 'supervisorapply.*', 'evaluation.*'
                ])
                ->where('users.course_group', 'PTA 1')
                ->get();

        $pta1exist = DB::table('evaluation')
                ->join('users', 'users.id', '=', 'evaluation.superviseeID')
                ->join('supervisorapply', 'supervisorapply.superviseeID', '=', 'evaluation.superviseeID')
                ->select([
                    'users.id AS userID',
                    'supervisorapply.id AS applyID',
                    'evaluation.id AS evaluationID', 'users.*', 'supervisorapply.*', 'evaluation.*'
                ])
                ->where('users.course_group', 'PTA 1')
                ->exists();

        return view('evaluation.evaluationadmin', compact('pta1','pta1exist')); 
    }

    public function evaluationpta2()
    {
        $pta2 = DB::table('evaluation')
                ->join('users', 'users.id', '=', 'evaluation.superviseeID')
                ->join('supervisorapply', 'supervisorapply.superviseeID', '=', 'evaluation.superviseeID')
                ->select([
                    'users.id AS userID',
                    'supervisorapply.id AS applyID',
                    'evaluation.id AS evaluationID', 'users.*', 'supervisorapply.*', 'evaluation.*'
                ])
                ->where('users.course_group', 'PTA 2')
                ->get();

        $pta2exist = DB::table('evaluation')
                ->join('users', 'users.id', '=', 'evaluation.superviseeID')
                ->join('supervisorapply', 'supervisorapply.superviseeID', '=', 'evaluation.superviseeID')
                ->select([
                    'users.id AS userID',
                    'supervisorapply.id AS applyID',
                    'evaluation.id AS evaluationID', 'users.*', 'supervisorapply.*', 'evaluation.*'
                ])
                ->where('users.course_group', 'PTA 2')
                ->exists();

        return view('evaluation.evaluationpta2', compact('pta2','pta2exist')); 
    }

    public function evaluationpsm1()
    {
        $psm1 = DB::table('evaluation')
                ->join('users', 'users.id', '=', 'evaluation.superviseeID')
                ->join('supervisorapply', 'supervisorapply.superviseeID', '=', 'evaluation.superviseeID')
                ->select([
                    'users.id AS userID',
                    'supervisorapply.id AS applyID',
                    'evaluation.id AS evaluationID', 'users.*', 'supervisorapply.*', 'evaluation.*'
                ])
                ->where('users.course_group', 'PSM 1')
                ->get();

        $psm1exist = DB::table('evaluation')
                ->join('users', 'users.id', '=', 'evaluation.superviseeID')
                ->join('supervisorapply', 'supervisorapply.superviseeID', '=', 'evaluation.superviseeID')
                ->select([
                    'users.id AS userID',
                    'supervisorapply.id AS applyID',
                    'evaluation.id AS evaluationID', 'users.*', 'supervisorapply.*', 'evaluation.*'
                ])
                ->where('users.course_group', 'PSM 1')
                ->exists();

        return view('evaluation.evaluationpsm1', compact('psm1', 'psm1exist')); 
    }

    public function evaluationpsm2()
    {
        $psm2 = DB::table('evaluation')
                ->join('users', 'users.id', '=', 'evaluation.superviseeID')
                ->join('supervisorapply', 'supervisorapply.superviseeID', '=', 'evaluation.superviseeID')
                ->select([
                    'users.id AS userID',
                    'supervisorapply.id AS applyID',
                    'evaluation.id AS evaluationID', 'users.*', 'supervisorapply.*', 'evaluation.*'
                ])
                ->where('users.course_group', 'PSM 2')
                ->get();

                

        $psm2exist = DB::table('evaluation')
                ->join('users', 'users.id', '=', 'evaluation.superviseeID')
                ->select([
                    'users.id AS userID',
                    'evaluation.id AS evaluationID', 'users.*', 'evaluation.*'
                ])
                ->where('users.course_group', 'PSM 2')
                ->exists();

        return view('evaluation.evaluationpsm2', compact('psm2', 'psm2exist')); 
    }

    public function createEvaluation()
    {
        $staff = DB::table('users')
                ->where('category', 'Staff')
                ->get();
    
        return view('evaluation.createevaluation', compact('staff')); 
    }

    public function superviseeListData(Request $request)
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
        $pta1exist = DB::table('evaluation')
                    ->join('users', 'users.id', '=', 'evaluation.superviseeID')
                    ->select('users.id AS userID', 'evaluation.id AS evaluationID', 'users.*', 'evaluation.*')
                    ->whereIn('evaluation.superviseeID', function ($query) use ($staffID) 
                    {
                        $query->select('supervisorapply.superviseeID')
                        ->from('supervisorapply')
                        ->where('supervisorapply.supervisorID', $staffID)
                        ->where('supervisorapply.statusApplied', 'Approved');
                    })
                    ->where('users.course_group', 'PTA 1')
                    ->doesntExist();

        $pta2exist = DB::table('evaluation')
                    ->join('users', 'users.id', '=', 'evaluation.superviseeID')
                    ->select('users.id AS userID', 'evaluation.id AS evaluationID', 'users.*', 'evaluation.*')
                    ->whereIn('evaluation.superviseeID', function ($query) use ($staffID) 
                    {
                        $query->select('supervisorapply.superviseeID')
                        ->from('supervisorapply')
                        ->where('supervisorapply.supervisorID', $staffID)
                        ->where('supervisorapply.statusApplied', 'Approved');
                    })
                    ->where('users.course_group', 'PTA 2')
                    ->doesntExist();

        $psm1exist = DB::table('evaluation')
                    ->join('users', 'users.id', '=', 'evaluation.superviseeID')
                    ->select('users.id AS userID', 'evaluation.id AS evaluationID', 'users.*', 'evaluation.*')
                    ->whereIn('evaluation.superviseeID', function ($query) use ($staffID) 
                    {
                        $query->select('supervisorapply.superviseeID')
                        ->from('supervisorapply')
                        ->where('supervisorapply.supervisorID', $staffID)
                        ->where('supervisorapply.statusApplied', 'Approved');
                    })
                    ->where('users.course_group', 'PSM 1')
                    ->doesntExist();

        $psm2exist = DB::table('evaluation')
                    ->join('users', 'users.id', '=', 'evaluation.superviseeID')
                    ->select('users.id AS userID', 'evaluation.id AS evaluationID', 'users.*', 'evaluation.*')
                    ->whereIn('evaluation.superviseeID', function ($query) use ($staffID) 
                    {
                        $query->select('supervisorapply.superviseeID')
                            ->from('supervisorapply')
                            ->where('supervisorapply.supervisorID', $staffID)
                            ->where('supervisorapply.statusApplied', 'Approved');
                    })
                    ->where('users.course_group', 'PSM 2')
                    ->doesntExist();
    
        return view('evaluation.superviseeList', compact('staff', 'pta1', 'pta2', 'psm1', 'psm2', 'pta1exist', 'pta2exist', 'psm1exist', 'psm2exist'));     
    }

    public function evaluationForm($id)
    {
        $supervisee =  DB::table('supervisorapply')
                    ->join('users as supervisee', 'supervisorapply.superviseeID', '=', 'supervisee.id')
                    ->join('users as supervisor', 'supervisorapply.supervisorID', '=', 'supervisor.id')
                    ->select([
                        'supervisorapply.id AS applyID', 'supervisee.*', 'supervisor.*', 'supervisorapply.*', 'supervisee.name as superviseeName', 'supervisor.name as supervisorName', 'supervisee.id as superviseeID', 'supervisor.id as supervisorID', 'supervisee.matric as superviseeMatric', 'supervisor.matric as supervisorMatric', 'supervisee.course_group as superviseeCourse', 'supervisor.course_group as supervisorGroup'
                    ])
                    ->where('supervisorapply.superviseeID', $id)
                    ->get();

        $staff = DB::table('users')
                ->where('category', 'Staff')
                ->whereNotIn('id', function ($query) use ($id) {
                    $query->select('supervisorID')
                    ->from('supervisorapply')
                    ->where('superviseeID', $id);
                })
                ->get();
    
        return view('evaluation.evaluationform', compact('supervisee', 'staff')); 
    }

    public function insertEvaluation(Request $request)
    {
        $superviseeID = $request->input('studID');
        $supervisorID = $request->input('supervisorID');
        $evaluator1 = $request->input('staffName1');
        $evaluator2 = $request->input('staffName2');
        $date = $request->input('date');
        $time = $request->input('time');
        $location = $request->input('location');


        $data = array(
            'superviseeID' => $superviseeID,
            'supervisorID' => $supervisorID,
            'evaluator1' => $evaluator1,
            'evaluator2' => $evaluator2,
            'dateEvaluate' => $date,
            'timeEvaluate' => $time,
            'location' => $location,
        );

        // insert query
        DB::table('evaluation')->insert($data);

        return redirect()->back()->with('message', 'Create Evaluation Successfully');
    }

    public function viewEvaluation($id)
    {
        $staff = DB::table('users')
                ->where('category', 'Staff')
                ->whereNotIn('id', function ($query) use ($id) {
                    $query->select('supervisorID')
                    ->from('supervisorapply')
                    ->where('superviseeID', $id);
                })
                ->get();
                
        $evaluation = DB::table('evaluation')
                ->join('users as supervisee', 'evaluation.superviseeID', '=', 'supervisee.id')
                ->join('users as supervisor', 'evaluation.supervisorID', '=', 'supervisor.id')
                ->join('supervisorapply', 'supervisorapply.superviseeID', '=', 'evaluation.superviseeID')
                ->select([
                    'supervisee.id AS superviseeID',
                    'supervisor.id AS supervisorID',
                    'supervisorapply.id AS applyID',
                    'evaluation.id AS evaluationID', 'supervisee.*', 'supervisor.*', 'supervisorapply.*', 'evaluation.*', 'supervisee.name as superviseeName', 'supervisor.name as supervisorName', 'supervisee.id as superviseeID', 'supervisor.id as supervisorID', 'supervisee.matric as superviseeMatric', 'supervisor.matric as supervisorMatric', 'supervisee.course_group as superviseeCourse', 'supervisor.course_group as supervisorGroup'
                ])
                ->where('supervisee.id', $id)
                ->get();
                    
        return view('evaluation.viewevaluation', compact('staff', 'evaluation')); 
    }

    public function viewEvaluationRecord($id)
    {    
        $evaluation = DB::table('evaluation')
                    ->join('users as supervisee', 'evaluation.superviseeID', '=', 'supervisee.id')
                    ->join('users as supervisor', 'evaluation.supervisorID', '=', 'supervisor.id')
                    ->join('supervisorapply', 'supervisorapply.superviseeID', '=', 'evaluation.superviseeID')
                    ->join('evaluationmarks', 'evaluationmarks.evaluationID', '=', 'evaluation.id')
                    ->select([
                        'supervisee.id AS superviseeID', 
                        'supervisor.id AS supervisorID', 
                        'supervisorapply.id AS applyID', 
                        'evaluationmarks.id AS evaluationmarksID', 
                        'evaluation.id AS evaluationID', 'supervisee.*', 'supervisor.*', 'supervisorapply.*', 'evaluationmarks.*', 'evaluation.*',
                        'supervisee.name as superviseeName', 'supervisor.name as supervisorName', 'supervisee.matric as superviseeMatric', 'supervisor.matric as supervisorMatric', 'supervisee.course_group as superviseeCourse', 'supervisor.course_group as supervisorGroup'
                    ])
                    ->where('supervisee.id', $id)
                    ->get();

        $evaluationMarks = DB::table('evaluationmarks')
                        ->join('evaluation', 'evaluationmarks.evaluationID', '=', 'evaluation.id')
                        ->select('evaluation.evaluator1', 'evaluation.evaluator2', 'evaluationmarks.marks')
                        ->where('evaluation.superviseeID', $id)
                        ->get();

        $evaluator1name = $evaluation[0]->evaluator1;
        $evaluator2name = $evaluation[0]->evaluator2;
    
        $evaluateMarks = [];

        foreach ($evaluationMarks as $marks) 
        {
            if ($marks->evaluator1 === $evaluator1name) 
            {
                $evaluateMarks['Evaluator 1'] = $marks->marks;
            } 
            elseif ($marks->evaluator1 === $evaluator2name) 
            {
                $evaluateMarks['Evaluator 2'] = $marks->marks;
            }
        }
                    
        return view('evaluation.viewevaluationrecord', compact('evaluation', 'evaluateMarks')); 
    }

    public function updateEvaluation(Request $request, $id) //updatelogbook in database
    {
        $updateEvaluation = Evaluation::find($id); //model name

        $updateEvaluation->evaluator1 = $request->input('staffName1');
        $updateEvaluation->evaluator2 = $request->input('staffName2');
        $updateEvaluation->dateEvaluate = $request->input('date');
        $updateEvaluation->timeEvaluate = $request->input('time');
        $updateEvaluation->location = $request->input('location');

        $updateEvaluation->update();

        return redirect()->back()->with('message', 'Evaluation Updated Successfully');
    }
}
