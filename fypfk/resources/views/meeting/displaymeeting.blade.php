@extends('layouts.sideNav')

@section('content')

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>{{$appointment->appointTitle}}</b></h3>
@if( auth()->user()->category== "Student")
<div class="card" style="margin: auto">

    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                <!-- FOR STAFF TO VIEW RECORD APPOINTMENT LIST START -->
                <table class="table table-bordered" id="dataTable" style="width: 100%; margin: auto" cellspacing="0">
                    <tbody>
                        <tr>
                            <td style="text-align: center; color: black"><label>Meeting Personal</label></td>
                            <td colspan="3">
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px;" class="form-control" name="supervisorName" id="supervisorName" value="{{$appointment->supervisorName}}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Date</label></td>
                            <td>
                                <input type="date" style="background-color: #86B5B3; border-radius: 10px;" class="form-control" name="date" id="date" value="{{$appointment->appointDate}}" readonly>
                            </td>
                            <td style="text-align: center; color: black"><label>Meeting Location</label></td>
                            <td>
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px;" class="form-control" name="timeEnd" id="timeEnd" value="{{$appointment->appointLocation}}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Time Start</label></td>
                            <td>
                                <input type="time" style="background-color: #86B5B3; border-radius: 10px;" class="form-control" name="timeStart" id="timeStart" value="{{$appointment->startTime}}" readonly>
                            </td>
                            <td style="text-align: center; color: black"><label>Time End</label></td>
                            <td>
                                <input type="time" style="background-color: #86B5B3; border-radius: 10px;" class="form-control" name="timeEnd" id="timeEnd" value="{{$appointment->endTime}}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Purpose</label></td>
                            <td colspan="3">
                                <textarea class="form-control" name="purpose" id="purpose" rows="2" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" readonly>{{$appointment->purpose}}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <center>
                                    <a class="btn" href="{{ route('appointmentSupervisee') }}" style="border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px; background-color: #145956">
                                        <b>BACK</b>
                                    </a>
                                </center>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endif
@if( auth()->user()->category== "Staff")
<div class="card" style="margin: auto">

    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                <!-- FOR STAFF TO VIEW RECORD APPOINTMENT LIST START -->
                <table class="table table-bordered" id="dataTable" style="width: 100%; margin: auto" cellspacing="0">
                    <tbody>
                        <tr>
                            <td style="text-align: center; color: black"><label>Meeting Personal</label></td>
                            <td colspan="3">
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px;" class="form-control" name="supervisorName" id="supervisorName" value="{{$appointment->superviseeName}}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Date</label></td>
                            <td>
                                <input type="date" style="background-color: #86B5B3; border-radius: 10px;" class="form-control" name="date" id="date" value="{{$appointment->appointDate}}" readonly>
                            </td>
                            <td style="text-align: center; color: black"><label>Meeting Location</label></td>
                            <td>
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px;" class="form-control" name="timeEnd" id="timeEnd" value="{{$appointment->appointLocation}}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Time Start</label></td>
                            <td>
                                <input type="time" style="background-color: #86B5B3; border-radius: 10px;" class="form-control" name="timeStart" id="timeStart" value="{{$appointment->startTime}}" readonly>
                            </td>
                            <td style="text-align: center; color: black"><label>Time End</label></td>
                            <td>
                                <input type="time" style="background-color: #86B5B3; border-radius: 10px;" class="form-control" name="timeEnd" id="timeEnd" value="{{$appointment->endTime}}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Purpose</label></td>
                            <td colspan="3">
                                <textarea class="form-control" name="purpose" id="purpose" rows="2" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" readonly>{{$appointment->purpose}}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <center>
                                    <a class="btn" href="{{ route('appointmentSupervisee') }}" style="border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px; background-color: #145956">
                                        <b>BACK</b>
                                    </a>
                                </center>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endif
@endsection