@extends('layouts.sideNav')

@section('content')

<!-- to display the alert message if the record has been deleted -->
@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>INSERT LOGBOOK</b></h3>
<div class="card">
    
    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <form method="post" action="{{ route('insertLogbook') }}">
                    @csrf
                    <tbody>
                        <tr>
                            <td><label>Week</label></td>
                            <td>
                                <input type="number" style="background-color: #86B5B3; border-radius: 10px; width: 70%;" class="form-control" name="week" id="week" value="" required>
                            </td>
                            <td><label>Date</label></td>
                            <td>
                                <input type="date" style="background-color: #86B5B3; border-radius: 10px; width: 70%;" class="form-control" name="dateLog" id="dateLog" value="" required>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Time Start</label></td>
                            <td>
                                <input type="time" style="background-color: #86B5B3; border-radius: 10px; width: 70%;" class="form-control" name="tStart" id="tStart" value="" required>
                            </td>
                            <td><label>Time End</label></td>
                            <td>
                                <input type="time" style="background-color: #86B5B3; border-radius: 10px; width: 70%;" class="form-control" name="tEnd" id="tEnd" value="" required>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Supervisor Name</label></td>
                            <td colspan="3">
                                @foreach($getdata as $key=>$data)
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 50%;" class="form-control" name="supervisorName" id="supervisorName" value="{{$data->name}}" readonly>
                                <input type="hidden" style="background-color: #86B5B3; border-radius: 10px; width: 50%;" class="form-control" name="supervisorID" id="supervisorID" value="{{$data->supervisorID}}" readonly>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td><label>Progress</label></td>
                            <td colspan="3">
                            <textarea class="form-control" name="progress" id="progress" rows="3" style="background-color: #86B5B3; border-radius: 10px; width: 100%;"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <center>
                                    <button type="submit" class="btn btn-primary" style="background-color: #145956; border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px">
                                        <b>SUBMIT</b>
                                    </button>
                                    <a class="btn btn-danger" href="{{ route('logbook') }}" style="border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px">
                                        <b>CANCEL</b>
                                    </a>
                                </center>
                            </td>
                        </tr>
                    </tbody>
                </form>
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