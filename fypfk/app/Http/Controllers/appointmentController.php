<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class appointmentController extends Controller
{
    public function loadAppointment()
    {
        $id = Auth::user()->id;
        //supervisee//
        $approved = DB::table('appointment')
                    ->join('users', 'users.id', '=', 'appointment.supervisorID')
                    ->select([
                        'users.id AS userID',
                        'appointment.id AS appointmentID', 'users.*', 'appointment.*'
                    ])
                    ->where('appointment.superviseeID', $id)
                    ->where('statusAppoint', 'Approved')
                    ->get();

        $approvedexist = DB::table('appointment')
                ->where('superviseeID', $id)
                ->where('statusAppoint', 'Approved')
                ->exists();
        
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
        //supervisor//
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
        
        $approvedexistSupervisor = DB::table('appointment')
                ->where('supervisorID', $id)
                ->where('statusAppoint', 'Approved')
                ->exists();
            
        $approvedSupervisor = DB::table('appointment')
                            ->join('users', 'users.id', '=', 'appointment.superviseeID')
                            ->select([
                                'users.id AS userID',
                                'appointment.id AS appointmentID', 'users.*', 'appointment.*'
                                ])
                            ->where('appointment.supervisorID', $id)
                            ->where('statusAppoint', 'Approved')
                            ->get();

        return view('meeting.appointment', compact('approved', 'approvedexist', 'inProgress', 'inprogressexist', 'inProgressSupervisor', 'inprogressexistSupervisor', 'approvedexistSupervisor', 'approvedSupervisor')); 
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

        return redirect()->route('appointment');

    }

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

        $updateAppointment->appointDate = $request->input('date'); //blue from name input value
        $updateAppointment->startTime = $request->input('timeStart');
        $updateAppointment->endtime = $request->input('timeEnd');
        $updateAppointment->statusAppoint = 'Approved';
        $updateAppointment->appointLocation = $request->input('location');

        $updateAppointment->update();

        return redirect()->back()->with('message', 'Appointment Meeting Updated Successfully');
    }
}
