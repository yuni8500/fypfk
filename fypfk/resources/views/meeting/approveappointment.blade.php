@extends('layouts.sideNav')

@section('content')

@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>APPROVE APPOINTMENT</b></h3>

<div class="card" style="margin: auto">

    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                <!-- FOR STAFF TO VIEW RECORD APPOINTMENT LIST START -->
                <table class="table table-bordered" id="dataTable" style="width: 100%; margin: auto" cellspacing="0">
                <form method="post" action="{{ route('updateAppointmentAgree', $appointmentview->id) }}">
                    @csrf
                    @method('PUT')
                    <tbody>
                        <tr>
                            <td style="text-align: center; color: black"><label>Location</label></td>
                            <td>
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px;" class="form-control" name="location" id="location" required>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <center>
                                    <button type="submit" class="btn btn-primary" style="background-color: #145956; border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px">
                                        <b>SUBMIT</b>
                                    </button>
                                    <a class="btn btn-danger" style="border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px" data-toggle="modal" data-target="#cancelNoti">
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
<!--cancel noti-->
<div class="modal fade" id="cancelNoti" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Warning Notification</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure want to cancel accept this meeting appointment?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <a type="button" class="btn btn-primary" href="{{ route('approvalMeeting') }}">Confirm</a>
      </div>
    </div>
  </div>
</div>
@endsection