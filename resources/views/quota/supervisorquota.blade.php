@extends('layouts.sideNav')

@section('content')

<script src="{{ asset('frontend') }}/js/jquery.dataTables.js"></script>
<script src="{{ asset('frontend') }}/js/dataTables.bootstrap4.js"></script>
<script src="//code.jquery.com/jquery-1.12.3.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

<script>
    // to search the appointment 
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "order": [
                [0, "asc"]
            ],
            "language": {
                search: '<i class="fa fa-search"></i>',
                searchPlaceholder: 'Search staff name'
            }
        });

        // filter appointment
        $('.dataTables_filter input[type="search"]').css({
            'width': '300px',
            'display': 'inline-block',
            'font-size': '15px',
            'font-weight': '400'
        });
    });
</script>

<!-- to display the alert message if the record has been deleted -->
@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif
<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>SUPERVISOR QUOTA</b></h3>

@if(auth()->user()->category == "Student")
<div class="card">

    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                <!-- FOR STAFF TO VIEW RECORD APPOINTMENT LIST START -->
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead style="background-color: #86B5B3; color: black;">
                        <tr>
                            <th rowspan="2"><center>STAFF NAME</center></th>
                            <th rowspan="2"><center>EXPERT GROUP</center></th>
                            <th colspan="4"><center>CURRENT SUPERVISION</center></th>
                            <th rowspan="2"><center>SUPERVISION QUOTA</center></th>
                            <th rowspan="2"><center>AVAILABILITY QUOTA</center></th>
                            <th rowspan="2"><center>APPLICATION OF CURRENT SUPERVISION</center></th>
                            <th rowspan="2"><center>ACTION</center></th>
                        </tr>
                        <tr>
                            <th><center>PTA 1</center></th>
                            <th><center>PTA 2</center></th>
                            <th><center>PSM 1</center></th>
                            <th><center>PSM 2</center></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($getquota as $data)
                    @php
                        $supervisorID = $data->supervisorID;
                        $countsPTA1Collection = collect($countsPTA1);
                        $countsPTA2Collection = collect($countsPTA2);
                        $countsPSM1Collection = collect($countsPSM1);
                        $countsPSM2Collection = collect($countsPSM2);
                        $countsPTA1Total = $countsPTA1Collection->get($supervisorID, 0);
                        $countsPTA2Total = $countsPTA2Collection->get($supervisorID, 0);
                        $countsPSM1Total = $countsPSM1Collection->get($supervisorID, 0);
                        $countsPSM2Total = $countsPSM2Collection->get($supervisorID, 0);
                        $totalCount = $countsPTA1Total + $countsPTA2Total + $countsPSM1Total + $countsPSM2Total;
                    @endphp
                        <tr>
                            <td>{{ $data->name }}</td>
                            <td><center>{{ $data->course_group }}</center></td>
                            <td><center>{{ $countsPTA1Total }}</center></td>
                            <td><center>{{ $countsPTA2Total }}</center></td>
                            <td><center>{{ $countsPSM1Total }}</center></td>
                            <td><center>{{ $countsPSM2Total }}</center></td>
                            <td><center>{{ $data->quota }}</center></td>
                            <td><center>{{ $data->quota - $totalCount }}</center></td>
                            <td><center>{{ $countapplied->get($data->supervisorID, 0) }}</center></td>
                            <td>
                                <a class="btn btn-primary" href="{{ route('superviseeEmail', $data->userID) }}" style="border-radius: 10px; border: none; width: 100%; color: white; font-size: 15px; background-color: #145956;">
                                        <b>EMAIL</b>
                                    </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <!-- FOR STAFF TO VIEW RECORD APPOINTNMENT LIST END -->
            </div>
        </div>
    </div>
</div>
@endif

@if(auth()->user()->category == "Staff")
<div class="card">

    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                <!-- FOR STAFF TO VIEW RECORD APPOINTMENT LIST START -->
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead style="background-color: #86B5B3; color: black;">
                        <tr>
                            <th rowspan="2"><center>STAFF NAME</center></th>
                            <th rowspan="2"><center>EXPERT GROUP</center></th>
                            <th colspan="4"><center>CURRENT SUPERVISION</center></th>
                            <th rowspan="2"><center>SUPERVISION QUOTA</center></th>
                            <th rowspan="2"><center>AVAILABILITY QUOTA</center></th>
                            <th rowspan="2"><center>APPLICATION OF CURRENT SUPERVISION</center></th>
                        </tr>
                        <tr>
                            <th><center>PTA 1</center></th>
                            <th><center>PTA 2</center></th>
                            <th><center>PSM 1</center></th>
                            <th><center>PSM 2</center></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($getquota as $data)
                    @php
                        $supervisorID = $data->supervisorID;
                        $countsPTA1Collection = collect($countsPTA1);
                        $countsPTA2Collection = collect($countsPTA2);
                        $countsPSM1Collection = collect($countsPSM1);
                        $countsPSM2Collection = collect($countsPSM2);
                        $countsPTA1Total = $countsPTA1Collection->get($supervisorID, 0);
                        $countsPTA2Total = $countsPTA2Collection->get($supervisorID, 0);
                        $countsPSM1Total = $countsPSM1Collection->get($supervisorID, 0);
                        $countsPSM2Total = $countsPSM2Collection->get($supervisorID, 0);
                        $totalCount = $countsPTA1Total + $countsPTA2Total + $countsPSM1Total + $countsPSM2Total;
                    @endphp
                        <tr>
                            <td>{{ $data->name }}</td>
                            <td><center>{{ $data->course_group }}</center></td>
                            <td><center>{{ $countsPTA1Total }}</center></td>
                            <td><center>{{ $countsPTA2Total }}</center></td>
                            <td><center>{{ $countsPSM1Total }}</center></td>
                            <td><center>{{ $countsPSM2Total }}</center></td>
                            <td><center>{{ $data->quota }}</center></td>
                            <td><center>{{ $data->quota - $totalCount }}</center></td>
                            <td><center>{{ $countapplied->get($data->supervisorID, 0) }}</center></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <!-- FOR STAFF TO VIEW RECORD APPOINTNMENT LIST END -->
            </div>
        </div>
    </div>
</div>
@endif

@if( auth()->user()->category== "Admin")
<div class="card">

    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                <a class="btn btn-primary" href="{{ route('createSupervisorQuota') }}" style="border-radius: 10px; border: none; width: 13%; color: white; font-size: 15px; background-color: #145956; margin-left: 900px; margin-bottom:15px">
                <i class="material-icons" style="color: white;">group_add</i> <b>ADD STAFF</b>
                </a>
                <br>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead style="background-color: #86B5B3; color: black;">
                        <tr>
                            <th rowspan="2"><center>STAFF NAME</center></th>
                            <th rowspan="2"><center>EXPERT GROUP</center></th>
                            <th colspan="4"><center>CURRENT SUPERVISION</center></th>
                            <th rowspan="2"><center>SUPERVISION QUOTA</center></th>
                            <th rowspan="2"><center>AVAILABILITY QUOTA</center></th>
                            <th rowspan="2"><center>APPLICATION OF CURRENT SUPERVISION</center></th>
                            <th rowspan="2"><center>ACTION</center></th>
                        </tr>
                        <tr>
                            <th><center>PTA 1</center></th>
                            <th><center>PTA 2</center></th>
                            <th><center>PSM 1</center></th>
                            <th><center>PSM 2</center></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($getquota as $data)
                    @php
                        $supervisorID = $data->supervisorID;
                        $countsPTA1Collection = collect($countsPTA1);
                        $countsPTA2Collection = collect($countsPTA2);
                        $countsPSM1Collection = collect($countsPSM1);
                        $countsPSM2Collection = collect($countsPSM2);
                        $countsPTA1Total = $countsPTA1Collection->get($supervisorID, 0);
                        $countsPTA2Total = $countsPTA2Collection->get($supervisorID, 0);
                        $countsPSM1Total = $countsPSM1Collection->get($supervisorID, 0);
                        $countsPSM2Total = $countsPSM2Collection->get($supervisorID, 0);
                        $totalCount = $countsPTA1Total + $countsPTA2Total + $countsPSM1Total + $countsPSM2Total;
                    @endphp
                        <tr>
                            <td>{{ $data->name }}</td>
                            <td><center>{{ $data->course_group }}</center></td>
                            <td><center>{{ $countsPTA1Total }}</center></td>
                            <td><center>{{ $countsPTA2Total }}</center></td>
                            <td><center>{{ $countsPSM1Total }}</center></td>
                            <td><center>{{ $countsPSM2Total }}</center></td>
                            <td><center>{{ $data->quota }}</center></td>
                            <td><center>{{ $data->quota - $totalCount }}</center></td>
                            <td><center>{{ $countapplied->get($data->supervisorID, 0) }}</center></td>
                            <td>
                                <a class="btn btn-primary" href="{{ route('viewSupervisorQuota', $data->quotaID)}}" style="border-radius: 10px; border: none; width: 100%; color: white; font-size: 15px; background-color: #145956;">
                                    <b>UPDATE</b>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <!-- FOR STAFF TO VIEW RECORD APPOINTNMENT LIST END -->
            </div>
        </div>
    </div>
</div>
@endif
<br>
<script src="{{ asset('frontend') }}/js/jquery.dataTables.js"></script>
<Script>

</script>
@endsection