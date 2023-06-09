@extends('layouts.sideNav')

@section('content')

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>EVALUATION INFORMATION</b></h3>

<div class="card">
    
    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
        @if($applyexist)
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
                    <tr>
                        <th style="background-color: #86B5B3; color: black;"><center>Marks Evaluators 1</center></th>
                        <td>
                            {{ $evaluateMarks['Evaluator 1'] ?? 'No graded' }}
                        </td>
                        <th style="background-color: #86B5B3; color: black;"><center>Marks Evaluators 2</center></th>
                        <td>
                            {{ $evaluateMarks['Evaluator 2'] ?? 'No graded' }}
                        </td>
                    </tr>
                    <tr>
                        <th style="background-color: #86B5B3; color: black;"><center>Total Marks</center></th>
                        <td colspan="3">
                            {{ $totalMarks->totalMarks ?? 'No graded' }}
                        </td>
                    </tr>
                </table>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tr>
                        <th style="background-color: #86B5B3; color: black;"><center>Name</center></th>
                        <td colspan="3">{{$userdata->name}}</td>
                    </tr>
                    <tr>
                        <th style="background-color: #86B5B3; color: black;"><center>Student ID</center></th>
                        <td colspan="3">{{$userdata->matric}}</td>
                    </tr> 
                    <tr>
                        <th style="background-color: #86B5B3; color: black;"><center>Supervisor Name</center></th>
                        <td colspan="3">No Supervisor</td>
                    </tr> 
                    <tr>
                        <th style="background-color: #86B5B3; color: black;"><center>Date</center></th>
                        <td colspan="3">Not assigned yet</td>
                    </tr>
                    <tr>
                        <th style="background-color: #86B5B3; color: black;"><center>Time</center></th>
                        <td colspan="3">Not assigned yet</td>
                    </tr>
                    <tr>
                        <th style="background-color: #86B5B3; color: black;"><center>Location</center></th>
                        <td colspan="3">Not assigned yet</td>
                    </tr>
                    <tr>
                        <th style="background-color: #86B5B3; color: black;"><center>Evaluators 1</center></th>
                        <td>Not assigned yet</td>
                        <th style="background-color: #86B5B3; color: black;"><center>Evaluators 2</center></th>
                        <td>Not assigned yet</td>
                    </tr>
                    <tr>
                        <th style="background-color: #86B5B3; color: black;"><center>Marks Evaluators 1</center></th>
                        <td>No graded</td>
                        <th style="background-color: #86B5B3; color: black;"><center>Marks Evaluators 2</center></th>
                        <td>No graded</td>
                    </tr>
                    <tr>
                        <th style="background-color: #86B5B3; color: black;"><center>Total Marks</center></th>
                        <td colspan="3">No graded</td>
                    </tr>
                </table>
            </div>
            @endif
        </div>
    </div>
</div>
<br>
<script src="{{ asset('frontend') }}/js/jquery.dataTables.js"></script>
<Script>

</script>
@endsection