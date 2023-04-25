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

        return view('task.viewtask', compact('taskview')); 
    }

    public function updateTask(Request $request, $id) //updatelogbook in database
    {
        $updateTask = task::find($id); //model name

        $path = public_path() . '/assets/' . $updateTask->attachment;
        if (file_exists($path)) {
            unlink($path);
        }

        $updateTask->titleTask = $request->input('taskTitle');
        $updateTask->assignor = $request->input('assignor'); //blue from name input value
        $updateTask->dueDate = $request->input('dueDate');
        $updateTask->priority = $request->input('priority');
        $updateTask->status = $request->input('status');
        $updateTask->taskDetails = $request->input('taskDetails');
        $updateTask->progress = $request->input('process');
        $updateTask->attachment = $request->file('attachment');

        // to rename the proposal file
        $filename = time() . '.' . $updateTask->attachment->getClientOriginalExtension();
        // to store the new file by moving to assets folder
        $request->attachment->move('assets', $filename);

        $updateTask->attachment = $filename;

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
}
