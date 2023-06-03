@extends('layouts.sideNav')

@section('content')

@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>REJECTED APPOINTMENT</b></h3>

<div class="card" style="margin: auto">

    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                <!-- FOR STAFF TO VIEW RECORD APPOINTMENT LIST START -->
                <table class="table table-bordered" id="dataTable" style="width: 100%; margin: auto" cellspacing="0">
                <form method="post" action="{{ route('updateAppointmentReject', $appointmentview->id) }}">
                    @csrf
                    @method('PUT')
                    <tbody>
                        <tr>
                            <td style="text-align: center; color: black">
                                <label>Reason</label>
                            </td>
                            <td>
                                <textarea class="form-control" name="reason" id="reason" rows="2" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" placeholder="*Exp: Have the meeting. Please make an appointment on Thursday at 10AM*"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <center>
                                    <button type="submit" class="btn btn-primary" style="background-color: #145956; border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px">
                                        <b>SUBMIT</b>
                                    </button>
                                    <a class="btn btn-danger" href="{{ route('approvalMeeting') }}" style="border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px">
                                        <b>CANCEL</b>
                                    </a>
                                </center>
                            </td>
                        </tr>
                    </tbody>
                </form>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection