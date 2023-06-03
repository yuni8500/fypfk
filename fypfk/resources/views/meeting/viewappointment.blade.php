@extends('layouts.sideNav')

@section('content')

@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>VIEW APPOINTMENT</b></h3>

<div class="card" style="margin: auto">

    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                <!-- FOR STAFF TO VIEW RECORD APPOINTMENT LIST START -->
                <table class="table table-bordered" id="dataTable" style="width: 100%; margin: auto" cellspacing="0">
                @foreach($appointmentview as $data)
                <form method="post" action="{{ route('updateAppointment', $data->id) }}">
                    @csrf
                    @method('PUT')
                    <tbody>
                        <tr>
                            <td style="text-align: center; color: black"><label>Meeting Title</label></td>
                            <td colspan="3">
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="meetingTitle" id="meetingTitle" value="{{$data->appointTitle}}">
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Date</label></td>
                            <td colspan="3">
                                <input type="date" style="background-color: #86B5B3; border-radius: 10px;" class="form-control" name="date" id="date" value="{{$data->appointDate}}">
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Time Start</label></td>
                            <td>
                                <input type="time" style="background-color: #86B5B3; border-radius: 10px;" class="form-control" name="timeStart" id="timeStart" value="{{$data->startTime}}">
                            </td>
                            <td style="text-align: center; color: black"><label>Time End</label></td>
                            <td>
                                <input type="time" style="background-color: #86B5B3; border-radius: 10px;" class="form-control" name="timeEnd" id="timeEnd" value="{{$data->endTime}}">
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Purpose</label></td>
                            <td colspan="3">
                                <textarea class="form-control" name="purpose" id="purpose" rows="2" style="background-color: #86B5B3; border-radius: 10px; width: 100%;">{{$data->purpose}}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <center>
                                    <button type="submit" class="btn btn-primary" style="background-color: #145956; border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px">
                                        <b>UPDATE</b>
                                    </button>
                                    <a class="btn" href="{{ route('appointmentApprovalSupervisee') }}" style="border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px; background-color: #86B5B3">
                                        <b>BACK</b>
                                    </a>
                                    <a class="btn btn-danger" style="border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px" data-toggle="modal" data-target="#exampleModalCenter">
                                        <b>DELETE</b>
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


<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Warning Message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure to delete the meeting?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" href="{{ route('deleteAppointment', $data->id) }}">Confirm</button>
      </div>
    </div>
  </div>
</div>
@endforeach
@endsection