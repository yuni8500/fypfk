@extends('layouts.sideNav')

@section('content')

<!-- to display the alert message if the record has been deleted -->

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>LOGBOOK</b></h3>
<div class="card">
    
    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                <a class="btn btn-primary" href="{{ route('logbookAdd') }}" style="border-radius: 10px; border: none; width: 18%; color: white; font-size: 15px; background-color: #145956; margin-left: 859px; margin-bottom:15px">
                <i class="material-icons" style="color: white">add_circle</i> <b>INSERT LOGBOOK</b>
                </a>
                <br>
                <!-- FOR STAFF TO VIEW RECORD APPOINTMENT LIST START -->
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead style="background-color: #86B5B3; color: black;">
                        <tr>
                            <th rowspan="2"><center>DATE</center></th>
                            <th colspan="2"><center>TIME</center></th>
                            <th rowspan="2"><center>PROGRESS</center></th>
                            <th rowspan="2"><center>SUPERVISOR COMMENT</center></th>
                            <th rowspan="2"><center>APPROVAL</center></th>
                            <th rowspan="2"><center>ACTION</center></th>
                        </tr>
                        <tr>
                            <th><center>START</center></th>
                            <th><center>END</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($logbookview as $data)
                        <tr>
                            <td><label>{{$data->appointDate}}</label></td>
                            <td><label>{{$data->startTime}}</label></td>
                            <td><label>{{$data->endTime}}</label></td>
                            <td><label>{{$data->progress}}</label></td>
                            <td><label>{{$data->comment}}</label></td>
                            <td><label>{{$data->approval}}</label></td>
                            <td>
                            @if($logbookUpdate)
                                <center>
                                    <a class="btn btn-primary" href="{{ route('logbookEdit', $data->logbookID) }}" style="border-radius: 10px; border: none; width: 100%; color: white; font-size: 15px; background-color: #145956;">
                                        <b>UPDATE</b>
                                    </a>
                                </center>
                            @elseif(! $logbookUpdate)
                            <label>Complete</label>
                            @endif
                            </td>
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