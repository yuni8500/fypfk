@extends('layouts.sideNav')

@section('content')

<!-- to display the alert message if the record has been deleted -->

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>SUPERVISOR APPLICATION</b></h3>
<div class="card">
    
    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                <a class="btn btn-primary" href="{{ route('superviseeList') }}" style="border-radius: 10px; border: none; width: 18%; color: white; font-size: 15px; background-color: #145956; margin-left: 859px; margin-bottom:15px">
                <i class="material-icons" style="color: white">view_list</i> <b>LIST OF SUPERVISEE</b>
                </a>
                <br>

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead style="background-color: #86B5B3; color: black;">
                        <tr>
                            <th><center>STUDENT NAME</center></th>
                            <th><center>STUDENT ID</center></th>
                            <th><center>COURSE</center></th>
                            <th><center>ACTION</center></th>
                        </tr>
                    </thead>
                    <tbody>
                    @if($applicationexist)
                        @foreach($applicationList as $data)
                        <tr>
                            <td><center><label>{{$data->name}}</label></center></td>
                            <td><center><label>{{$data->matric}}</label></center></td>
                            <td><center><label>{{$data->course_group}}</label></center></td>
                            <td>
                                <center>
                                    <a class="btn btn-primary" href="{{ route('viewApplication', $data->applyID) }}" style="border-radius: 10px; border: none; width: 50%; color: white; font-size: 15px; background-color: #145956;">
                                        <b>VIEW</b>
                                    </a>
                                </center>
                            </td>
                        </tr>
                        @endforeach
                    @elseif(! $applicationexist)
                        <tr>
                            <th colspan="4">
                                <center>
                                    <h5 style="color: #145956"><i class="material-icons" style="color: #145956">offline_pin</i> Supervisor Application Completed</h5>
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