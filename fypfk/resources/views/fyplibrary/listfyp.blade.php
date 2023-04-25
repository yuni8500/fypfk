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
                searchPlaceholder: 'Search semester'
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
        <center>Semester 2 2022/2023</center>
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead style="background-color: #86B5B3; color: black;">
                        <tr>
                            <th><center>STUDENT NAME</center></th>
                            <th><center>SUPERVISOR NAME</center></th>
                            <th><center>EXPERT GROUP</center></th>
                            <th><center>PROJECT TITLE</center></th>
                            <th><center>BACKGROUND PROBLEM</center></th>
                            <th><center>OBJECTIVE</center></th>
                            <th><center>SCOPE</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Nurayuni Binti Nordin Sin</td>
                            <td>PM. TS. DR. AWANIS BINTI ROMLI</td>
                            <td>EDUTECH</td>
                            <td>Project Management System for Faculty of Computing</td>
                            <td>
                            The project status and submission that relied on the email is quite difficult for the manager or supervisor to monitor and view the overall project progress.
                            Moreover, providing the task, form and reviewing the supervisor quota or information utilizing the different platforms is so inconvenient and consumes a lot of time. 
                            Besides, the project management also not in a systematic way.
                            </td>
                            <td>
                            1.	To study the functionality and design elements in the existing project management system. <br>
                            2.	To develop a final year project management system for the Faculty of Computing.<br>
                            3.	To evaluate the effectiveness and functionality of the project management system.
                            </td>
                            <td>
                            1.	Supervisor
                            2.	Supervisee
                            3.	Coordinator PTA & PSM
                            </td>
                        </tr>
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