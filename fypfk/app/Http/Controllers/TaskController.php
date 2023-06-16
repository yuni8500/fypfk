<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function loadTask()
    {
        $id = Auth::user()->id;

        $todo = DB::table('task')
                ->where('superviseeID', $id)
                ->where('progress', 'To Do')
                ->get();
        
        $doing = DB::table('task')
                ->where('superviseeID', $id)
                ->where('progress', 'Doing')
                ->get();

        $done = DB::table('task')
                ->where('superviseeID', $id)
                ->where('progress', 'Done')
                ->get();

        return view('task.tasklist', compact('todo', 'doing', 'done')); 
    }

    public function createTask()
    {
        $id = Auth::user()->id;

        $getstudData = DB::table('users')
            ->where('id', $id)
            ->get();

        return view('task.createtask', compact('getstudData')); 
    }

    public function insertTask(Request $request)
    {
        $id = Auth::user()->id;

        $taskTitle = $request->input('taskTitle');
        $assignor = $request->input('assignor');
        $dueDate = $request->input('dueDate');
        $priority = $request->input('priority');
        $status = $request->input('status');
        $taskDetails = $request->input('taskDetails');
        $process = $request->input('process');

        $data = array(
            'superviseeID' => $id,
            'titleTask' => $taskTitle,
            'assignor' => $assignor,
            'dueDate' => $dueDate,
            'priority' => $priority,
            'status' => $status,
            'taskDetails' => $taskDetails,
            'progress' => $process,
        );

        // insert query
        DB::table('task')->insert($data);

        return redirect()->back()->with('message', 'Create Task Successfully');
    }

    public function viewTask($id)
    {
        $taskview = DB::table('task')
                ->where('id', $id)
                ->get();

        $fileexist = DB::table('task')
                ->where('id', $id)
                ->where('attachment', null)
                ->exists();

        $superviseefileexist = DB::table('task')
                ->where('id', $id)
                ->where('supervisorAttachment', null)
                ->exists();

        return view('task.viewtask', compact('taskview', 'fileexist', 'superviseefileexist')); 
    }

    public function updateTask(Request $request, $id) //updateTask in database
    {
        $updateTask = task::find($id); //model name

        $path = public_path() . '/assets/' . $updateTask->attachment;
        // if (file_exists($path)) {
           // unlink($path);
       // }

        $updateTask->titleTask = $request->input('taskTitle');
        $updateTask->assignor = $request->input('assignor'); //blue from name input value
        $updateTask->dueDate = $request->input('dueDate');
        $updateTask->priority = $request->input('priority');
        $updateTask->status = $request->input('status');
        $updateTask->taskDetails = $request->input('taskDetails');
        $updateTask->progress = $request->input('process');

        if ($request->hasFile('attachment')) 
        {
            $updateTask->attachment = $request->file('attachment');

            // To rename the proposal file
            $filename = time() . '.' . $updateTask->attachment->getClientOriginalExtension();
            // To store the new file by moving it to the assets folder
            $request->attachment->move('assets', $filename);

            $updateTask->attachment = $filename;
        }
        $updateTask->update();

        return redirect()->back()->with('message', 'Task Updated Successfully');
    }

    public function deleteTask($id) //updatelogbook in database
    {
        $deleteTask = task::find($id); //model name
        
        if ($deleteTask) {
            // If the record exists, delete it
            $deleteTask->delete();
        }

        return redirect()->route('task');

    }

    //supervisor//
    public function taskListSupervisee()
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

        return view('task.listsuperviseetask', compact('pta1', 'pta2', 'psm1', 'psm2', 'pta1exist', 'pta2exist', 'psm1exist', 'psm2exist')); 
    }

    public function taskSuperviseeView($id)
    {
        $studentName = DB::table('users')
                ->where('id', $id)
                ->first();

        $todo = DB::table('task')
                ->join('users', 'users.id', '=', 'task.superviseeID')
                ->select([
                    'users.id AS userID',
                    'task.id AS taskID', 'users.*', 'task.*'
                ])
                ->where('task.superviseeID', $id)
                ->where('task.progress', 'To Do')
                ->get();

        $doing = DB::table('task')
                ->join('users', 'users.id', '=', 'task.superviseeID')
                ->select([
                    'users.id AS userID',
                    'task.id AS taskID', 'users.*', 'task.*'
                ])
                ->where('task.superviseeID', $id)
                ->where('progress', 'Doing')
                ->get();

        $done = DB::table('task')
                ->join('users', 'users.id', '=', 'task.superviseeID')
                ->select([
                    'users.id AS userID',
                    'task.id AS taskID', 'users.*', 'task.*'
                ])
                ->where('task.superviseeID', $id)
                ->where('progress', 'Done')
                ->get();

            return view('task.superviseeviewtask', compact('studentName', 'todo', 'doing', 'done')); 
    }

    public function createSuperviseeTask($id)
    {
        $userdata = DB::table('supervisorapply')
                ->join('users as supervisee', 'supervisorapply.superviseeID', '=', 'supervisee.id')
                ->join('users as supervisor', 'supervisorapply.supervisorID', '=', 'supervisor.id')
                ->select([
                    'supervisorapply.id AS applyID', 'supervisee.*', 'supervisor.*', 'supervisorapply.*', 'supervisee.name as superviseeName', 'supervisee.id as superviseeID', 'supervisee.matric as superviseeMatric', 'supervisor.name as supervisorName'
                ])
                ->where('supervisee.id', $id)
                ->first();

        return view('task.createtasksupervisee', compact('userdata')); 
    }

    public function insertSuperviseeTask(Request $request, $id)
    {
        $taskTitle = $request->input('taskTitle');
        $assignor = $request->input('assignor');
        $dueDate = $request->input('dueDate');
        $priority = $request->input('priority');
        $status = $request->input('status');
        $taskDetails = $request->input('taskDetails');
        $process = $request->input('process');

        $data = array(
            'superviseeID' => $id,
            'titleTask' => $taskTitle,
            'assignor' => $assignor,
            'dueDate' => $dueDate,
            'priority' => $priority,
            'status' => $status,
            'taskDetails' => $taskDetails,
            'progress' => $process,
        );

        // insert query
        DB::table('task')->insert($data);

        return redirect()->back()->with('message', 'Create Task Successfully');
    }

    public function viewTaskSupervisee($id)
    {
        $taskview = DB::table('task')
                ->where('id', $id)
                ->get();
        
        $fileexist = DB::table('task')
                    ->where('id', $id)
                    ->where('attachment', null)
                    ->exists();

        $superviseefileexist = DB::table('task')
                    ->where('id', $id)
                    ->where('supervisorAttachment', null)
                    ->exists();

        return view('task.viewtasksupervisee', compact('taskview', 'fileexist', 'superviseefileexist')); 
    }

    public function updateTaskSupervisee(Request $request, $id) //updatelogbook in database
    {
        $updateTask = Task::find($id); // Model name

        $path = public_path() . '/assets/' . $updateTask->supervisorAttachment;

        $updateTask->comment = $request->input('comment');

        if ($request->hasFile('supervisorAttachment')) 
        {
            $updateTask->supervisorAttachment = $request->file('supervisorAttachment');

            // To rename the proposal file
            $filename = time() . '.' . $updateTask->supervisorAttachment->getClientOriginalExtension();
            // To store the new file by moving it to the assets folder
            $request->supervisorAttachment->move('assets', $filename);

            $updateTask->supervisorAttachment = $filename;
        }

        $updateTask->update();

        return redirect()->back()->with('message', 'Task Updated Successfully');
    }

    public function deleteSuperviseeTask($id) //updatelogbook in database
    {
        $deleteTask = task::find($id); //model name
        
        if ($deleteTask) {
            // If the record exists, delete it
            $deleteTask->delete();
        }

        return redirect()->route('taskSuperviseeView', $id);
    }
}
