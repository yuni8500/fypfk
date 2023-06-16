@extends('layouts.sideNav')

@section('content')

<!-- to display the alert message if the record has been deleted -->

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>SUPERVISOR APPLICATION</b></h3>
<div class="card">
    
    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <a class="btn btn-primary" href="{{ route('supervisorApplicationRecord') }}" style="border-radius: 10px; border: none; width: 30%; color: white; font-size: 15px; background-color: #145956; margin-left: 723px; margin-bottom:15px">
                <i class="material-icons" style="color: white;">book</i> <b>SUPERVISOR APPLICATION RECORD</b>
            </a>
            <br>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead style="background-color: #86B5B3; color: black;">
                        <tr>
                            <th colspan="4"><center>PTA 1</center></th>
                        </tr>
                        <tr>
                            <th><center>STUDENT NAME</center></th>
                            <th><center>STUDENT ID</center></th>
                            <th><center>STATUS</center></th>
                            <th><center>ACTION</center></th>
                        </tr>
                    </thead>
                    @if($pta1exist)
                    <tbody>
                    @foreach($pta1 as $pta1data)
                        <tr>
                            <td><center><label>{{$pta1data->name}}</label></center></td>
                            <td><center><label>{{$pta1data->matric}}</label></center></td>
                            <td><center><label>{{$pta1data->statusApplied}}</label></center></td>
                            <td>
                                <center>
                                    <a class="btn btn-primary" href="{{ route('viewApplication', $pta1data->applyID) }}" style="border-radius: 10px; border: none; width: 50%; color: white; font-size: 15px; background-color: #145956;">
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
                                    <h5 style="color: #145956"><i class="material-icons" style="color: #145956">offline_pin</i> Supervisor Application Completed <i class="material-icons" style="color: #145956">offline_pin</i></h5>
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
                            <th><center>STATUS</center></th>
                            <th><center>ACTION</center></th>
                        </tr>
                    </thead>
                    @if($pta2exist)
                    <tbody>
                    @foreach($pta2 as $pta2data)
                        <tr>
                            <td><center><label>{{$pta2data->name}}</label></center></td>
                            <td><center><label>{{$pta2data->matric}}</label></center></td>
                            <td><center><label>{{$pta2data->statusApplied}}</label></center></td>
                            <td>
                                <center>
                                    <a class="btn btn-primary" href="{{ route('viewApplication', $pta2data->applyID) }}" style="border-radius: 10px; border: none; width: 50%; color: white; font-size: 15px; background-color: #145956;">
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
                                    <h5 style="color: #145956"><i class="material-icons" style="color: #145956">offline_pin</i> Supervisor Application Completed <i class="material-icons" style="color: #145956">offline_pin</i></h5>
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
                            <th><center>STATUS</center></th>
                            <th><center>ACTION</center></th>
                        </tr>
                    </thead>
                    @if($psm1exist)
                    <tbody>
                    @foreach($psm1 as $psm1data)
                        <tr>
                            <td><center><label>{{$psm1data->name}}</label></center></td>
                            <td><center><label>{{$psm1data->matric}}</label></center></td>
                            <td><center><label>{{$psm1data->statusApplied}}</label></center></td>
                            <td>
                                <center>
                                    <a class="btn btn-primary" href="{{ route('viewApplication', $psm1data->applyID) }}" style="border-radius: 10px; border: none; width: 50%; color: white; font-size: 15px; background-color: #145956;">
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
                                    <h5 style="color: #145956"><i class="material-icons" style="color: #145956">offline_pin</i> Supervisor Application Completed <i class="material-icons" style="color: #145956">offline_pin</i></h5>
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
                            <th><center>STATUS</center></th>
                            <th><center>ACTION</center></th>
                        </tr>
                    </thead>
                    @if($psm2exist)
                    <tbody>
                    @foreach($psm2 as $psm2data)
                        <tr>
                            <td><center><label>{{$psm2data->name}}</label></center></td>
                            <td><center><label>{{$psm2data->matric}}</label></center></td>
                            <td><center><label>{{$psm2data->statusApplied}}</label></center></td>
                            <td>
                                <center>
                                    <a class="btn btn-primary" href="{{ route('viewApplication', $psm2data->applyID) }}" style="border-radius: 10px; border: none; width: 50%; color: white; font-size: 15px; background-color: #145956;">
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
                                    <h5 style="color: #145956"><i class="material-icons" style="color: #145956">offline_pin</i> Supervisor Application Completed <i class="material-icons" style="color: #145956">offline_pin</i></h5>
                                </center>
                            </th>
                        </tr>
                    </tbody>
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