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
                searchPlaceholder: 'Search session'
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
<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>LIST OF SUPERVISEE</b></h3>

<a href="{{ route('applicationList') }}" style="color: black">
    <i class="material-icons" style="color: black; font-size: 20px">keyboard_arrow_left</i> <b>BACK</b>
</a>
<br><br>
<div class="card">

    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                <!-- FOR STAFF TO VIEW RECORD APPOINTMENT LIST START -->
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead style="background-color: #86B5B3; color: black;">
                        <tr>
                            <th><center>SUPERVISEE NAME</center></th>
                            <th><center>STUDENT ID</center></th>
                            <th><center>NUMBER PHONE</center></th>
                            <th><center>EMAIL</center></th>
                            <th><center>COURSE</center></th>
                            <th><center>PROJECT TITLE</center></th>
                            <th><center>SEMESTER</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($superviseeList as $key=>$superviseedata)
                        <tr>
                            <td><center>{{$superviseedata->name}}</center></td>
                            <td><center>{{$superviseedata->matric}}</center></td>
                            <td><center>{{$superviseedata->numPhone}}</center></td>
                            <td><center>{{$superviseedata->email}}</center></td>
                            <td><center>{{$superviseedata->course_group}}</center></td>
                            <td><center>{{$superviseedata->proposedTitle}}</center></td>
                            <td><center>{{$superviseedata->semester}}</center></td>
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