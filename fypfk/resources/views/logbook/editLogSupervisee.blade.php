@extends('layouts.sideNav')

@section('content')

<!-- to display the alert message if the record has been deleted -->
@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>UPDATE LOGBOOK</b></h3>
<div class="card">
    
    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                @foreach($logbookdata as $data)
                <form method="post" action="{{ route('updateSuperviseeLogbook', $data->logbookID) }}">
                    @csrf
                    @method('PUT')
                    <tbody>
                    <tr>
                            <td><label>Student Name</label></td>
                            <td>
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 70%;" class="form-control" name="week" id="week" value="{{$data->name}}" required readonly>
                            </td>
                            <td><label>Student ID</label></td>
                            <td>
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 70%;" class="form-control" name="dateLog" id="dateLog" value="{{$data->matric}}" required readonly>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Week</label></td>
                            <td>
                                <input type="number" style="background-color: #86B5B3; border-radius: 10px; width: 70%;" class="form-control" name="week" id="week" value="{{$data->weekLog}}" required readonly>
                            </td>
                            <td><label>Date</label></td>
                            <td>
                                <input type="date" style="background-color: #86B5B3; border-radius: 10px; width: 70%;" class="form-control" name="dateLog" id="dateLog" value="{{$data->dateLog}}" required readonly>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Time Start</label></td>
                            <td>
                                <input type="time" style="background-color: #86B5B3; border-radius: 10px; width: 70%;" class="form-control" name="tStart" id="tStart" value="{{$data->timeStart}}" required readonly>
                            </td>
                            <td><label>Time End</label></td>
                            <td>
                                <input type="time" style="background-color: #86B5B3; border-radius: 10px; width: 70%;" class="form-control" name="tEnd" id="tEnd" value="{{$data->timeEnd}}" required readonly>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Progress</label></td>
                            <td colspan="3">
                            <textarea class="form-control" name="progress" id="progress" rows="3" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" readonly>{{$data->progress}}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Supervisor Comment</label></td>
                            <td colspan="3">
                            <textarea class="form-control" name="comment" id="comment" rows="3" style="background-color: #86B5B3; border-radius: 10px; width: 100%;"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <center>
                                    <button type="submit" class="btn btn-primary" style="background-color: #145956; border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px">
                                        <b>UPDATE</b>
                                    </button>
                                    <a class="btn btn-danger" href="{{ route('logbookSuperviseeView', $data->userID) }}" style="border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px;">
                                        <b>BACK</b>
                                    </a>
                                </center>
                            </td>
                        </tr>
                    </tbody>
                </form>
                @endforeach
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