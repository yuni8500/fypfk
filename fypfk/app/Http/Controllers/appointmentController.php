<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class appointmentController extends Controller
{
    public function appointmentSupervisee(Request $request)
    {
        $category = Auth::user()->category;
        $id = Auth::user()->id;

        if ($category == 'Student') {

            if ($request->ajax()) 
            {
                $klTime = Carbon::now('Asia/Kuala_Lumpur'); // Get current KL time
                $start = $klTime->toDateString(); // Get the date part in YYYY-MM-DD format
    
                $data = appointment::select('id', 'appointTitle as title', 'appointDate as start')
                    ->where('statusAppoint', 'Approved')
                    ->where('superviseeID', $id)
                    ->get();
    
                return response()->json($data);
            }   
        }

        if ($category == 'Staff') {

            if ($request->ajax()) 
            {
                $klTime = Carbon::now('Asia/Kuala_Lumpur'); // Get current KL time
                $start = $klTime->toDateString(); // Get the date part in YYYY-MM-DD format
    
                $data = appointment::select('id', 'appointTitle as title', 'appointDate as start')
                    ->where('statusAppoint', 'Approved')
                    ->where('supervisorID', $id)
                    ->get();
    
                return response()->json($data);
            }   
        }
    
        return view('meeting.superviseemeeting');
        
    }
    public function appointmentApprovalSupervisee()
    {
        $id = Auth::user()->id;
        
        $inProgress = DB::table('appointment')
                    ->join('users', 'users.id', '=', 'appointment.supervisorID')
                    ->select([
                        'users.id AS userID',
                        'appointment.id AS appointmentID', 'users.*', 'appointment.*'
                    ])
                    ->where('appointment.superviseeID', $id)
                    ->where('statusAppoint', 'In Progress')
                    ->get();
        
        $inprogressexist = DB::table('appointment')
                ->where('superviseeID', $id)
                ->where('statusAppoint', 'In Progress')
                ->exists();

        return view('meeting.approvalrecord', compact('inProgress', 'inprogressexist')); 
    }

    public function appointmentRejectedSupervisee()
    {
        $category = Auth::user()->category;
        $id = Auth::user()->id;

        if ($category == 'Student') {
            $rejected = DB::table('appointment')
                    ->join('users', 'users.id', '=', 'appointment.supervisorID')
                    ->select([
                        'users.id AS userID',
                        'appointment.id AS appointmentID', 'users.*', 'appointment.*'
                    ])
                    ->where('appointment.superviseeID', $id)
                    ->where('statusAppoint', 'Rejected')
                    ->get();

            $rejectedexist = DB::table('appointment')
                ->where('superviseeID', $id)
                ->where('statusAppoint', 'Rejected')
                ->exists();

            return view('meeting.rejectrecord', compact('rejected', 'rejectedexist'));
        }

        if ($category == 'Staff') {
            $rejected = DB::table('appointment')
                    ->join('users', 'users.id', '=', 'appointment.supervisorID')
                    ->select([
                        'users.id AS userID',
                        'appointment.id AS appointmentID', 'users.*', 'appointment.*'
                    ])
                    ->where('appointment.supervisorID', $id)
                    ->where('statusAppoint', 'Rejected')
                    ->get();

            $rejectedexist = DB::table('appointment')
                ->where('supervisorID', $id)
                ->where('statusAppoint', 'Rejected')
                ->exists();

            return view('meeting.rejectrecord', compact('rejected', 'rejectedexist'));
        }
         
    }

    public function displayMeetingSupervisee($id)
    {
        $category = Auth::user()->category;
        
        if ($category == 'Student') 
        {
            $appointment = DB::table('appointment')
                    ->join('users as supervisee', 'appointment.superviseeID', '=', 'supervisee.id')
                    ->join('users as supervisor', 'appointment.supervisorID', '=', 'supervisor.id')
                    ->select([
                        'appointment.id AS appointID', 'supervisee.*', 'supervisor.*', 'appointment.*', 'supervisee.name as superviseeName', 'supervisor.name as supervisorName'
                    ])
                    ->where('appointment.id', $id)
                    ->first();
        }

        if ($category == 'Staff') 
        {
            $appointment = DB::table('appointment')
                    ->join('users as supervisee', 'appointment.superviseeID', '=', 'supervisee.id')
                    ->join('users as supervisor', 'appointment.supervisorID', '=', 'supervisor.id')
                    ->select([
                        'appointment.id AS appointID', 'supervisee.*', 'supervisor.*', 'appointment.*', 'supervisee.name as superviseeName', 'supervisor.name as supervisorName'
                    ])
                    ->where('appointment.id', $id)
                    ->first();
        }

        return view('meeting.displaymeeting', compact('appointment')); 
    }

    public function approvalMeeting()
    {
        $id = Auth::user()->id;
        
        $inProgressSupervisor = DB::table('appointment')
                            ->join('users', 'users.id', '=', 'appointment.superviseeID')
                            ->select([
                                'users.id AS userID',
                                'appointment.id AS appointmentID', 'users.*', 'appointment.*'
                                ])
                            ->where('appointment.supervisorID', $id)
                            ->where('statusAppoint', 'In Progress')
                            ->get();
        
        $inprogressexistSupervisor = DB::table('appointment')
                ->where('supervisorID', $id)
                ->where('statusAppoint', 'In Progress')
                ->exists();

        return view('meeting.approvalappointment', compact('inProgressSupervisor', 'inprogressexistSupervisor')); 
    }

    public function createAppointment()
    {
        $id = Auth::user()->id;

        $getstudData = DB::table('supervisorapply')
                ->join('users', 'users.id', '=', 'supervisorapply.supervisorID')
                ->select([
                    'users.id AS userID',
                    'supervisorapply.id AS applyID', 'users.*', 'supervisorapply.*'
                ])
                ->where('supervisorapply.superviseeID', $id)
                ->get();

        return view('meeting.createappointment', compact('getstudData')); 
    }

    public function insertAppointment(Request $request)
    {
        $id = Auth::user()->id;

        $supervisorID = $request->input('supervisorID');
        $appointTitle = $request->input('meetingTitle');
        $appointDate = $request->input('date');
        $tStart = $request->input('timeStart');
        $tEnd = $request->input('timeEnd');
        $purpose = $request->input('purpose');


        $data = array(
            'superviseeID' => $id,
            'supervisorID' => $supervisorID,
            'appointTitle' => $appointTitle,
            'appointDate' => $appointDate,
            'startTime' => $tStart,
            'endTime' => $tEnd,
            'purpose' => $purpose,
            'statusAppoint' => "In Progress",
        );

        // insert query
        DB::table('appointment')->insert($data);

        return redirect()->back()->with('message', 'Meeting Record Successfully');
    }

    public function appointmentView($id)
    {
        $appointmentview = DB::table('appointment')
                            ->where('id', $id)
                            ->get();


        return view('meeting.viewappointment', compact('appointmentview')); 
    }

    public function updateAppointment(Request $request, $id) //updatelogbook in database
    {
        $updateAppointment = Appointment::find($id); //model name

        $updateAppointment->appointTitle = $request->input('meetingTitle');
        $updateAppointment->appointDate = $request->input('date'); //blue from name input value
        $updateAppointment->startTime = $request->input('timeStart');
        $updateAppointment->endtime = $request->input('timeEnd');
        $updateAppointment->purpose = $request->input('purpose');

        $updateAppointment->update();

        return redirect()->back()->with('message', 'Appointment Meeting Updated Successfully');
    }

    public function deleteAppointment($id)
    {
        $deleteAppointment = Appointment::find($id); //model name
        
        if ($deleteAppointment) {
            // If the record exists, delete it
            $deleteAppointment->delete();
        }

        return redirect()->route('appointmentSupervisee');

    }

    //supervisor//
    public function appointmentAgreed($id) //view agreed
    {
        $appointmentview = DB::table('appointment')
                            ->where('id', $id)
                            ->first();

        return view('meeting.approveappointment', compact('appointmentview')); 
    }

    public function updateAppointmentAgree(Request $request, $id) //updatelogbook in database
    {
        $updateAppointment = Appointment::find($id); //model name
        
        $updateAppointment->statusAppoint = 'Approved';
        $updateAppointment->appointLocation = $request->input('location');

        $updateAppointment->update();

        return redirect()->back()->with('message', 'Appointment Meeting Approved Successfully');
    }

    public function appointmentReject($id) //view reject
    {
        $appointmentview = DB::table('appointment')
                            ->where('id', $id)
                            ->first();

        return view('meeting.rejectappointment', compact('appointmentview')); 
    }

    public function updateAppointmentReject(Request $request, $id)
    {
        $updateAppointment = Appointment::find($id); //model name

        $updateAppointment->statusAppoint = 'Rejected';
        $updateAppointment->reasonReject = $request->input('reason');

        $updateAppointment->update();

        return redirect()->back()->with('message', 'Appointment Meeting Updated Successfully');
    }
}
