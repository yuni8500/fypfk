@extends('layouts.sideNav')

@section('content')


<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>UPDATE MEETING</b></h3>
@if( auth()->user()->category== "Student")
<a href="{{ route('appointmentSupervisee') }}" style="color: black">
    <i class="material-icons" style="color: black; font-size: 20px">keyboard_arrow_left</i> <b>BACK</b>
</a>
<br><br>
<div class="card">
    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                
                @if($inprogressexist)
                @foreach($inProgress as $datainprogress)
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead style="background-color: #86B5B3; color: black;">
                        <tr>
                            <th colspan="2">
                                <a href="{{ route('appointmentView', $datainprogress->id) }}" style="color: black">
                                    {{$datainprogress->appointTitle}}
                                </a>
                            </th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><label>Date:</label></td>
                            <td><label>{{$datainprogress->appointDate}}</label></td>
                        </tr>
                        <tr>
                            <td><label>Start Time:</label></td>
                            <td><label>{{$datainprogress->startTime}}</label></td>
                        </tr>
                        <tr>
                            <td><label>End Time:</label></td>
                            <td><label>{{$datainprogress->endTime}}</label></td>
                        </tr>
                        <tr>
                            <td><label>Meeting Personal:</label></td>
                            <td>
                                <label>{{$datainprogress->name}}</label>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Purpose:</label></td>
                            <td><label>{{$datainprogress->purpose}}</label></td>
                        </tr>
                    </tbody>
                </table>
                @endforeach
                @elseif(! $inprogressexist)
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead style="background-color: #86B5B3; color: black;">
                        <tr>
                            <th colspan="2">
                                <center>
                                    <h5 style="color: red"><i class="material-icons" style="color: red">priority_high</i> No Appointment Meeting To Update <i class="material-icons" style="color: red">priority_high</i></h5>
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