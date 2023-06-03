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

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>LOGBOOK</b></h3>

<div class="card">
    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead style="background-color: #86B5B3; color: black;">
                        <tr>
                            <th><center>STAFF NAME</center></th>
                            <th><center>EXPERT GROUP</center></th>
                            <th><center>ACTION</center></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($staff as $data)
                        <tr>
                            <td><center>{{$data->name}}</center></td>
                            <td><center>{{$data->course_group}}</center></td>
                            <td>
                                <center>
                                    <a class="btn btn-primary" href="{{ route('logbookSuperviseeList', $data->id) }}" style="border-radius: 10px; border: none; width: 50%; color: white; font-size: 15px; background-color: #145956;">
                                        <b>VIEW</b>
                                    </a>
                                </center>
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
<br>
<script src="{{ asset('frontend') }}/js/jquery.dataTables.js"></script>
<Script>

</script>

@endsection