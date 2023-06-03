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

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>LIST OF SUPERVISEE</b></h3>

<a href="{{ route('applicationList') }}" style="color: black">
    <i class="material-icons" style="color: black; font-size: 20px">keyboard_arrow_left</i> <b>BACK</b>
</a>
<br><br>
<div class="card">
    <div class="card-header pb-0">
        <div class="row">
            <div class="col-lg-16 col-md-12 col-sm-12">
                <nav class="">
                    <ul class="nav nav-tabs" id="myTab" role="tablist" style="color: black">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('superviseeList') ? '' : '' }}" href="{{ route('superviseeList') }}" role="tab" aria-selected="true">PTA 1</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('superviseeListPta2') ? '' : '' }}" href="{{ route('superviseeListPta2') }}" role="tab" aria-selected="true">PTA 2</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('superviseeListPsm1') ? 'active' : '' }}" href="{{ route('superviseeListPsm1') }}" role="tab" aria-selected="true">PSM 1</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('superviseeListPsm2') ? '' : '' }}" href="{{ route('superviseeListPsm2') }}" role="tab" aria-selected="true">PSM 2</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
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
                        @if($psm1Exist)
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
                        @elseif(! $psm1Exist)
                        <tr>
                            <th colspan="7">
                                <center>
                                    <h5 style="color: red"><i class="material-icons" style="color: red">priority_high</i> No Supervisee Data <i class="material-icons" style="color: red">priority_high</i></h5>
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
@endsection