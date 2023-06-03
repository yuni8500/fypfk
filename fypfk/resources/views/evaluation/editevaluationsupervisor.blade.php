@extends('layouts.sideNav')

@section('content')

<!-- to display the alert message if the record has been deleted -->
@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>UPDATE EVALUATION GRADED</b></h3>
<div class="card">
    
    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <form method="post" action="{{ route('insertEvaluationGraded', $evaluationinfo->evaluationID) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <tbody>
                        <tr>
                            <td><label>Evaluatee Name</label></td>
                            <td>
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="name" id="name" value="{{$evaluationinfo->superviseeName}}" required readonly>
                            </td>
                            <td><label>Evaluatee Student ID</label></td>
                            <td>
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="matric" id="matric" value="{{$evaluationinfo->superviseeMatric}}" required readonly>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Evaluatee Course</label></td>
                            <td>
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="course" id="course" value="{{$evaluationinfo->superviseeCourse}}" required readonly>
                            </td>
                            <td><label>Evaluation Date</label></td>
                            <td>
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="evaluationDate" id="evaluationDate" value="{{$evaluationinfo->dateEvaluate}}" required readonly>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Evaluatee Supervisor Name</label></td>
                            <td>
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="supervisorName" id="supervisorName" value="{{$evaluationinfo->supervisorName}}" required readonly>
                            </td>
                            <td><label>Evaluator Name</label></td>
                            <td>
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="evaluatorName" id="evaluatorName" value="{{$evaluationinfo->evaluatorName}}" required readonly>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Evaluation File</label></td>
                            <td colspan="3">
                                <input type="file" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="fileEvaluate" id="fileEvaluate" accept="application/pdf" onchange="loadFile(this)">
                                @if($fileexist)
                                <div>
                                    <iframe src="/assets/{{$evaluationinfo->file}}" width="500" height="400"></iframe>
                                </div>
                                @elseif(! $fileexist)
                                
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><label>Marks</label></td>
                            <td colspan="3">
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="marks" id="marks" value="{{$evaluationinfo->marks}}" required>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Comment</label></td>
                            <td colspan="3">
                                <textarea class="form-control" name="comment" id="comment" rows="3" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" required>{{$evaluationinfo->comment}}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <center>
                                    <button type="submit" class="btn btn-primary" style="background-color: #145956; border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px">
                                        <b>UPDATE</b>
                                    </button>
                                    <a class="btn btn-danger" href="{{ route('supervisorEvaluation') }}" style="border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px">
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

@endsection

<!-- to preview the chosen file from computer -->
<script type="text/javascript" src='https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.3.min.js'></script>
<script type="text/javascript" src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/js/bootstrap.min.js'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">
    $(function() {
        $("#fileEvaluate").change(function() {
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