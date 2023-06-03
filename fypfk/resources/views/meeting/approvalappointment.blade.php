@extends('layouts.sideNav')

@section('content')


<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>MEETING APPROVAL</b></h3>
<a href="{{ route('appointmentSupervisee') }}" style="color: black">
    <i class="material-icons" style="color: black; font-size: 20px">keyboard_arrow_left</i> <b>BACK</b>
</a>
<br><br>
<div class="card">
    
    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                @if($inprogressexistSupervisor)
                @foreach($inProgressSupervisor as $dataInprogress)
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead style="background-color: #86B5B3; color: black;">
                        <tr>
                            <th colspan="2">{{$dataInprogress->appointTitle}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><label>Date:</label></td>
                            <td><label>{{$dataInprogress->appointDate}}</label></td>
                        </tr>
                        <tr>
                            <td><label>Start Time:</label></td>
                            <td><label>{{$dataInprogress->startTime}}</label></td>
                        </tr>
                        <tr>
                            <td><label>End Time:</label></td>
                            <td><label>{{$dataInprogress->endTime}}</label></td>
                        </tr>
                        <tr>
                            <td><label>Meeting Personal:</label></td>
                            <td>
                                <label>{{$dataInprogress->name}}</label>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Purpose:</label></td>
                            <td><label>{{$dataInprogress->purpose}}</label></td>
                        </tr>
                        <tr>
                            <td colspan="2"><center>
                                <a class="btn" href="{{ route('appointmentAgreed', $dataInprogress->id) }}" style="border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px; background-color: #145956">
                                    <b>ACCEPT</b>
                                </a>
                                <a class="btn btn-danger" href="{{ route('appointmentReject', $dataInprogress->id) }}" style="border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px">
                                    <b>REJECT</b>
                                </a></center>
                            </td>
                        </tr>
                    </tbody>
                </table>
                @endforeach
                @elseif(! $inprogressexistSupervisor)
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead style="background-color: #86B5B3; color: black;">
                        <tr>
                            <th colspan="2">
                                <center>
                                    <h5 style="color: red"><i class="material-icons" style="color: red">warning</i> No Data</h5>
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

@endsection