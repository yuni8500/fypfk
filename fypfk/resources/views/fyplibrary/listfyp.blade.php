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
                searchPlaceholder: 'Search project title'
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
<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>FYP LIBRARY</b></h3>
<div class="card">

    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead style="background-color: #86B5B3; color: black;">
                        <tr>
                            <th><center>STUDENT NAME</center></th>
                            <th><center>SUPERVISOR NAME</center></th>
                            <th><center>EXPERT GROUP</center></th>
                            <th><center>SEMESTER</center></th>
                            <th><center>PROJECT TITLE</center></th>
                            <th><center>ABSTRACT</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($libdata as $libdata)
                        <tr>
                            <td>{{$libdata->superviseeName}}</td>
                            <td>{{$libdata->supervisorName}}</td>
                            <td>{{$libdata->course_group}}</td>
                            <td>{{$libdata->semester}}</td>
                            <td>{{$libdata->projectTitle}}</td>
                            <td>{{$libdata->abstract}}</td>
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