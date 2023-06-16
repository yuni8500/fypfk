@extends('layouts.sideNav')

@section('content')

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>{{$submissionData->title}}</b></h3>

<div class="card" style="width: 100%; margin: auto">

    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
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
                        <td colspan="3"><label>No graded</label></td>
                    </tr>
                    <tr>
                        <th style="background-color: #145956; color: white"><center>Due Date</center></th>
                        <td colspan="3"><label>{{ date('l, d/m/Y', strtotime($submissionData->dueDate)) }}, {{$submissionData->dueTime}}</label></td>
                    </tr>
                    <tr>
                        <th style="background-color: #145956; color: white"><center>File Submissions</center></th>
                        <td colspan="3">
                            <input type="file" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="filesubmit" id="filesubmit" multiple>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <center>
                                <a class="btn btn-danger" href="{{ route('viewSubmission', $submissionData->id) }}" style="border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px">
                                    <b>CANCEL</b>
                                </a>
                            </center>
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
                        <td colspan="3">
                            @if (!is_null($data->marks))
                                <label>{{$data->marks}}</label>
                            @else
                                <label>No graded</label>
                            @endif
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
                                <input type="file" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="filesubmit" id="filesubmit" accept="application/pdf" onchange="loadFile(this)">
                            @elseif(! $fileexist)
                                <div>
                                    <iframe src="/assets/{{$data->docSubmission}}" width="500" height="400"></iframe>
                                </div>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <center>
                                <a class="btn btn-danger" href="{{ route('viewSubmission', $submissionData->id) }}" style="border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px">
                                    <b>CANCEL</b>
                                </a>
                            </center>
                        </td>
                    </tr>
                @endforeach
                </table>
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