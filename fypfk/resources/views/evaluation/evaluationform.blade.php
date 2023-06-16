@extends('layouts.sideNav')

@section('content')

@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>CREATE EVALUATION</b></h3>

<div class="card" style="margin: auto">

    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" style="width: 100%; margin: auto" cellspacing="0">
                <form method="post" action="{{ route('insertEvaluation') }}">
                    @csrf
                    <tbody>
                        @foreach($supervisee as $superviseedata)
                        <tr>
                            <td style="text-align: center; color: black"><label>Student Name</label></td>
                            <td>
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="studName" id="studName" value="{{ $superviseedata->superviseeName }}" readonly>
                                <input type="hidden" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="studID" id="studID" value="{{ $superviseedata->superviseeID }}">
                            </td>
                            <td style="text-align: center; color: black"><label>Student ID</label></td>
                            <td>
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="matric" id="matric" value="{{ $superviseedata->superviseeMatric }}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Course</label></td>
                            <td>
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="course" id="course" value="{{ $superviseedata->superviseeCourse }}" readonly>
                            </td>
                            <td style="text-align: center; color: black"><label>Semester</label></td>
                            <td>
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="semester" id="semester" value="{{ $superviseedata->semester }}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Supervisor Name</label></td>
                            <td colspan="3">
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="supervisorName" id="supervisorName" value="{{ $superviseedata->supervisorName }}" readonly>
                                <input type="hidden" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="supervisorID" id="supervisorID" value="{{ $superviseedata->supervisorID }}">
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td style="text-align: center; color: black"><label>Link Evaluation File</label></td>
                            <td colspan="3">
                                <input type="url" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="linkFile" id="linkFile" value="" required>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Evaluator 1</label></td>
                            <td colspan="3">
                                <select name="staffName1" id="staffName1" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" required>
                                    <option value="">Please select evaluator 1 name</option>
                                    @foreach($staff as $data)
                                    <option value="{{ $data->name }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Evaluator 2</label></td>
                            <td colspan="3">
                                <select name="staffName2" id="staffName2" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" required>
                                    <option value="">Please select evaluator 2 name</option>
                                    @foreach($staff as $data)
                                    <option value="{{ $data->name }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Date</label></td>
                            <td>
                                <input type="date" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="date" id="date" value="" required>
                            </td>
                            <td style="text-align: center; color: black"><label>Time</label></td>
                            <td>
                                <input type="time" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="time" id="time" value="" required>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Location</label></td>
                            <td colspan="3">
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="location" id="location" value="" required>
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
        Are you sure want to cancel create the evaluation?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <a type="button" class="btn btn-primary" href="{{ route('evaluationAdmin') }}">Confirm</a>
      </div>
    </div>
  </div>
</div>
@endsection