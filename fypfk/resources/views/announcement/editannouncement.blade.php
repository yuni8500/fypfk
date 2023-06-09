@extends('layouts.sideNav')

@section('content')

<!-- to display the alert message if the record has been deleted -->
@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>EDIT ANNOUNCEMENT</b></h3>
<div class="card">
    
    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <form method="post" action="{{ route('updateAnnouncement', $announcementview->id) }}">
                    @csrf
                    @method('PUT')
                    <tbody>
                        <tr>
                            <td><label>Week</label></td>
                            <td colspan="3">
                                <input type="number" style="background-color: #86B5B3; border-radius: 10px; width: 50%;" class="form-control" name="week" id="week" value="{{$announcementview->week}}" required>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Title</label></td>
                            <td colspan="3">
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="title" id="title" value="{{$announcementview->title}}" required>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Date</label></td>
                            <td>
                                <input type="date" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="date" id="date" value="{{$announcementview->date}}" required>
                            </td>
                            <td><label>Time</label></td>
                            <td>
                                <input type="time" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="time" id="time" value="{{$announcementview->time}}" required>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Information</label></td>
                            <td colspan="3">
                                <textarea class="form-control" name="information" id="information" rows="5" style="background-color: #86B5B3; border-radius: 10px; width: 100%;">{{$announcementview->information}}</textarea>
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
<Script>

</script>
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
        Are you sure want to cancel update an announcement?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <a type="button" class="btn btn-primary" href="{{ route('dashboard') }}">Confirm</a>
      </div>
    </div>
  </div>
</div>
@endsection