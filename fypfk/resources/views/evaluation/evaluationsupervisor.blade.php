@extends('layouts.sideNav')

@section('content')

<!-- to display the alert message if the record has been deleted -->

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>EVALUATION INFORMATION</b></h3>
<div class="card">
    <div class="card-body">
        <a class="btn btn-primary" href="{{ route('evaluationRecordPTA1') }}" style="border-radius: 10px; border: none; width: 28%; color: white; font-size: 15px; background-color: #145956; margin-left: 746px; margin-bottom:15px">
            <i class="material-icons" style="color: white">pageview</i> <b>SUPERVISEE EVALUATION RECORD</b>
        </a>
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead style="background-color: #86B5B3; color: black;">
                        <tr>
                            <th colspan="7"><center>PTA 1</center></th>
                        </tr>
                        <tr>
                            <th><center>STUDENT NAME</center></th>
                            <th><center>STUDENT ID</center></th>
                            <th><center>SUPERVISOR NAME</center></th>
                            <th><center>DATE</center></th>
                            <th><center>TIME</center></th>
                            <th><center>LOCATION</center></th>
                            <th><center>ACTION</center></th>
                        </tr>
                    </thead>
                    <tbody>
                    @if($pta1exist && count($pta1) > 0)
                    @foreach($pta1 as $pta1data)
                        <tr>
                            <td><center><label>{{$pta1data->superviseeName}}</label></center></td>
                            <td><center><label>{{$pta1data->superviseeMatric}}</label></center></td>
                            <td><center><label>{{$pta1data->supervisorName}}</label></center></td>
                            <td><center><label>{{$pta1data->dateEvaluate}}</label></center></td>
                            <td><center><label>{{$pta1data->timeEvaluate}}</label></center></td>
                            <td><center><label>{{$pta1data->location}}</label></center></td>
                            <td>
                                <center>
                                    @php
                                        $name = Auth::user()->name;
                                        $superviseeID = $psm1data->superviseeID;
                                        $gradeexist = DB::table('evaluationmarks')
                                                    ->join('evaluation', 'evaluationmarks.evaluationID', '=', 'evaluation.id')
                                                    ->where('evaluationmarks.superviseeID', $superviseeID)
                                                    ->where('evaluationmarks.evaluatorName', $name)
                                                    ->exists();
                                    @endphp

                                @if ($gradeexist)
                                    <a class="btn btn-primary" href="{{ route('updateEvaluationGraded', $pta1data->evaluationID) }}" style="border-radius: 10px; border: none; width: 100%; color: white; font-size: 15px; background-color: #145956;">
                                        <b>UPDATE</b>
                                    </a>
                                @else
                                    <a class="btn btn-primary" href="{{ route('evaluationGraded', $pta1data->evaluationID) }}" style="border-radius: 10px; border: none; width: 100%; color: white; font-size: 15px; background-color: #145956;">
                                        <b>GRADED</b>
                                    </a>
                                @endif
                                </center>
                            </td>
                        </tr>
                    @endforeach
                    @else
                        <tr>
                            <th colspan="7">
                                <center>
                                    <h5 style="color: red"><i class="material-icons" style="color: red">priority_high</i> No Supervisee Evaluation <i class="material-icons" style="color: red">priority_high</i></h5>
                                </center>
                            </th>
                        </tr>
                    @endif
                    </tbody>
                    
                    <thead style="background-color: #86B5B3; color: black;">
                        <tr>
                            <th colspan="7"><center>PTA 2</center></th>
                        </tr>
                        <tr>
                            <th><center>STUDENT NAME</center></th>
                            <th><center>STUDENT ID</center></th>
                            <th><center>SUPERVISOR NAME</center></th>
                            <th><center>DATE</center></th>
                            <th><center>TIME</center></th>
                            <th><center>LOCATION</center></th>
                            <th><center>ACTION</center></th>
                        </tr>
                    </thead>
                    <tbody>
                    @if($pta2exist)
                        @foreach($pta2 as $pta2data)
                        <tr>
                            <td><center><label>{{$pta2data->superviseeName}}</label></center></td>
                            <td><center><label>{{$pta2data->superviseeMatric}}</label></center></td>
                            <td><center><label>{{$pta2data->supervisorName}}</label></center></td>
                            <td><center><label>{{$pta2data->dateEvaluate}}</label></center></td>
                            <td><center><label>{{$pta2data->timeEvaluate}}</label></center></td>
                            <td><center><label>{{$pta2data->location}}</label></center></td>
                            <td>
                                <center>
                                    @php
                                        $name = Auth::user()->name;
                                        $superviseeID = $psm1data->superviseeID;
                                        $gradeexist = DB::table('evaluationmarks')
                                                    ->join('evaluation', 'evaluationmarks.evaluationID', '=', 'evaluation.id')
                                                    ->where('evaluationmarks.superviseeID', $superviseeID)
                                                    ->where('evaluationmarks.evaluatorName', $name)
                                                    ->exists();
                                    @endphp

                                    @if ($gradeexist)
                                    <a class="btn btn-primary" href="{{ route('updateEvaluationGraded', $pta2data->evaluationID) }}" style="border-radius: 10px; border: none; width: 100%; color: white; font-size: 15px; background-color: #145956;">
                                        <b>UPDATE</b>
                                    </a>
                                    @else
                                        <a class="btn btn-primary" href="{{ route('evaluationGraded', $pta2data->evaluationID) }}" style="border-radius: 10px; border: none; width: 100%; color: white; font-size: 15px; background-color: #145956;">
                                            <b>GRADED</b>
                                        </a>
                                    @endif
                                </center>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <th colspan="7">
                                <center>
                                    <h5 style="color: red"><i class="material-icons" style="color: red">priority_high</i> No Supervisee Evaluation <i class="material-icons" style="color: red">priority_high</i></h5>
                                </center>
                            </th>
                        </tr>
                    @endif
                    </tbody>

                    <thead style="background-color: #86B5B3; color: black;">
                        <tr>
                            <th colspan="7"><center>PSM 1</center></th>
                        </tr>
                        <tr>
                            <th><center>STUDENT NAME</center></th>
                            <th><center>STUDENT ID</center></th>
                            <th><center>SUPERVISOR NAME</center></th>
                            <th><center>DATE</center></th>
                            <th><center>TIME</center></th>
                            <th><center>LOCATION</center></th>
                            <th><center>ACTION</center></th>
                        </tr>
                    </thead>
                    <tbody>
                    @if($psm1exist)
                    @foreach($psm1 as $psm1data)
                        <tr>
                            <td><center><label>{{$psm1data->superviseeName}}</label></center></td>
                            <td><center><label>{{$psm1data->superviseeMatric}}</label></center></td>
                            <td><center><label>{{$psm1data->supervisorName}}</label></center></td>
                            <td><center><label>{{$psm1data->dateEvaluate}}</label></center></td>
                            <td><center><label>{{$psm1data->timeEvaluate}}</label></center></td>
                            <td><center><label>{{$psm1data->location}}</label></center></td>
                            <td>
                                <center>
                                    @php
                                        $name = Auth::user()->name;
                                        $superviseeID = $psm1data->superviseeID;
                                        $gradeexist = DB::table('evaluationmarks')
                                                    ->join('evaluation', 'evaluationmarks.evaluationID', '=', 'evaluation.id')
                                                    ->where('evaluationmarks.superviseeID', $superviseeID)
                                                    ->where('evaluationmarks.evaluatorName', $name)
                                                    ->exists();
                                    @endphp

                                    @if ($gradeexist)
                                        <a class="btn btn-primary" href="{{ route('updateEvaluationGraded', $psm1data->evaluationID) }}" style="border-radius: 10px; border: none; width: 100%; color: white; font-size: 15px; background-color: #145956;">
                                            <b>UPDATE</b>
                                        </a>
                                    @else
                                        <a class="btn btn-primary" href="{{ route('evaluationGraded', $psm1data->evaluationID) }}" style="border-radius: 10px; border: none; width: 100%; color: white; font-size: 15px; background-color: #145956;">
                                            <b>GRADED</b>
                                        </a>
                                    @endif
                                </center>
                            </td>
                        </tr>
                    @endforeach
                    @else
                        <tr>
                            <th colspan="7">
                                <center>
                                    <h5 style="color: red"><i class="material-icons" style="color: red">priority_high</i> No Supervisee Evaluation <i class="material-icons" style="color: red">priority_high</i></h5>
                                </center>
                            </th>
                        </tr>
                    @endif
                    </tbody>

                    <thead style="background-color: #86B5B3; color: black;">
                        <tr>
                            <th colspan="7"><center>PSM 2</center></th>
                        </tr>
                        <tr>
                            <th><center>STUDENT NAME</center></th>
                            <th><center>STUDENT ID</center></th>
                            <th><center>SUPERVISOR NAME</center></th>
                            <th><center>DATE</center></th>
                            <th><center>TIME</center></th>
                            <th><center>LOCATION</center></th>
                            <th><center>ACTION</center></th>
                        </tr>
                    </thead>
                    <tbody>
                    @if($psm2exist)
                    @foreach($psm2 as $psm2data)
                        <tr>
                            <td><center><label>{{$psm2data->superviseeName}}</label></center></td>
                            <td><center><label>{{$psm2data->superviseeMatric}}</label></center></td>
                            <td><center><label>{{$psm2data->supervisorName}}</label></center></td>
                            <td><center><label>{{$psm2data->dateEvaluate}}</label></center></td>
                            <td><center><label>{{$psm2data->timeEvaluate}}</label></center></td>
                            <td><center><label>{{$psm2data->location}}</label></center></td>
                            <td>
                                <center>
                                    @php
                                        $name = Auth::user()->name;
                                        $gradeexist = DB::table('evaluationmarks')
                                                    ->where('superviseeID', $psm2data->superviseeID)
                                                    ->where('evaluatorName', $name)
                                                    ->exists();
                                    @endphp

                                    @if ($gradeexist)
                                        <a class="btn btn-primary" href="{{ route('updateEvaluationGraded', $psm2data->evaluationID) }}" style="border-radius: 10px; border: none; width: 100%; color: white; font-size: 15px; background-color: #145956;">
                                            <b>UPDATE</b>
                                        </a>
                                    @else
                                        <a class="btn btn-primary" href="{{ route('evaluationGraded', $psm2data->evaluationID) }}" style="border-radius: 10px; border: none; width: 100%; color: white; font-size: 15px; background-color: #145956;">
                                            <b>GRADED</b>
                                        </a>
                                    @endif
                                </center>
                            </td>
                        </tr>
                    @endforeach
                    @else
                        <tr>
                            <th colspan="7">
                                <center>
                                    <h5 style="color: red"><i class="material-icons" style="color: red">priority_high</i> No Supervisee Evaluation <i class="material-icons" style="color: red">priority_high</i></h5>
                                </center>
                            </th>
                        </tr>
                    @endif
                    </tbody>
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