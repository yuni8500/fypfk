@extends('layouts.sideNav')

@section('content')

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>{{$submissionData->title}}</b></h3>

<a href="{{ route('submission') }}" style="color: black">
    <i class="material-icons" style="color: black; font-size: 20px">keyboard_arrow_left</i> <b>BACK</b>
</a>
<br><br>
<table>
<form action="{{ route('viewSubmissionAdmin', $submissionData->id) }}" method="POST">
@csrf
    <tr>
        <td>
            <select name="supervisorName" id="supervisorName" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control">
                <option value="">Please select staff name</option>
                @foreach($staff as $staffdata)
                <option value="{{$staffdata->id}}">{{$staffdata->name}}</option>
                @endforeach
            </select>
        </td>
        <td>
            <button class="btn" style="border-radius: 10px; border: none; width: 85px; color: white; background-color: #145956; font-size: 15px">
                <b>SUBMIT</b>
            </button>
        </td>
    </tr>
</form>
</table>
<br>
<div class="card">
    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead style="background-color: #86B5B3; color: black;">
                        <tr>
                            <th><center>STUDENT NAME</center></th>
                            <th><center>STUDENT ID</center></th>
                            <th><center>SEMESTER</center></th>
                            <th><center>ACTION</center></th>
                        </tr>
                    </thead>
                    <tbody>
                    @if($studentexist)
                    @foreach($student as $data)
                        <tr>
                            <td><center><label></label>{{$data->name}}</center></td>
                            <td><center><label></label>{{$data->matric}}</center></td>
                            <td><center><label></label>{{$data->semester}}</center></td>
                            <td>
                                <center>
                                    <a class="btn btn-primary" href="{{ route('viewSubmissionStudent', ['userID' => $data->userID, 'submissionID' => $submissionData->id]) }}" style="border-radius: 10px; border: none; width: 60%; color: white; font-size: 15px; background-color: #145956;">
                                        <b>VIEW</b>
                                    </a>
                                </center>
                            </td>
                        </tr>
                    @endforeach
                    @else
                        <tr>
                            <th colspan="4">
                                <center>
                                    <h5 style="color: red"><i class="material-icons" style="color: red">priority_high</i> No Supervisee <i class="material-icons" style="color: red">priority_high</i></h5>
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
<Script>

</script>
@endsection