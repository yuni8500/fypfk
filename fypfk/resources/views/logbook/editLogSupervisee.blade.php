@extends('layouts.sideNav')

@section('content')

<!-- to display the alert message if the record has been deleted -->
@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>UPDATE LOGBOOK</b></h3>
<div class="card">
    
    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                @foreach($logbookdata as $data)
                <form method="post" action="{{ route('updateSuperviseeLogbook', $data->logbookID) }}">
                    @csrf
                    @method('PUT')
                    <tbody>
                        <tr>
                            <td><label>Student Name</label></td>
                            <td colspan="3">
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="week" id="week" value="{{$data->name}}" required readonly>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Student ID</label></td>
                            <td>
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="dateLog" id="dateLog" value="{{$data->matric}}" required readonly>
                            </td>
                            <td><label>Date</label></td>
                            <td>
                                <input type="date" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="dateLog" id="dateLog" value="{{$data->appointDate}}" required readonly>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Time Start</label></td>
                            <td>
                                <input type="time" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="tStart" id="tStart" value="{{$data->startTime}}" required readonly>
                            </td>
                            <td><label>Time End</label></td>
                            <td>
                                <input type="time" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="tEnd" id="tEnd" value="{{$data->endTime}}" required readonly>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Progress</label></td>
                            <td colspan="3">
                            <textarea class="form-control" name="progress" id="progress" rows="3" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" readonly>{{$data->progress}}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Supervisor Comment</label></td>
                            <td colspan="3">
                            <textarea class="form-control" name="comment" id="comment" rows="3" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" required>{{$data->comment}}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <center>
                                    <button type="submit" class="btn btn-primary" style="background-color: #145956; border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px">
                                        <b>UPDATE</b>
                                    </button>
                                    <a class="btn btn-danger" style="border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px;" data-toggle="modal" data-target="#backNoti">
                                        <b>BACK</b>
                                    </a>
                                </center>
                            </td>
                        </tr>
                    </tbody>
                </form>
<!--back noti-->
<div class="modal fade" id="backNoti" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Warning Notification</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure want to cancel update logbook?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <a type="button" class="btn btn-primary" href="{{ route('logbookSuperviseeView', $data->userID) }}">Confirm</a>
      </div>
    </div>
  </div>
</div>
                @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
<br>
<script src="{{ asset('frontend') }}/js/jquery.dataTables.js"></script>
<Script>

</script>
@endsection