@extends('layouts.sideNav')

@section('content')

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>PSM 2 Submission for First Evaluation [30%]</b></h3>

<a href="{{ route('submission') }}" style="color: black">
    <i class="material-icons" style="color: black; font-size: 20px">keyboard_arrow_left</i> <b>BACK</b>
</a>

<br><br>
<table>
<form method="post" action="">
    <tr>
        <td>
            <select name="superviseeName" id="superviseeName" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control">
                <option value="">Please select your supervisee</option>
                @foreach($superviseedata as $data)
                <option value="{{$data->id}}">{{$data->name}}</option>
                @endforeach
            </select>
        </td>
        <td>
            <a class="btn" href="{{ route('submission') }}" style="border-radius: 10px; border: none; width: 85px; color: white; background-color: #145956; font-size: 15px">
                <b>SUBMIT</b>
            </a>
        </td>
    </tr>
</form>
</table>
<br>
<div class="card" style="width: 100%; margin: auto">

    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" style="width: 100%; margin: auto" cellspacing="0">
                <form method="post" action="">
                    @csrf
                    <tr>
                        <th style="background-color: #145956; color: white"><center>Submission Status</center></th>
                        <td colspan="2"><label>No attempt</label></td>
                    </tr>
                    <tr>
                        <th style="background-color: #145956; color: white"><center>Grading Status</center></th>
                        <td><label>No graded</label></td>
                        <td>
                            <center>
                                <a class="btn" href="{{ route('submission') }}" style="border-radius: 10px; border: none; width: 100px; color: black; background-color: #86B5B3; font-size: 15px">
                                    <b>GRADED</b>
                                </a>
                            </center>
                        </td>
                    </tr>
                    <tr>
                        <th style="background-color: #145956; color: white"><center>Due Date</center></th>
                        <td colspan="2"><label>Friday, 1/5/2023, 11:59 PM</label></td>
                    </tr>
                    <tr>
                        <th style="background-color: #145956; color: white"><center>Last Modified</center></th>
                        <td colspan="2"><label>No modified</label></td>
                    </tr>
                    <tr>
                        <th style="background-color: #145956; color: white"><center>File Submissions</center></th>
                        <td colspan="2">
                            <input type="file" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="filesubmit" id="filesubmit" multiple>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <center>
                                <button type="submit" class="btn btn-primary" style="background-color: #145956; border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px">
                                    <b>SUBMIT</b>
                                </button>
                            </center>
                        </td>
                    </tr>
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