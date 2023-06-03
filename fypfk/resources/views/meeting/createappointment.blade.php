@extends('layouts.sideNav')

@section('content')

@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>CREATE APPOINTMENT</b></h3>

<div class="card" style="margin: auto">

    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                <!-- FOR STAFF TO VIEW RECORD APPOINTMENT LIST START -->
                <table class="table table-bordered" id="dataTable" style="width: 100%; margin: auto" cellspacing="0">
                <form method="post" action="{{ route('insertAppointment') }}">
                    @csrf
                    <tbody>
                        <tr>
                            <td style="text-align: center; color: black"><label>Meeting Title</label></td>
                            <td colspan="3">
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="meetingTitle" id="meetingTitle" value="">
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Supervisor Name</label></td>
                            <td>
                                @foreach($getstudData as $studData)
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="supervisorName" id="supervisorName" value="{{$studData->name}}" readonly>
                                <input type="hidden" style="background-color: #86B5B3; border-radius: 10px; width: 50%;" class="form-control" name="supervisorID" id="supervisorID" value="{{$studData->supervisorID}}" readonly>
                                @endforeach
                            </td>
                            <td style="text-align: center; color: black"><label>Date</label></td>
                            <td>
                                <input type="date" style="background-color: #86B5B3; border-radius: 10px;" class="form-control" name="date" id="date">
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Time Start</label></td>
                            <td>
                                <input type="time" style="background-color: #86B5B3; border-radius: 10px;" class="form-control" name="timeStart" id="timeStart">
                            </td>
                            <td style="text-align: center; color: black"><label>Time End</label></td>
                            <td>
                                <input type="time" style="background-color: #86B5B3; border-radius: 10px;" class="form-control" name="timeEnd" id="timeEnd">
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Purpose</label></td>
                            <td colspan="3">
                                <textarea class="form-control" name="purpose" id="purpose" rows="2" style="background-color: #86B5B3; border-radius: 10px; width: 100%;"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <center>
                                    <button type="submit" class="btn btn-primary" style="background-color: #145956; border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px">
                                        <b>SUBMIT</b>
                                    </button>
                                    <a class="btn btn-danger" href="{{ route('appointmentSupervisee') }}" style="border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px">
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