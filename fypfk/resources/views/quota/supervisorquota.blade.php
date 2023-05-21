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
                search: '<i class="fa fa-search" aria-hidden="true"></i>',
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

@if(auth()->user()->category == "Staff" || auth()->user()->category == "Student")
<div class="card">

    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                <!-- FOR STAFF TO VIEW RECORD APPOINTMENT LIST START -->
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead style="background-color: #86B5B3; color: black;">
                        <tr>
                            <th rowspan="2"><center>STAFF NAME</center></th>
                            <th rowspan="2"><center>EMAIL</center></th>
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
                        <tr>
                            <td>En. Abbas Saliimi Bin Lokman</td>
                            <td>abbas@ump.edu.my</td>
                            <td><center>ViSiC</center></td>
                            <td><center>0</center></td>
                            <td><center>2</center></td>
                            <td><center>0</center></td>
                            <td><center>6</center></td>
                            <td><center>9</center></td>
                            <td><center>1</center></td>
                            <td><center>1</center></td>
                        </tr>
                        <tr>
                            <td>Pm. Ts. Dr. Awanis Binti Romli</td>
                            <td>awanis@ump.edu.my</td>
                            <td><center>EDUTECH</center></td>
                            <td><center>0</center></td>
                            <td><center>0</center></td>
                            <td><center>0</center></td>
                            <td><center>1</center></td>
                            <td><center>3</center></td>
                            <td><center>2</center></td>
                            <td><center>3</center></td>
                        </tr>
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
                            <th rowspan="2"><center>EMAIL</center></th>
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
                        <tr>
                            <td>{{$data->name}}</td>
                            <td>{{$data->email}}</td>
                            <td><center>{{$data->course_group}}</center></td>
                            <td><center>0</center></td>
                            <td><center>2</center></td>
                            <td><center>0</center></td>
                            <td>
                                <center>
                                @if (!is_null($countsPSM2))
                                    @foreach ($countsPSM2 as $count)\
                                        <label>{{ $count->count }}</label>
                                    @endforeach
                                    @else
                                        <label>0</label>
                                    @endif
                                </center>
                            </td>
                            <td><center>{{$data->quota}}</center></td>
                            <td><center>1</center></td>
                            <td><center>1</center></td>
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