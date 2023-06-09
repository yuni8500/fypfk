@extends('layouts.sideNav')

@section('content')

@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>SUPERVISOR REPLACEMENT</b></h3>

<div class="card" style="margin: auto">

    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                <!-- FOR STAFF TO VIEW RECORD APPOINTMENT LIST START -->
                <table class="table table-bordered" id="dataTable" style="width: 100%; margin: auto" cellspacing="0">
                <form method="post" action="{{ route('updateSupervisorReplacement', $applydata->applyID) }}">
                    @csrf
                    @method('PUT')
                    <tbody>
                        <tr>
                            <td style="text-align: center; color: black"><label>Student Name</label></td>
                            <td>
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="studName" id="studName" value="{{$applydata->superviseeName}}" readonly>
                            </td>
                            <td style="text-align: center; color: black"><label>Student ID</label></td>
                            <td>
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="studID" id="studID" value="{{$applydata->superviseeMatric}}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Course</label></td>
                            <td>
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px;" class="form-control" name="course" id="course" value="{{$applydata->superviseeCourse}}" readonly>
                            </td>
                            <td style="text-align: center; color: black"><label>Semester</label></td>
                            <td>
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px;" class="form-control" name="semester" id="semester" value="{{$applydata->semester}}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Project Title</label></td>
                            <td colspan="3">
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px;" class="form-control" name="title" id="title" value="{{$applydata->proposedTitle}}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Background Problem</label></td>
                            <td colspan="3">
                                <textarea class="form-control" name="problem" id="problem" rows="4" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" readonly>{{$applydata->problemStatement}}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Objective</label></td>
                            <td colspan="3">
                                <textarea class="form-control" name="problem" id="problem" rows="4" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" readonly>{{$applydata->objective}}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Scope</label></td>
                            <td colspan="3">
                                <textarea class="form-control" name="problem" id="problem" rows="4" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" readonly>{{$applydata->scope}}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Former Supervisor</label></td>
                            <td>
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="formerSupervisor" id="formerSupervisor" value="{{$applydata->supervisorName}}" readonly>
                            </td>
                            <td style="text-align: center; color: black"><label>Current Supervisor</label></td>
                            <td>
                                <select name="currentSupervisor" id="currentSupervisor" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" required>
                                    <option value="">Please select staff name</option>
                                    @foreach($staff as $data)
                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <center>
                                    <button type="submit" class="btn btn-primary" style="background-color: #145956; border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px">
                                        <b>UPDATE</b>
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
        Are you sure want to cancel make supervisor replacement?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <a type="button" class="btn btn-primary" href="{{ route('displaySupervisorApplicationRecord', $applydata->supervisorID) }}'">Confirm</a>
      </div>
    </div>
  </div>
</div>
@endsection