@extends('layouts.sideNav')

@section('content')


<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>REJECTED MEETING</b></h3>
@if( auth()->user()->category== "Student")
<a href="{{ route('appointmentSupervisee') }}" style="color: black">
    <i class="material-icons" style="color: black; font-size: 20px">keyboard_arrow_left</i> <b>BACK</b>
</a>
<br><br>

<div class="card">
    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                
                @if($rejectedexist)
                @foreach($rejected as $datarejected)
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead style="background-color: #86B5B3; color: black;">
                        <tr>
                            <th colspan="2">{{$datarejected->appointTitle}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><label>Date:</label></td>
                            <td><label>{{$datarejected->appointDate}}</label></td>
                        </tr>
                        <tr>
                            <td><label>Start Time:</label></td>
                            <td><label>{{$datarejected->startTime}}</label></td>
                        </tr>
                        <tr>
                            <td><label>End Time:</label></td>
                            <td><label>{{$datarejected->endTime}}</label></td>
                        </tr>
                        <tr>
                            <td><label>Meeting Personal:</label></td>
                            <td>
                                <label>{{$datarejected->name}}</label>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Purpose:</label></td>
                            <td><label>{{$datarejected->purpose}}</label></td>
                        </tr>
                        <tr>
                            <td><label>Reason:</label></td>
                            <td><label>{{$datarejected->reasonReject}}</label></td>
                        </tr>
                    </tbody>
                </table>
                @endforeach
                @elseif(! $rejectedexist)
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead style="background-color: #86B5B3; color: black;">
                        <tr>
                            <th colspan="2">
                                <center>
                                    <h5 style="color: red"><i class="material-icons" style="color: red">priority_high</i> No Rejected Meeting <i class="material-icons" style="color: red">priority_high</i></h5>
                                </center>
                            </th>
                        </tr>
                    </thead>
                </table>
                @endif
            </div>
        </div>
    </div>
</div>
@endif
@if( auth()->user()->category== "Staff")
<a href="{{ route('appointmentSupervisee') }}" style="color: black">
    <i class="material-icons" style="color: black; font-size: 20px">keyboard_arrow_left</i> <b>BACK</b>
</a>
<br><br>

<div class="card">
    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                
                @if($rejectedexist)
                @foreach($rejected as $datarejected)
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead style="background-color: #86B5B3; color: black;">
                        <tr>
                            <th colspan="2">{{$datarejected->appointTitle}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><label>Date:</label></td>
                            <td><label>{{$datarejected->appointDate}}</label></td>
                        </tr>
                        <tr>
                            <td><label>Start Time:</label></td>
                            <td><label>{{$datarejected->startTime}}</label></td>
                        </tr>
                        <tr>
                            <td><label>End Time:</label></td>
                            <td><label>{{$datarejected->endTime}}</label></td>
                        </tr>
                        <tr>
                            <td><label>Meeting Personal:</label></td>
                            <td>
                                <label>{{$datarejected->name}}</label>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Purpose:</label></td>
                            <td><label>{{$datarejected->purpose}}</label></td>
                        </tr>
                        <tr>
                            <td><label>Reason:</label></td>
                            <td><label>{{$datarejected->reasonReject}}</label></td>
                        </tr>
                    </tbody>
                </table>
                @endforeach
                @elseif(! $rejectedexist)
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead style="background-color: #86B5B3; color: black;">
                        <tr>
                            <th colspan="2">
                                <center>
                                    <h5 style="color: red"><i class="material-icons" style="color: red">priority_high</i> No Rejected Meeting <i class="material-icons" style="color: red">priority_high</i></h5>
                                </center>
                            </th>
                        </tr>
                    </thead>
                </table>
                @endif
            </div>
        </div>
    </div>
</div>
@endif
@endsection