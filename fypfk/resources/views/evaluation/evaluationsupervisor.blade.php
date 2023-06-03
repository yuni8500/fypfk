@extends('layouts.sideNav')

@section('content')

<!-- to display the alert message if the record has been deleted -->

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>EVALUATION INFORMATION</b></h3>
<div class="card">
    
    <div class="card-body">
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
                        @if($pta1exist)
                        @foreach($pta1 as $data1)
                        <tr>
                            <td><center><label>{{$data1->superviseeName}}</label></center></td>
                            <td><center><label>{{$data1->superviseeMatric}}</label></center></td>
                            <td><center><label>{{$data1->supervisorName}}</label></center></td>
                            <td><center><label>{{$data1->dateEvaluate}}</label></center></td>
                            <td><center><label>{{$data1->timeEvaluate}}</label></center></td>
                            <td><center><label>{{$data1->location}}</label></center></td>
                            <td>
                                <center>
                                    <a class="btn btn-primary" href="{{ route('evaluationGraded', $data1->evaluationID) }}" style="border-radius: 10px; border: none; width: 90%; color: white; font-size: 15px; background-color: #145956;">
                                        <b>GRADED</b>
                                    </a>
                                </center>
                            </td>
                        </tr>
                        @endforeach
                        @elseif(! $pta1exist)
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
                        @foreach($pta2 as $data2)
                        <tr>
                            <td><center><label>{{$data2->superviseeName}}</label></center></td>
                            <td><center><label>{{$data2->superviseeMatric}}</label></center></td>
                            <td><center><label>{{$data2->supervisorName}}</label></center></td>
                            <td><center><label>{{$data2->dateEvaluate}}</label></center></td>
                            <td><center><label>{{$data2->timeEvaluate}}</label></center></td>
                            <td><center><label>{{$data2->location}}</label></center></td>
                            <td>
                                <center>
                                    <a class="btn btn-primary" href="{{ route('evaluationGraded', $data2->evaluationID) }}" style="border-radius: 10px; border: none; width: 90%; color: white; font-size: 15px; background-color: #145956;">
                                        <b>GRADED</b>
                                    </a>
                                </center>
                            </td>
                        </tr>
                        @endforeach
                    @elseif(!$pta2exist)
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
                        @foreach($psm1 as $data3)
                        <tr>
                            <td><center><label>{{$data3->superviseeName}}</label></center></td>
                            <td><center><label>{{$data3->superviseeMatric}}</label></center></td>
                            <td><center><label>{{$data3->supervisorName}}</label></center></td>
                            <td><center><label>{{$data3->dateEvaluate}}</label></center></td>
                            <td><center><label>{{$data3->timeEvaluate}}</label></center></td>
                            <td><center><label>{{$data3->location}}</label></center></td>
                            <td>
                                <center>
                                    <a class="btn btn-primary" href="{{ route('evaluationGraded', $data3->evaluationID) }}" style="border-radius: 10px; border: none; width: 90%; color: white; font-size: 15px; background-color: #145956;">
                                        <b>GRADED</b>
                                    </a>
                                </center>
                            </td>
                        </tr>
                        @endforeach
                    @elseif(!$psm1exist)
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
                        @foreach($psm2 as $data4)
                        <tr>
                            <td><center><label>{{$data4->superviseeName}}</label></center></td>
                            <td><center><label>{{$data4->superviseeMatric}}</label></center></td>
                            <td><center><label>{{$data4->supervisorName}}</label></center></td>
                            <td><center><label>{{$data4->dateEvaluate}}</label></center></td>
                            <td><center><label>{{$data4->timeEvaluate}}</label></center></td>
                            <td><center><label>{{$data4->location}}</label></center></td>
                            <td>
                                <center>
                                    @if ($gradeexist)
                                    <a class="btn btn-primary" href="{{ route('updateEvaluationGraded', $data4->evaluationID) }}" style="border-radius: 10px; border: none; width: 90%; color: white; font-size: 15px; background-color: #145956;">
                                        <b>UPDATE</b>
                                    </a>
                                    @else
                                    <a class="btn btn-primary" href="{{ route('evaluationGraded', $data4->evaluationID) }}" style="border-radius: 10px; border: none; width: 90%; color: white; font-size: 15px; background-color: #145956;">
                                        <b>GRADED</b>
                                    </a>
                                    @endif
                                </center>
                            </td>
                        </tr>
                        @endforeach
                    @elseif(!$psm2exist)
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