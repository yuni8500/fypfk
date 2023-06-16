<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Submission;
use App\Models\SuperviseeSubmission;
use App\Models\FypLibrary;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubmissionController extends Controller
{
    public function loadSubmission()
    {
        $category = Auth::user()->category;

        if ($category == 'Student') 
        {
            $course = Auth::user()->course_group; 

            $submission = DB::table('submission')
                        ->where('course', $course)
                        ->orderBy('course')
                        ->orderBy('dueDate')
                        ->get();

            $submissionData = DB::table('submission')
                            ->where('course', $course)
                            ->exists();

            return view('submission.projectsubmit', compact('submission', 'submissionData'));
        }
        

        if ($category == 'Admin' || $category == 'Staff') 
        {
            $submission = DB::table('submission')
                            ->orderBy('course')
                            ->orderBy('dueDate')
                            ->get();

            $submissionData = DB::table('submission')
                            ->exists();

            return view('submission.projectsubmit', compact('submission', 'submissionData'));
        }
    }

    public function viewSubmission($id)
    {
        $category = Auth::user()->category;

        $submissionData = DB::table('submission')
                        ->where('id', $id)
                        ->first();

        if ($category == 'Student') 
        {
            $userid = Auth::user()->id;
                
            $submission = DB::table('superviseesubmission')
                            ->join('submission', 'submission.id', '=', 'superviseesubmission.submissionID')
                            ->select([
                                'submission.id AS submissionID',
                                'superviseesubmission.id AS superviseesubmissionID', 'submission.*', 'superviseesubmission.*'
                            ])
                            ->where('superviseesubmission.superviseeID', $userid)
                            ->where('superviseesubmission.submissionID', $id)
                            ->get();

            $submissionexist = DB::table('superviseesubmission')
                            ->join('submission', 'submission.id', '=', 'superviseesubmission.submissionID')
                            ->select([
                                        'submission.id AS submissionID',
                                        'superviseesubmission.id AS superviseesubmissionID', 'submission.*', 'superviseesubmission.*'
                                    ])
                            ->where('superviseesubmission.superviseeID', $userid)
                            ->where('superviseesubmission.submissionID', $id)
                            ->exists();
            
            $fileexist = DB::table('superviseesubmission')
                            ->where('submissionID', $id)
                            ->where('superviseeID', $userid)
                            ->where('docSubmission', null)
                            ->exists();
            
            return view('submission.displaysubmit', compact('submissionexist', 'submission', 'submissionData', 'fileexist'));
        }

        if ($category == 'Staff') {

            $userid = Auth::user()->id;

            $course = $submissionData->course;

            $superviseedata = DB::table('supervisorapply')
                        ->join('users', 'users.id', '=', 'supervisorapply.superviseeID')
                        ->select([
                            'users.id AS userID',
                            'supervisorapply.id AS applyID', 'users.*', 'supervisorapply.*'
                            ])
                        ->where('supervisorapply.supervisorID', $userid)
                        ->where('supervisorapply.statusApplied', 'Approved')
                        ->where('users.course_group', $course)
                        ->get();

            return view('submission.displaysubmit', compact('superviseedata', 'submissionData'));
        }

        if ($category == 'Admin') {

            $staff = DB::table('users')
                        ->where('category', 'Staff')
                        ->get();

            return view('submission.displaysubmit', compact('staff', 'submissionData'));
        }
         
    }

    public function insertSuperviseeSubmission(Request $request, $id)
    {
        $userID = Auth::user()->id;

        $document = $request->file('filesubmit');
        
        $docName = time() . '.' . $document->getClientOriginalExtension();
        // to store the new file by moving to assets folder
        $document->move('assets', $docName);

        $data = array(
            'submissionID' => $id,
            'superviseeID' => $userID,
            'docSubmission' => $docName,
        );

        // insert query
        DB::table('superviseesubmission')->insert($data);

        return redirect()->back()->with('message', 'Upload Submission Successfully');
    }

    public function updateSuperviseeSubmission(Request $request, $id)
    {
        $updateS = SuperviseeSubmission::find($id); //model name

        $updateS->docSubmission = $request->file('filesubmit');

        // to rename the proposal file
        $filename = time() . '.' . $updateS->docSubmission->getClientOriginalExtension();
        // to store the new file by moving to assets folder
        $request->filesubmit->move('assets', $filename);

        $updateS->docSubmission = $filename;

        $updateS->update();

        return redirect()->back()->with('message', 'Submission Updated Successfully');
    }

    public function viewFinalSubmission($id)
    {
        $userid = Auth::user()->id;

        $submissionData = DB::table('submission')
                        ->where('id', $id)
                        ->first();

        $submission = DB::table('fyplibrary')
                        ->join('submission', 'submission.id', '=', 'fyplibrary.submissionID')
                        ->select([
                            'submission.id AS submissionID',
                            'fyplibrary.id AS fyplibraryID', 'submission.*', 'fyplibrary.*'
                        ])
                        ->where('fyplibrary.superviseeID', $userid)
                        ->where('fyplibrary.submissionID', $id)
                        ->get();

        $submissionexist = DB::table('fyplibrary')
                            ->join('submission', 'submission.id', '=', 'fyplibrary.submissionID')
                            ->select([
                                'submission.id AS submissionID',
                                'fyplibrary.id AS fyplibraryID', 'submission.*', 'fyplibrary.*'
                            ])
                            ->where('fyplibrary.superviseeID', $userid)
                            ->where('fyplibrary.submissionID', $id)
                            ->exists();
        
        $fileexist = DB::table('fyplibrary')
                        ->where('submissionID', $id)
                        ->where('superviseeID', $userid)
                        ->where('fileProject', null)
                        ->exists();

        $superviseedata = DB::table('users')
                        ->where('id', $userid)
                        ->first();

        return view('submission.finalsubmissionsupervisee', compact('submissionData', 'superviseedata', 'submission', 'submissionexist', 'fileexist')); 
    }

    public function insertFinalSubmission(Request $request, $id)
    {
        $userID = Auth::user()->id;

        $projectTitle = $request->input('projectTitle');
        $abstract = $request->input('abstract');
        $document = $request->file('projectFile');
        
        $docName = time() . '.' . $document->getClientOriginalExtension();
        // to store the new file by moving to assets folder
        $document->move('assets', $docName);

        $data = array(
            'submissionID' => $id,
            'superviseeID' => $userID,
            'projectTitle' => $projectTitle,
            'abstract' => $abstract,
            'fileProject' => $docName,
        );

        // insert query
        DB::table('fyplibrary')->insert($data);

        return redirect()->back()->with('message', 'Upload Final Submission Successfully');
    }

    public function updateFinalSubmission(Request $request, $id)
    {
        $updateFYP = FypLibrary::find($id); //model name

        $updateFYP->fileProject = $request->file('projectFile');

        // to rename the proposal file
        $filename = time() . '.' . $updateFYP->fileProject->getClientOriginalExtension();
        // to store the new file by moving to assets folder
        $request->projectFile->move('assets', $filename);

        $updateFYP->fileProject = $filename;

        $updateFYP->update();

        return redirect()->back()->with('message', 'Final Submission Updated Successfully');
    }

    //supervisor//
    public function viewSuperviseeSubmission(Request $request, $id)
    {
        $userid = Auth::user()->id;
        
        $submissionData = DB::table('submission')
                        ->where('id', $id)
                        ->first();

        $course = $submissionData->course;

        $superviseedata = DB::table('supervisorapply')
                        ->join('users', 'users.id', '=', 'supervisorapply.superviseeID')
                        ->select([
                            'users.id AS userID',
                            'supervisorapply.id AS applyID', 'users.*', 'supervisorapply.*'
                            ])
                        ->where('supervisorapply.supervisorID', $userid)
                        ->where('supervisorapply.statusApplied', 'Approved')
                        ->where('users.course_group', $course)
                        ->get();

        $studentID = $request->input('superviseeName');

        $student = DB::table('superviseesubmission')
                    ->join('users', 'users.id', '=', 'superviseesubmission.superviseeID')
                    ->join('submission', 'submission.id', '=', 'superviseesubmission.submissionID')
                    ->select([
                        'users.id AS userID',
                        'submission.id AS submissionID',
                        'superviseesubmission.id AS superviseesubmissionID', 'users.*', 'submission.*', 'superviseesubmission.*'
                    ])
                    ->where('superviseesubmission.superviseeID', $studentID)
                    ->where('superviseesubmission.submissionID', $id)
                    ->get();
                        
        $studentexist = DB::table('superviseesubmission')
                        ->join('users', 'users.id', '=', 'superviseesubmission.superviseeID')
                        ->join('submission', 'submission.id', '=', 'superviseesubmission.submissionID')
                        ->select([
                            'users.id AS userID',
                            'submission.id AS submissionID',
                            'superviseesubmission.id AS superviseesubmissionID', 'users.*', 'submission.*', 'superviseesubmission.*'
                        ])
                        ->where('superviseesubmission.superviseeID', $studentID)
                        ->where('superviseesubmission.submissionID', $id)
                        ->exists();

        $fileexist = DB::table('superviseesubmission')
                        ->where('submissionID', $id)
                        ->where('superviseeID', $studentID)
                        ->where('docSubmission', null)
                        ->exists();

        $gradedexist = DB::table('superviseesubmission')
                        ->where('submissionID', $id)
                        ->where('superviseeID', $studentID)
                        ->where('marks', null)
                        ->exists();

        //fyplibrary//
        $studentdata = DB::table('users')
            ->where('id', $studentID)
            ->first();

        $submission = DB::table('fyplibrary')
                        ->join('users', 'users.id', '=', 'fyplibrary.superviseeID')
                        ->join('submission', 'submission.id', '=', 'fyplibrary.submissionID')
                        ->select([
                            'users.id AS userID',
                            'submission.id AS submissionID',
                            'fyplibrary.id AS fyplibraryID', 'users.*', 'submission.*', 'fyplibrary.*'
                        ])
                        ->where('fyplibrary.superviseeID', $studentID)
                        ->where('fyplibrary.submissionID', $id)
                        ->get();

            $submissionexist = DB::table('fyplibrary')
                                ->join('users', 'users.id', '=', 'fyplibrary.superviseeID')
                                ->join('submission', 'submission.id', '=', 'fyplibrary.submissionID')
                                ->select([
                                    'users.id AS userID',
                                    'submission.id AS submissionID',
                                    'fyplibrary.id AS fyplibraryID', 'users.*', 'submission.*', 'fyplibrary.*'
                                ])
                                ->where('fyplibrary.superviseeID', $studentID)
                                ->where('fyplibrary.submissionID', $id)
                                ->exists();
        
            $filefypexist = DB::table('fyplibrary')
                        ->where('submissionID', $id)
                        ->where('superviseeID', $studentID)
                        ->where('fileProject', null)
                        ->exists();

        return view('submission.superviseesubmission', compact('superviseedata', 'submissionData', 'student', 'studentexist', 'fileexist', 'gradedexist', 'studentdata', 'submission', 'submissionexist', 'filefypexist')); 
    }

    public function submissionGraded($userID, $submissionID)
    {
        $submissionData = DB::table('submission')
                        ->where('id', $submissionID)
                        ->first();

        $student = DB::table('superviseesubmission')
                    ->join('users', 'users.id', '=', 'superviseesubmission.superviseeID')
                    ->join('submission', 'submission.id', '=', 'superviseesubmission.submissionID')
                    ->select([
                        'users.id AS userID',
                        'submission.id AS submissionID',
                        'superviseesubmission.id AS superviseesubmissionID', 'users.*', 'submission.*', 'superviseesubmission.*'
                    ])
                    ->where('superviseesubmission.superviseeID', $userID)
                    ->where('superviseesubmission.submissionID', $submissionID)
                    ->first();

        return view('submission.submissiongrade', compact('submissionData', 'student')); 
    }

    public function updateGradedSubmission(Request $request, $id)
    {
        $supervisorid = Auth::user()->id;

        $updateSubmission = SuperviseeSubmission::find($id);

        $updateSubmission->supervisorID = $supervisorid;
        $updateSubmission->marks = $request->input('marks'); //blue from name input value

        $updateSubmission->update();

        return redirect()->back()->with('message', 'Submission Graded Record Successfully');
    }

    public function editGradedSubmission($userID, $submissionID)
    {
        $submissionData = DB::table('submission')
                        ->where('id', $submissionID)
                        ->first();

        $student = DB::table('superviseesubmission')
                    ->join('users', 'users.id', '=', 'superviseesubmission.superviseeID')
                    ->join('submission', 'submission.id', '=', 'superviseesubmission.submissionID')
                    ->select([
                        'users.id AS userID',
                        'submission.id AS submissionID',
                        'superviseesubmission.id AS superviseesubmissionID', 'users.*', 'submission.*', 'superviseesubmission.*'
                    ])
                    ->where('superviseesubmission.superviseeID', $userID)
                    ->where('superviseesubmission.submissionID', $submissionID)
                    ->first();

        return view('submission.updatesubmissiongrade', compact('submissionData', 'student')); 
    }


    //admin//
    public function createSubmission()
    {
        return view('submission.createsubmission'); 
    }

    public function insertSubmission(Request $request)
    {
        $course = $request->input('course');
        $title = $request->input('title');
        $dueDate = $request->input('dueDate');
        $dueTime = $request->input('dueTime');
        $attachment = $request->input('attachment');

        $data = array(
            'course' => $course,
            'title' => $title,
            'dueDate' => $dueDate,
            'dueTime' => $dueTime,
            'linkAttachment' => $attachment,
        );

        // insert query
        DB::table('submission')->insert($data);

        return redirect()->back()->with('message', 'Create Submission Successfully');
    }

    public function editSubmission($id)
    {
        $submission = DB::table('submission')
                        ->where('id', $id)
                        ->first();

        return view('submission.editsubmission', compact('submission')); 
    }

    public function updateSubmission(Request $request, $id)
    {
        $updateSubmission = Submission::find($id);

        $updateSubmission->course = $request->input('course');
        $updateSubmission->title = $request->input('title'); //blue from name input value
        $updateSubmission->dueDate = $request->input('dueDate');
        $updateSubmission->dueTime = $request->input('dueTime');
        $updateSubmission->linkAttachment = $request->input('attachment');

        $updateSubmission->update();

        return redirect()->back()->with('message', 'Submission Updated Successfully');
    }

    public function deleteTask($id)
    {
        $deleteSubmission = Submission::find($id); //model name
        
        if ($deleteSubmission) {
            // If the record exists, delete it
            $deleteSubmission->delete();
        }

        return redirect()->route('submission');
    }

    public function viewSubmissionAdmin(Request $request, $id)
    {
        $submissionData = DB::table('submission')
            ->where('id', $id)
            ->first();

        $course = $submissionData->course;

        $staff = DB::table('users')
            ->where('category', 'Staff')
            ->get();

        $staffID = $request->input('supervisorName');

        $student = DB::table('supervisorapply')
            ->join('users', 'users.id', '=', 'supervisorapply.superviseeID')
            ->select([
                'users.id AS userID',
                'supervisorapply.id AS applyID', 'users.*', 'supervisorapply.*'
            ])
            ->where('supervisorapply.supervisorID', $staffID)
            ->where('supervisorapply.statusApplied', 'Approved')
            ->where('users.course_group', $course)
            ->get();

        $studentexist = DB::table('supervisorapply')
            ->join('users', 'users.id', '=', 'supervisorapply.superviseeID')
            ->select([
                'users.id AS userID',
                'supervisorapply.id AS applyID', 'users.*', 'supervisorapply.*'
            ])
            ->where('supervisorapply.supervisorID', $staffID)
            ->where('supervisorapply.statusApplied', 'Approved')
            ->where('users.course_group', $course)
            ->exists();

            return view('submission.displaysubmitadmin', compact('staff', 'student', 'submissionData', 'studentexist'));
        }

        public function viewSubmissionStudent($userID, $submissionID)
        {
            $submissionData = DB::table('submission')
            ->where('id', $submissionID)
            ->first();

            $studentdata = DB::table('users')
            ->where('id', $userID)
            ->first();

            $student = DB::table('superviseesubmission')
                    ->join('users', 'users.id', '=', 'superviseesubmission.superviseeID')
                    ->join('submission', 'submission.id', '=', 'superviseesubmission.submissionID')
                    ->select([
                        'users.id AS userID',
                        'submission.id AS submissionID',
                        'superviseesubmission.id AS superviseesubmissionID', 'users.*', 'submission.*', 'superviseesubmission.*',
                        'superviseesubmission.docSubmission'
                    ])
                    ->where('superviseesubmission.superviseeID', $userID)
                    ->where('superviseesubmission.submissionID', $submissionID)
                    ->get();

            $studentexist = DB::table('superviseesubmission')
                            ->join('users', 'users.id', '=', 'superviseesubmission.superviseeID')
                            ->join('submission', 'submission.id', '=', 'superviseesubmission.submissionID')
                            ->select([
                                'users.id AS userID',
                                'submission.id AS submissionID',
                                'superviseesubmission.id AS superviseesubmissionID', 'users.*', 'submission.*', 'superviseesubmission.*',
                                'superviseesubmission.docSubmission'
                            ])
                            ->where('superviseesubmission.superviseeID', $userID)
                            ->where('superviseesubmission.submissionID', $submissionID)
                            ->exists();

            $fileexist = DB::table('superviseesubmission')
                        ->where('submissionID', $submissionID)
                        ->where('superviseeID', $userID)
                        ->where('docSubmission', null)
                        ->exists();
                
            return view('submission.studentsubmission', compact('student', 'studentdata', 'submissionData', 'studentexist', 'fileexist'));
        }

        public function viewFinalSubmissionStudent($userID, $submissionID)
        {
            $submissionData = DB::table('submission')
            ->where('id', $submissionID)
            ->first();

            $studentdata = DB::table('users')
            ->where('id', $userID)
            ->first();

            $submission = DB::table('fyplibrary')
                        ->join('users', 'users.id', '=', 'fyplibrary.superviseeID')
                        ->join('submission', 'submission.id', '=', 'fyplibrary.submissionID')
                        ->select([
                            'users.id AS userID',
                            'submission.id AS submissionID',
                            'fyplibrary.id AS fyplibraryID', 'users.*', 'submission.*', 'fyplibrary.*'
                        ])
                        ->where('fyplibrary.superviseeID', $userID)
                        ->where('fyplibrary.submissionID', $submissionID)
                        ->get();

            $submissionexist = DB::table('fyplibrary')
                                ->join('users', 'users.id', '=', 'fyplibrary.superviseeID')
                                ->join('submission', 'submission.id', '=', 'fyplibrary.submissionID')
                                ->select([
                                    'users.id AS userID',
                                    'submission.id AS submissionID',
                                    'fyplibrary.id AS fyplibraryID', 'users.*', 'submission.*', 'fyplibrary.*'
                                ])
                                ->where('fyplibrary.superviseeID', $userID)
                                ->where('fyplibrary.submissionID', $submissionID)
                                ->exists();
        
            $fileexist = DB::table('fyplibrary')
                        ->where('submissionID', $submissionID)
                        ->where('superviseeID', $userID)
                        ->where('fileProject', null)
                        ->exists();
                
            return view('submission.finalsubmissionadmin', compact('submissionData', 'studentdata', 'submission', 'submissionexist', 'fileexist'));
        }
}
