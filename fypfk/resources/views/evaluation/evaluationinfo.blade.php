@extends('layouts.sideNav')

@section('content')

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>EVALUATION INFORMATION</b></h3>
<div class="card">
    
    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tr>
                        <th style="background-color: #86B5B3; color: black;"><center>Date</center></th>
                        <td>{{$evaluation->dateEvaluate}}</td>
                        <th style="background-color: #86B5B3; color: black;"><center>Time</center></th>
                        <td>{{$evaluation->timeEvaluate}}</td>
                    </tr>
                    <tr>
                        <th style="background-color: #86B5B3; color: black;"><center>Location</center></th>
                        <td colspan="3">{{$evaluation->location}}</td>
                    </tr>
                    <tr>
                        <th style="background-color: #86B5B3; color: black;"><center>Evaluators 1</center></th>
                        <td>
                            {{$evaluation->evaluator1}}
                        </td>
                        <th style="background-color: #86B5B3; color: black;"><center>Evaluators 2</center></th>
                        <td>
                            {{$evaluation->evaluator2}}
                        </td>
                    </tr>
                    <tr>
                        <th style="background-color: #86B5B3; color: black;"><center>Marks Evaluators 1</center></th>
                        <td>
                            {{$evaluation->marks1}}
                        </td>
                        <th style="background-color: #86B5B3; color: black;"><center>Marks Evaluators 2</center></th>
                        <td>
                            {{$evaluation->marks2}}
                        </td>
                    </tr>
                    <tr>
                        <th style="background-color: #86B5B3; color: black;"><center>Total Marks</center></th>
                        <td colspan="3">
                            
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