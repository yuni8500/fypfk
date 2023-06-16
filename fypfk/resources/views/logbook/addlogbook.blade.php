@extends('layouts.sideNav')

@section('content')

<!-- to display the alert message if the record has been deleted -->
@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>CREATE LOGBOOK</b></h3>
<div class="card">
    
    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <form method="post" action="{{ route('insertLogbook') }}">
                    @csrf
                    <tbody>
                        <tr>
                            <td><label>Date</label></td>
                            <td>
                                <select name="date" id="date" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" required>
                                    <option value="">Please select date</option>
                                    @foreach($appointmentData as $appointdata)
                                        <option value="{{$appointdata->id}}">{{$appointdata->appointDate}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td><label>Supervisor Name</label></td>
                            <td colspan="3">
                                @foreach($getdata as $key=>$data)
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="supervisorName" id="supervisorName" value="{{$data->name}}" readonly>
                                <input type="hidden" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="supervisorID" id="supervisorID" value="{{$data->supervisorID}}" readonly>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td><label>Progress</label></td>
                            <td colspan="3">
                            <textarea class="form-control" name="progress" id="progress" rows="3" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" required></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <center>
                                    <button type="submit" class="btn btn-primary" style="background-color: #145956; border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px">
                                        <b>SUBMIT</b>
                                    </button>
                                    <a class="btn btn-danger" style="border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px" data-toggle="modal" data-target="#backNoti">
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
<br>
<script src="{{ asset('frontend') }}/js/jquery.dataTables.js"></script>
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
        Are you sure want to cancel create a logbook?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <a type="button" class="btn btn-primary" href="{{ route('logbook') }}">Confirm</a>
      </div>
    </div>
  </div>
</div>
@endsection