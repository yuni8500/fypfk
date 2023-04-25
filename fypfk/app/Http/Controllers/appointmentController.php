<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class appointmentController extends Controller
{
    public function loadAppointment()
    {
        return view('meeting.appointment'); 
    }
}
