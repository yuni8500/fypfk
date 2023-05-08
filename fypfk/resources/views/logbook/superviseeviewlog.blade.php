@extends('layouts.sideNav')

@section('content')

<!-- to display the alert message if the record has been deleted -->

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>LOGBOOK</b></h3>

<a href="{{ route('logbookSupervisee') }}" style="color: black">
    <i class="material-icons" style="color: black; font-size: 20px">keyboard_arrow_left</i> <b>BACK</b>
</a>
<br><br>

<div class="card">
    
    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                <center><h5 style="color: black">{{$studentName->name}}</h5></center>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead style="background-color: #86B5B3; color: black;">
                        <tr>
                            <th rowspan="2"><center>DATE</center></th>
                            <th colspan="2"><center>TIME</center></th>
                            <th rowspan="2"><center>PROGRESS</center></th>
                            <th rowspan="2"><center>SUPERVISOR COMMENT</center></th>
                            <th rowspan="2"><center>APPROVAL</center></th>
                            <th rowspan="2"><center>UPDATE</center></th>
                        </tr>
                        <tr>
                            <th><center>START</center></th>
                            <th><center>END</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($superviseeLogbook as $data)
                        <tr>
                            <td><label>{{$data->dateLog}}</label></td>
                            <td><label>{{$data->timeStart}}</label></td>
                            <td><label>{{$data->timeEnd}}</label></td>
                            <td><label>{{$data->progress}}</label></td>
                            <td><label>{{$data->comment}}</label></td>
                            <td><label>{{$data->approval}}</label></td>
                            @if($logbookUpdate)
                            <td>
                                <center>
                                    <a class="btn btn-primary" href="{{ route('logbookEditSupervisee', $data->logbookID) }}" style="border-radius: 10px; border: none; width: 90%; color: white; font-size: 15px; background-color: #145956;">
                                        <b>UPDATE</b>
                                    </a>
                                </center>
                            </td>
                            @elseif(! $logbookUpdate)
                            <td><label>Complete</label></td>
                            @endif
                        </tr>
                        @endforeach
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