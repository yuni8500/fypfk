@extends('layouts.sideNav')

@section('content')


<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>MEETING SCHEDULE</b></h3>
<div class="card">
    
    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                @if( auth()->user()->category== "Student")
                <a class="btn btn-primary" href="{{ route('createAppointment') }}" style="border-radius: 10px; border: none; width: 15%; color: white; font-size: 15px; background-color: #145956; margin-left: 875px; margin-bottom:15px">
                <i class="material-icons" style="color: white">date_range</i> <b>BOOK MEETING</b>
                </a>
                <br>

                <hr>
                <center><h5 style="color: black">APPROVED</h5></center>
                <hr>
                <!-- FOR SUPERVISEE TO VIEW RECORD APPOINTMENT LIST -->
                @if($approvedexist)
                @foreach($approved as $dataapproved)
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead style="background-color: #86B5B3; color: black;">
                        <tr>
                            <th colspan="2">{{$dataapproved->appointTitle}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><label>Date:</label></td>
                            <td><label>{{$dataapproved->appointDate}}</label></td>
                        </tr>
                        <tr>
                            <td><label>Start Time:</label></td>
                            <td><label>{{$dataapproved->startTime}}</label></td>
                        </tr>
                        <tr>
                            <td><label>End Time:</label></td>
                            <td><label>{{$dataapproved->endTime}}</label></td>
                        </tr>
                        <tr>
                            <td><label>Meeting Personal:</label></td>
                            <td>
                                <label>{{$dataapproved->name}}</label>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Purpose:</label></td>
                            <td><label>{{$dataapproved->purpose}}</label></td>
                        </tr>
                        <tr>
                            <td><label>Location:</label></td>
                            <td><label>{{$dataapproved->appointLocation}}</label></td>
                        </tr>
                    </tbody>
                </table>
                @endforeach
                @elseif(! $approvedexist)
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

                <hr>
                <center><h5 style="color: black">REJECTED</h5></center>
                <hr>
                <!-- FOR SUPERVISEE TO VIEW RECORD APPOINTMENT LIST -->
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
                                    <h5 style="color: red"><i class="material-icons" style="color: red">warning</i> No Data</h5>
                                </center>
                            </th>
                        </tr>
                    </thead>
                </table>
                @endif

                <br>
                <hr>
                <center><h5 style="color: black">IN PROGRESS</h5></center>
                <hr>
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
                                    <h5 style="color: red"><i class="material-icons" style="color: red">warning</i> No Data</h5>
                                </center>
                            </th>
                        </tr>
                    </thead>
                </table>
                @endif
                @endif

                <!-- Supervisor-->
                @if( auth()->user()->category== "Staff")
                <hr>
                <center><h5 style="color: black">APPROVAL</h5></center>
                <hr>
                <!-- FOR SUPERVISEE TO VIEW RECORD APPOINTMENT LIST -->
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

                <br>
                <hr>
                <center><h5 style="color: black">SCHEDULE</h5></center>
                <hr>
                @if($approvedexistSupervisor)
                @foreach($approvedSupervisor as $dataApproved)
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead style="background-color: #86B5B3; color: black;">
                        <tr>
                            <th colspan="2">{{$dataApproved->appointTitle}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><label>Date:</label></td>
                            <td><label>{{$dataApproved->appointDate}}</label></td>
                        </tr>
                        <tr>
                            <td><label>Start Time:</label></td>
                            <td><label>{{$dataApproved->startTime}}</label></td>
                        </tr>
                        <tr>
                            <td><label>End Time:</label></td>
                            <td><label>{{$dataApproved->endTime}}</label></td>
                        </tr>
                        <tr>
                            <td><label>Meeting Personal:</label></td>
                            <td>
                                <label>{{$dataApproved->name}}</label>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Purpose:</label></td>
                            <td><label>{{$dataApproved->purpose}}</label></td>
                        </tr>
                        <tr>
                            <td><label>Location:</label></td>
                            <td><label>{{$dataApproved->appointLocation}}</label></td>
                        </tr>
                    </tbody>
                </table>
                @endforeach
                @elseif(! $approvedexistSupervisor)
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
                @endif
            </div>
        </div>
    </div>
</div>

@endsection