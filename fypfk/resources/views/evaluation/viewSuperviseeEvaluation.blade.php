@extends('layouts.sideNav')

@section('content')

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>EVALUATION INFORMATION</b></h3>
@if( auth()->user()->category== "Staff")
<a href="{{ route('evaluationRecordPTA1') }}" style="color: black">
    <i class="material-icons" style="color: black; font-size: 20px">keyboard_arrow_left</i> <b>BACK</b>
</a>
@endif
@if( auth()->user()->category== "Admin")
<a href="{{ route('evaluationAdmin') }}" style="color: black">
    <i class="material-icons" style="color: black; font-size: 20px">keyboard_arrow_left</i> <b>BACK</b>
</a>
@endif
<br><br>
<div class="card">
    
    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tr>
                        <th style="background-color: #86B5B3; color: black;"><center>Name</center></th>
                        <td colspan="3">{{$user->superviseeName}}</td>
                    </tr>
                    <tr>
                        <th style="background-color: #86B5B3; color: black;"><center>Student ID</center></th>
                        <td colspan="3">{{$user->superviseeMatric}}</td>
                    </tr> 
                    <tr>
                        <th style="background-color: #86B5B3; color: black;"><center>Supervisor Name</center></th>
                        <td colspan="3">{{$user->supervisorName}}</td>
                    </tr>
                    @foreach($evaluation as $data)    
                    <tr>
                        <th style="background-color: #86B5B3; color: black;"><center>Date</center></th>
                        <td colspan="3">
                        @if ($evaluation->isEmpty())
                            Not assigned yet
                        @else
                            {{$data->dateEvaluate}}
                        @endif
                        </td>
                    </tr>
                    <tr>
                        <th style="background-color: #86B5B3; color: black;"><center>Time</center></th>
                        <td colspan="3">
                            @if ($evaluation->isEmpty())
                                Not assigned yet
                            @else
                                {{$data->timeEvaluate}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th style="background-color: #86B5B3; color: black;"><center>Location</center></th>
                        <td colspan="3">
                            @if ($evaluation->isEmpty())
                                Not assigned yet
                            @else
                                {{$data->location}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th style="background-color: #86B5B3; color: black;"><center>Evaluators 1</center></th>
                        <td>
                            @if ($evaluation->isEmpty())
                                Not assigned yet
                            @else
                                {{$data->evaluator1}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th style="background-color: #86B5B3; color: black;"><center>Evaluators 2</center></th>
                        <td>
                            @if ($evaluation->isEmpty())
                                Not assigned yet
                            @else
                                {{$data->evaluator2}}
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    @foreach ($evaluateData as $evaluator => $datafile)
                    <tr>
                        <th style="background-color: #86B5B3; color: black;"><center>Evaluation File {{ $evaluator }}</center></th>
                        <td>
                            <div>
                                @if (!empty($datafile['file']))
                                    <iframe src="/assets/{{ $datafile['file'] }}" width="400" height="300"></iframe>
                                @else
                                    No attached file
                                @endif
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th style="background-color: #86B5B3; color: black;"><center>Comment {{ $evaluator }}</center></th>
                        <td>
                            {{ $datafile['comment'] ?? 'No comment' }}
                        </td>
                    </tr>
                    <tr>
                        <th style="background-color: #86B5B3; color: black;"><center>Marks {{ $evaluator }}</center></th>
                        <td>
                            @if (isset($datafile['marks']))
                                {{ $datafile['marks'] }}
                            @else
                                No grade
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <th style="background-color: #86B5B3; color: black;"><center>Total Marks</center></th>
                        <td colspan="3">
                            {{ $totalMarks->totalMarks ?? 'No graded' }}
                        </td>
                    </tr>
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