@extends('layouts.sideNav')

@section('content')

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>EVALUATION REPORT</b></h3>
    <a class="btn btn-primary" href="{{ route('createEvaluation') }}" style="border-radius: 10px; border: none; width: 18%; color: white; font-size: 15px; background-color: #145956; margin-left: 909px; margin-bottom:15px">
        <i class="material-icons" style="color: white">add_circle</i> <b>CREATE EVALUATION</b>
    </a>

<div class="card">
    <div class="card-header pb-0">
        <div class="row">
            <div class="col-lg-16 col-md-12 col-sm-12">
                <nav class="">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('evaluationAdmin') ? '' : '' }}" href="{{ route('evaluationAdmin') }}" role="tab" aria-selected="true">PTA 1</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('evaluationpta2') ? 'active' : '' }}" href="{{ route('evaluationpta2') }}" role="tab" aria-selected="true">PTA 2</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('evaluationpsm1') ? '' : '' }}" href="{{ route('evaluationpsm1') }}" role="tab" aria-selected="true">PSM 1</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('evaluationpsm2') ? '' : '' }}" href="{{ route('evaluationpsm2') }}" role="tab" aria-selected="true">PSM 2</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead style="background-color: #86B5B3; color: black;">
                        <tr>
                            <th><center>STUDENT NAME</center></th>
                            <th><center>STUDENT ID</center></th>
                            <th><center>SEMESTER</center></th>
                            <th><center>DATE</center></th>
                            <th><center>TIME</center></th>
                            <th><center>LOCATION</center></th>
                            <th><center>ACTION</center></th>
                        </tr>
                    </thead>
                    <tbody>
                    @if($pta2exist)
                    @foreach($pta2 as $data)
                        <tr>
                            <td><center><label>{{$data->name}}</label></center></td>
                            <td><center><label>{{$data->matric}}</label></center></td>
                            <td><center><label>{{$data->semester}}</label></center></td>
                            <td><center><label>{{$data->dateEvaluate}}</label></center></td>
                            <td><center><label>{{$data->timeEvaluate}}</label></center></td>
                            <td><center><label>{{$data->location}}</label></center></td>
                            <td>
                                <center>
                                    <a class="btn btn-primary" href="{{ route('viewEvaluation', $data->superviseeID) }}" style="border-radius: 10px; border: none; width: 50%; color: white; font-size: 15px; background-color: #145956; margin-bottom: 5px">
                                        <b>UPDATE</b>
                                    </a>
                                    <a class="btn btn-primary" href="{{ route('superviseeEvaluation', $data->superviseeID) }}" style="border-radius: 10px; border: none; width: 50%; color: white; font-size: 15px; background-color: #86B5B3;">
                                        <b>VIEW</b>
                                    </a>
                                </center>
                            </td>
                        </tr>
                    @endforeach
                    @elseif(! $pta2exist)
                        <tr>
                            <th colspan="7">
                                <center>
                                    <h5 style="color: red"><i class="material-icons" style="color: red">warning</i> No Data <i class="material-icons" style="color: red">warning</i></h5>
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

@endsection