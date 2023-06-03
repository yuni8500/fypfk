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
                searchPlaceholder: 'Search course'
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

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>SUPERVISOR APPLICATION REPORT</b></h3>
<a href="{{ route('supervisorApplicationRecord') }}" style="color: black">
    <i class="material-icons" style="color: black; font-size: 20px">keyboard_arrow_left</i> <b>BACK</b>
</a>
<br><br>
<div class="card">
    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead style="background-color: #86B5B3; color: black;">
                        <tr>
                        @foreach($applydata as $data)
                            <th colspan="7"><center>{{$data->supervisorName}}</center></th>
                        @endforeach
                        </tr>
                        <tr>
                            <th><center>STUDENT NAME</center></th>
                            <th><center>COURSE</center></th>
                            <th><center>SEMESTER</center></th>
                            <th><center>PROJECT TITLE</center></th>
                            <th><center>BACKGROUND PROBLEM</center></th>
                            <th><center>OBJECTIVE</center></th>
                            <th><center>SCOPE</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($applydata as $data)
                        <tr>
                            <td>{{$data->superviseeName}}</td>
                            <td>{{$data->superviseeCourse}}</td>
                            <td>{{$data->semester}}</td>
                            <td>{{$data->proposedTitle}}</td>
                            <td>{{$data->problemStatement}}</td>
                            <td>{{$data->objective}}</td>
                            <td>{{$data->scope}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- FOR STAFF TO VIEW RECORD APPOINTNMENT LIST END -->
            </div>
        </div>
    </div>
</div>
<br>
<script src="{{ asset('frontend') }}/js/jquery.dataTables.js"></script>
<Script>

</script>
@endsection