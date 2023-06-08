@extends('layouts.sideNav')

@section('content')

@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>VIEW EVALUATION</b></h3>

<div class="card" style="margin: auto">

    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
            @foreach($evaluation as $evaluationdata)
                <table class="table table-bordered" id="dataTable" style="width: 100%; margin: auto" cellspacing="0">
                    <tbody>
                        <tr>
                            <td style="text-align: center; color: black"><label>Student Name</label></td>
                            <td>
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="studName" id="studName" value="{{ $evaluationdata->superviseeName }}" readonly>
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
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Evaluator 1</label></td>
                            <td>
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="evaluator1" id="evaluator1" value="{{ $evaluationdata->evaluator1 }}" readonly>
                            </td>
                            <td colspan="2">
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="evaluator1marks" id="evaluator1marks" value="{{ $evaluateMarks['Evaluator 1'] ?? 'No graded' }}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Evaluator 2</label></td>
                            <td>
                            <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="evaluator2" id="evaluator2" value="{{ $evaluationdata->evaluator2 }}" readonly>
                            </td>
                            <td colspan="2">
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="evaluator2marks" id="evaluator2marks" value="{{ $evaluateMarks['Evaluator 2'] ?? 'No graded' }}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Date</label></td>
                            <td>
                                <input type="date" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="date" id="date" value="{{ $evaluationdata->dateEvaluate }}" readonly>
                            </td>
                            <td style="text-align: center; color: black"><label>Time</label></td>
                            <td>
                                <input type="time" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="time" id="time" value="{{ $evaluationdata->timeEvaluate }}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Location</label></td>
                            <td colspan="3">
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="location" id="location" value="{{ $evaluationdata->location }}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <center>
                                    <a class="btn btn-danger" href="{{ route('evaluationAdmin') }}" style="border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px">
                                        <b>CANCEL</b>
                                    </a>
                                </center>
                            </td>
                        </tr>
                    </tbody>
                </table>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection