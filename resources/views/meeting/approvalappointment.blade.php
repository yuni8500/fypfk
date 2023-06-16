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
                                <a class="btn btn-danger" style="border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px" data-toggle="modal" data-target="#rejectNoti">
                                    <b>REJECT</b>
                                </a></center>
                            </td>
                        </tr>
                    </tbody>
                </table>
<!--reject noti-->
<div class="modal fade" id="rejectNoti" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Warning Notification</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure want to reject this meeting appointment?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <a type="button" class="btn btn-primary" href="{{ route('appointmentReject', $dataInprogress->id) }}">Confirm</a>
      </div>
    </div>
  </div>
</div>
                @endforeach
                @elseif(! $inprogressexistSupervisor)
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead style="background-color: #86B5B3; color: black;">
                        <tr>
                            <th colspan="2">
                                <center>
                                    <h5 style="color: red"><i class="material-icons" style="color: red">priority_high</i> No Appointment Meeting <i class="material-icons" style="color: red">priority_high</i></h5>
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