@extends('layouts.sideNav')

@section('content')

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>{{$submissionData->title}}</b></h3>
<div class="card">
    
    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
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
                                <input type="file" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="projectFile" id="projectFile" accept="application/pdf" onchange="loadFile(this)" readonly>
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
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="projectTitle" id="projectTitle" value="{{$data->projectTitle}}" required>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Project Abstract</label></td>
                            <td colspan="3">
                                <textarea class="form-control" name="abstract" id="abstract" rows="3" style="background-color: #86B5B3; border-radius: 10px; width: 100%;">{{$data->abstract}}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Project Submission</label></td>
                            <td colspan="3">
                                <input type="file" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="projectFile" id="projectFile" accept="application/pdf" onchange="loadFile(this)">
                                @if($fileexist)
                                
                                @elseif(! $fileexist)
                                <div>
                                    <iframe src="/assets/{{$data->fileProject}}" width="500" height="400"></iframe>
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
                    </tbody>
                </form>
                @endforeach
                @endif
                </table>
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
        $("#projectFile").change(function() {
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