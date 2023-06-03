@extends('layouts.sideNav')

@section('content')

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>{{$submissionData->title}}</b></h3>

@if( auth()->user()->category== "Student")
@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif
<div class="card" style="width: 100%; margin: auto">

    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                @if(! $submissionexist)
                    <table class="table table-bordered" id="dataTable" style="width: 100%; margin: auto" cellspacing="0">
                    <form method="post" action="{{ route('insertSuperviseeSubmission', $submissionData->id) }}" enctype="multipart/form-data">
                        @csrf
                        <tr>
                            <th style="background-color: #145956; color: white"><center>Submission Status</center></th>
                            <td><label>No attempt</label></td>
                        </tr>
                        <tr>
                            <th style="background-color: #145956; color: white"><center>Grading Status</center></th>
                            <td>
                                <label>No graded</label>
                            </td>
                        </tr>
                        <tr>
                            <th style="background-color: #145956; color: white"><center>Due Date</center></th>
                            <td><label>{{ date('l, d/m/Y', strtotime($submissionData->dueDate)) }}, {{$submissionData->dueTime}}</label></td>
                        </tr>
                        <tr>
                            <th style="background-color: #145956; color: white"><center>Last Modified</center></th>
                            <td>
                                <label>No modified</label>
                            </td>
                        </tr>
                        <tr>
                            <th style="background-color: #145956; color: white"><center>File Submissions</center></th>
                            <td>
                                <input type="file" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="filesubmit" id="filesubmit" accept="application/pdf" onchange="loadFile(this)">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <center>
                                    <button type="submit" class="btn btn-primary" style="background-color: #145956; border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px">
                                        <b>SUBMIT</b>
                                    </button>
                                    <a class="btn btn-danger" href="{{ route('submission') }}" style="border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px">
                                        <b>CANCEL</b>
                                    </a>
                                </center>
                            </td>
                        </tr>
                    </form>
                    </table>
                @else
                <table class="table table-bordered" id="dataTable" style="width: 100%; margin: auto" cellspacing="0">
                @foreach($submission as $data)    
                <form method="post" action="{{ route('updateSuperviseeSubmission', $data->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <tr>
                            <th style="background-color: #145956; color: white"><center>Submission Status</center></th>
                            <td><label>Submitted</label></td>
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
                        </tr>
                        <tr>
                            <th style="background-color: #145956; color: white"><center>Due Date</center></th>
                            <td><label>{{ date('l, d/m/Y', strtotime($data->dueDate)) }}, {{$data->dueTime}}</label></td>
                        </tr>
                        <tr>
                            <th style="background-color: #145956; color: white"><center>Last Modified</center></th>
                            <td>
                                @if (!is_null($data->updated_at))
                                    <label>{{$data->updated_at}}</label>
                                @else
                                    <label>No modified</label>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th style="background-color: #145956; color: white"><center>File Submissions</center></th>
                            <td>
                                <input type="file" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="filesubmit" id="filesubmit" accept="application/pdf" onchange="loadFile(this)">
                                
                                @if($fileexist)
                                
                                @elseif(! $fileexist)
                                <div>
                                    <iframe src="/assets/{{$data->docSubmission}}" width="500" height="400"></iframe>
                                </div>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <center>
                                    <button type="submit" class="btn btn-primary" style="background-color: #145956; border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px">
                                        <b>UPDATE</b>
                                    </button>
                                    <a class="btn btn-danger" href="{{ route('submission') }}" style="border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px">
                                        <b>CANCEL</b>
                                    </a>
                                </center>
                            </td>
                        </tr>
                    </form>
                    @endforeach
                    </table>
                @endif
            </div>
        </div>
    </div>
</div>
@endif

<!-- supervisor -->
@if( auth()->user()->category== "Staff")
<a href="{{ route('submission') }}" style="color: black">
    <i class="material-icons" style="color: black; font-size: 20px">keyboard_arrow_left</i> <b>BACK</b>
</a>
<br><br>
<table>
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
            <a class="btn" href="{{ route('viewSuperviseeSubmission') }}" style="border-radius: 10px; border: none; width: 85px; color: white; background-color: #145956; font-size: 15px">
                <b>SUBMIT</b>
            </a>
        </td>
    </tr>
</table>
@endif

<!-- admin -->
@if( auth()->user()->category== "Admin")
<a href="{{ route('submission') }}" style="color: black">
    <i class="material-icons" style="color: black; font-size: 20px">keyboard_arrow_left</i> <b>BACK</b>
</a>
<br><br>
<table>
<form action="{{ route('viewSubmissionAdmin', $submissionData->id) }}" method="POST">
@csrf
    <tr>
        <td>
            <select name="supervisorName" id="supervisorName" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control">
                <option value="">Please select staff name</option>
                @foreach($staff as $staffdata)
                <option value="{{$staffdata->id}}">{{$staffdata->name}}</option>
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
@endif
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
        $("#docSubmission").change(function() {
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