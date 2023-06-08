@extends('layouts.sideNav')

@section('content')

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>{{$submissionData->title}}</b></h3>

<a href="{{ route('submission') }}" style="color: black">
    <i class="material-icons" style="color: black; font-size: 20px">keyboard_arrow_left</i> <b>BACK</b>
</a>

<br><br>
<table>
    <form action="{{ route('viewSuperviseeSubmission', $submissionData->id) }}" method="POST">
    @csrf
    <tr>
        <td>
            <select name="superviseeName" id="superviseeName" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control">
                <option value="">Please select your supervisee</option>
                @foreach($superviseedata as $data)
                <option value="{{$data->id}}">{{$data->name}}</option>
                @endforeach
            </select>
        </td>
        <td>
            <button class="btn" style="border-radius: 10px; border: none; width: 85px; color: white; background-color: #145956; font-size: 15px">
                <b>SUBMIT</b>
            </button>
        </td>
    </tr>
</form>
</table>
<br>
<div class="card" style="width: 100%; margin: auto">

    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
            @if (($submissionData->title) == 'PTA 2 Final Submission' || ($submissionData->title) == 'PSM 2 Final Submission')
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                @if(! $submissionexist)
                    <tbody>
                        <tr>
                            <td><label>Name</label></td>
                            <td>
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="name" id="name" value="{{$studentdata->name}}" required readonly>
                            </td>
                            <td><label>Student ID</label></td>
                            <td>
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="matric" id="matric" value="{{$studentdata->matric}}" required readonly>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Project Title</label></td>
                            <td colspan="3">
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="projectTitle" id="projectTitle" value="" required readonly>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Project Abstract</label></td>
                            <td colspan="3">
                                <textarea class="form-control" name="abstract" id="abstract" rows="3" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" readonly></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Project Submission</label></td>
                            <td colspan="3">
                                <input type="file" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="filesubmit" id="filesubmit" accept="application/pdf" onchange="loadFile(this)" readonly>
                            </td>
                        </tr>
                    </tbody>
                </form>
                @else
                @foreach($submission as $data)
                    <tbody>
                        <tr>
                            <td><label>Name</label></td>
                            <td>
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="name" id="name" value="{{$data->name}}" required readonly>
                            </td>
                            <td><label>Student ID</label></td>
                            <td>
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="matric" id="matric" value="{{$data->matric}}" required readonly>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Project Title</label></td>
                            <td colspan="3">
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="projectTitle" id="projectTitle" value="{{$data->projectTitle}}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Project Abstract</label></td>
                            <td colspan="3">
                                <textarea class="form-control" name="abstract" id="abstract" rows="3" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" readonly>{{$data->abstract}}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Project Submission</label></td>
                            <td colspan="3">
                                @if($filefypexist)
                                
                                @elseif(! $filefypexist)
                                <div>
                                    <iframe src="/assets/{{$data->fileProject}}" width="500" height="400"></iframe>
                                </div>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </form>
                @endforeach
                @endif
                </table>
            @else
            @if(! $studentexist)
                <table class="table table-bordered" id="dataTable" style="width: 100%; margin: auto" cellspacing="0">
                    <tr>
                        <th style="background-color: #145956; color: white"><center>Student Name</center></th>
                        <td><label>{{$studentdata->name}}</label></td>
                        <th style="background-color: #145956; color: white"><center>Student ID</center></th>
                        <td><label>{{$studentdata->matric}}</</label></td>
                    </tr>
                    <tr>
                        <th style="background-color: #145956; color: white"><center>Submission Status</center></th>
                        <td colspan="3"><label>No attempt</label></td>
                    </tr>
                    <tr>
                        <th style="background-color: #145956; color: white"><center>Grading Status</center></th>
                        <td><label>No graded</label></td>
                        <td colspan="2">
                            <center>
                                <a class="btn" href="{{ route('submissionGraded', ['userID' => $data->userID, 'submissionID' => $submissionData->id]) }}" style="border-radius: 10px; border: none; width: 100px; color: black; background-color: #86B5B3; font-size: 15px">
                                    <b>GRADED</b>
                                </a>
                            </center>
                        </td>
                    </tr>
                    <tr>
                        <th style="background-color: #145956; color: white"><center>Due Date</center></th>
                        <td colspan="3"><label>{{ date('l, d/m/Y', strtotime($submissionData->dueDate)) }}, {{$submissionData->dueTime}}</label></td>
                    </tr>
                    <tr>
                        <th style="background-color: #145956; color: white"><center>File Submissions</center></th>
                        <td colspan="3">
                        </td>
                    </tr>
                </table>
            @else
                <table class="table table-bordered" id="dataTable" style="width: 100%; margin: auto" cellspacing="0">
                @foreach($student as $data)  
                    <tr>
                        <th style="background-color: #145956; color: white"><center>Student Name</center></th>
                        <td><label>{{$data->name}}</label></td>
                        <th style="background-color: #145956; color: white"><center>Student ID</center></th>
                        <td><label>{{$data->matric}}</</label></td>
                    </tr>
                    <tr>
                        <th style="background-color: #145956; color: white"><center>Submission Status</center></th>
                        <td colspan="3"><label>Submitted</label></td>
                    </tr>
                    <tr>
                        <th style="background-color: #145956; color: white"><center>Grading Status</center></th>
                        <td>
                            @if (!is_null($data->marks))
                                <label>{{$data->marks}}</label>
                            @else
                                <label>No graded</label>
                            @endif
                        </td>
                        <td colspan="2">
                            <center>
                                @if($gradedexist)
                                    <a class="btn" href="{{ route('submissionGraded', ['userID' => $data->userID, 'submissionID' => $submissionData->id]) }}" style="border-radius: 10px; border: none; width: 100px; color: black; background-color: #86B5B3; font-size: 15px">
                                        <b>GRADED</b>
                                    </a>
                                @elseif(! $gradedexist)
                                    <a class="btn" href="{{ route('editGradedSubmission', ['userID' => $data->userID, 'submissionID' => $submissionData->id]) }}" style="border-radius: 10px; border: none; width: 100px; color: black; background-color: #86B5B3; font-size: 15px">
                                        <b>UPDATE</b>
                                    </a>
                                @endif
                            </center>
                        </td>
                    </tr>
                    <tr>
                        <th style="background-color: #145956; color: white"><center>Due Date</center></th>
                        <td colspan="3"><label>{{ date('l, d/m/Y', strtotime($data->dueDate)) }}, {{$data->dueTime}}</label></td>
                    </tr>
                    <tr>
                        <th style="background-color: #145956; color: white"><center>File Submissions</center></th>
                        <td colspan="3">
                            @if($fileexist)
                                
                            @elseif(! $fileexist)
                                <div>
                                    <iframe src="/assets/{{$data->docSubmission}}" width="500" height="400"></iframe>
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </table>
            @endif
            @endif
            </div>
        </div>
    </div>
</div>
<br>

<script src="{{ asset('frontend') }}/js/jquery.dataTables.js"></script>
<Script>

</script>
@endsection

<!-- to preview the chosen file from computer -->
<script type="text/javascript" src='https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.3.min.js'></script>
<script type="text/javascript" src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/js/bootstrap.min.js'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">
    $(function() {
        $("#filesubmit").change(function() {
            $("#dvPreview").html("");

            $("#dvPreview").show();
            $("#dvPreview").append("<iframe />");
            $("iframe").css({
                "height": "400px",
                "width": "450px"
            });
            var reader = new FileReader();
            reader.onload = function(e) {
                $("#dvPreview iframe").attr("src", e.target.result);
            }
            reader.readAsDataURL($(this)[0].files[0]);
        });
    });
</script>

