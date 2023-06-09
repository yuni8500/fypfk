@extends('layouts.sideNav')

@section('content')

@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>UPDATE EVALUATION</b></h3>

<div class="card" style="margin: auto">

    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
            @foreach($evaluation as $evaluationdata)
                <table class="table table-bordered" id="dataTable" style="width: 100%; margin: auto" cellspacing="0">
                <form method="post" action="{{ route('updateEvaluation', $evaluationdata->evaluationID) }}">
                    @csrf
                    @method('PUT')
                    <tbody>
                        <tr>
                            <td style="text-align: center; color: black"><label>Student Name</label></td>
                            <td>
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="studName" id="studName" value="{{ $evaluationdata->superviseeName }}" readonly>
                                <input type="hidden" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="studID" id="studID" value="{{ $evaluationdata->superviseeID }}">
                            </td>
                            <td style="text-align: center; color: black"><label>Student ID</label></td>
                            <td>
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="matric" id="matric" value="{{ $evaluationdata->superviseeMatric }}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Course</label></td>
                            <td>
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="course" id="course" value="{{ $evaluationdata->superviseeCourse }}" readonly>
                            </td>
                            <td style="text-align: center; color: black"><label>Semester</label></td>
                            <td>
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="semester" id="semester" value="{{ $evaluationdata->semester }}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Supervisor Name</label></td>
                            <td colspan="3">
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="supervisorName" id="supervisorName" value="{{ $evaluationdata->supervisorName }}" readonly>
                                <input type="hidden" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="supervisorID" id="supervisorID" value="{{ $evaluationdata->supervisorID }}">
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Evaluator 1</label></td>
                            <td>
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="evaluator1" id="evaluator1" value="{{ $evaluationdata->evaluator1 }}">
                            </td>
                            <td colspan="2">
                                <select name="staffName1" id="staffName1" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control">
                                    <option value="">Select evaluator 1 name for updating process</option>
                                    @foreach($staff as $data)
                                    <option value="{{ $data->name }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Evaluator 2</label></td>
                            <td>
                            <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="evaluator2" id="evaluator2" value="{{ $evaluationdata->evaluator2 }}">
                            </td>
                            <td colspan="2">
                                <select name="staffName2" id="staffName2" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control">
                                    <option value="">Select evaluator 2 name for updating process</option>
                                    @foreach($staff as $data)
                                    <option value="{{ $data->name }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Date</label></td>
                            <td>
                                <input type="date" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="date" id="date" value="{{ $evaluationdata->dateEvaluate }}">
                            </td>
                            <td style="text-align: center; color: black"><label>Time</label></td>
                            <td>
                                <input type="time" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="time" id="time" value="{{ $evaluationdata->timeEvaluate }}">
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Location</label></td>
                            <td colspan="3">
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="location" id="location" value="{{ $evaluationdata->location }}">
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
                @endforeach
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
        Are you sure want to cancel update the evaluation information?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <a type="button" class="btn btn-primary" href="{{ route('evaluationAdmin') }}">Confirm</a>
      </div>
    </div>
  </div>
</div>
@endsection