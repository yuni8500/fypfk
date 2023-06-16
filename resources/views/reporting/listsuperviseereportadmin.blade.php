@extends('layouts.sideNav')

@section('content')

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>PROJECT REPORT</b></h3>

<a href="{{ route('reportingFYP') }}" style="color: black">
    <i class="material-icons" style="color: black; font-size: 20px">keyboard_arrow_left</i> <b>BACK</b>
</a>
<br><br>
<table>
    <form action="{{ route('superviseeList') }}" method="POST">
    @csrf
    <tr>
        <td>
            <select name="staffName" id="staffName" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control">
                <option value="">Please select staff name</option>
                @foreach($staff as $data)
                    <option value="{{ $data->id }}">{{ $data->name }}</option>
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
<br>

<div class="card">
    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
            @if(isset($staff) && !$staff->isEmpty())
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead style="background-color: #86B5B3; color: black;">
                        <tr>
                            <th colspan="4"><center>PTA 1</center></th>
                        </tr>
                        <tr>
                            <th><center>STUDENT NAME</center></th>
                            <th><center>STUDENT ID</center></th>
                            <th><center>SEMESTER</center></th>
                            <th><center>ACTION</center></th>
                        </tr>
                    </thead>
                    @if($pta1exist)
                    <tbody>
                    @foreach($pta1 as $pta1data)
                        <tr>
                            <td><center><label></label>{{$pta1data->name}}</center></td>
                            <td><center><label></label>{{$pta1data->matric}}</center></td>
                            <td><center><label></label>{{$pta1data->semester}}</center></td>
                            <td>
                                <center>
                                    <a class="btn btn-primary" href="{{ route('reportSuperviseeView', $pta1data->userID) }}" style="border-radius: 10px; border: none; width: 60%; color: white; font-size: 15px; background-color: #145956;">
                                        <b>VIEW</b>
                                    </a>
                                </center>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    @elseif(! $pta1exist)
                    <tbody style="color: black;">
                        <tr>
                            <th colspan="4">
                                <center>
                                    <h5 style="color: red"><i class="material-icons" style="color: red">priority_high</i> No Supervisee <i class="material-icons" style="color: red">priority_high</i></h5>
                                </center>
                            </th>
                        </tr>
                    </tbody>
                    @endif
                    
                    <thead style="background-color: #86B5B3; color: black;">
                        <tr>
                            <th colspan="4"><center>PTA 2</center></th>
                        </tr>
                        <tr>
                            <th><center>STUDENT NAME</center></th>
                            <th><center>STUDENT ID</center></th>
                            <th><center>SEMESTER</center></th>
                            <th><center>ACTION</center></th>
                        </tr>
                    </thead>
                    @if($pta2exist)
                    <tbody>
                    @foreach($pta2 as $pta2data)
                        <tr>
                            <td><center><label>{{$pta2data->name}}</label></center></td>
                            <td><center><label>{{$pta2data->matric}}</label></center></td>
                            <td><center><label>{{$pta2data->semester}}</label></center></td>
                            <td>
                                <center>
                                    <a class="btn btn-primary" href="{{ route('reportSuperviseeView', $pta2data->userID) }}" style="border-radius: 10px; border: none; width: 60%; color: white; font-size: 15px; background-color: #145956;">
                                        <b>VIEW</b>
                                    </a>
                                </center>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    @elseif(! $pta2exist)
                    <tbody style="color: black;">
                        <tr>
                            <th colspan="4">
                                <center>
                                    <h5 style="color: red"><i class="material-icons" style="color: red">priority_high</i> No Supervisee <i class="material-icons" style="color: red">priority_high</i></h5>
                                </center>
                            </th>
                        </tr>
                    </tbody>
                    @endif

                    <thead style="background-color: #86B5B3; color: black;">
                        <tr>
                            <th colspan="4"><center>PSM 1</center></th>
                        </tr>
                        <tr>
                            <th><center>STUDENT NAME</center></th>
                            <th><center>STUDENT ID</center></th>
                            <th><center>SEMESTER</center></th>
                            <th><center>ACTION</center></th>
                        </tr>
                    </thead>
                    @if($psm1exist)
                    <tbody>
                    @foreach($psm1 as $psm1data)
                        <tr>
                            <td><center><label>{{$psm1data->name}}</label></center></td>
                            <td><center><label>{{$psm1data->matric}}</label></center></td>
                            <td><center><label>{{$psm1data->semester}}</label></center></td>
                            <td>
                                <center>
                                    <a class="btn btn-primary" href="{{ route('reportSuperviseeView', $psm1data->userID) }}" style="border-radius: 10px; border: none; width: 60%; color: white; font-size: 15px; background-color: #145956;">
                                        <b>VIEW</b>
                                    </a>
                                </center>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    @elseif(! $psm1exist)
                    <tbody style="color: black;">
                        <tr>
                            <th colspan="4">
                                <center>
                                    <h5 style="color: red"><i class="material-icons" style="color: red">priority_high</i> No Supervisee <i class="material-icons" style="color: red">priority_high</i></h5>
                                </center>
                            </th>
                        </tr>
                    </tbody>
                    @endif

                    <thead style="background-color: #86B5B3; color: black;">
                        <tr>
                            <th colspan="4"><center>PSM 2</center></th>
                        </tr>
                        <tr>
                            <th><center>STUDENT NAME</center></th>
                            <th><center>STUDENT ID</center></th>
                            <th><center>SEMESTER</center></th>
                            <th><center>ACTION</center></th>
                        </tr>
                    </thead>
                    @if($psm2exist)
                    <tbody>
                    @foreach($psm2 as $psm2data)
                        <tr>
                            <td><center><label>{{$psm2data->name}}</label></center></td>
                            <td><center><label>{{$psm2data->matric}}</label></center></td>
                            <td><center><label>{{$psm2data->semester}}</label></center></td>
                            <td>
                                <center>
                                    <a class="btn btn-primary" href="{{ route('reportSuperviseeView', $psm2data->userID) }}" style="border-radius: 10px; border: none; width: 60%; color: white; font-size: 15px; background-color: #145956;">
                                        <b>VIEW</b>
                                    </a>
                                </center>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    @elseif(! $psm2exist)
                    <tbody style="color: black;">
                        <tr>
                            <th colspan="4">
                                <center>
                                    <h5 style="color: red"><i class="material-icons" style="color: red">priority_high</i> No Supervisee <i class="material-icons" style="color: red">priority_high</i></h5>
                                </center>
                            </th>
                        </tr>
                    </tbody>
                    @endif
                </table>
            @endif
            </div>
        </div>
    </div>
</div>
<br>
<script src="{{ asset('frontend') }}/js/jquery.dataTables.js"></script>

@endsection