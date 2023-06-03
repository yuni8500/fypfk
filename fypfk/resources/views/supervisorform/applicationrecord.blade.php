@extends('layouts.sideNav')

@section('content')

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>SUPERVISOR APPLICATION RECORD</b></h3>

<a href="{{ route('supervisorApplicationAdmin') }}" style="color: black">
    <i class="material-icons" style="color: black; font-size: 20px">keyboard_arrow_left</i> <b>BACK</b>
</a>
<br><br>
<table>
    <form action="{{ route('supervisorApplicationRecordDisplay') }}" method="POST">
    @csrf
    <tr>
        <td>
            <select name="expertGroup" id="expertGroup" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control">
                <option value="">Please select expert group</option>
                <option value="CSRG">CSRG</option>
                <option value="VISIC">VISIC</option>
                <option value="MIRG">MIRG</option>
                <option value="CY-SIG">CY-SIG</option>
                <option value="SERG">SERG</option>
                <option value="KECL">KECL</option>
                <option value="DSSim">DSSim</option>
                <option value="DBIS">DBIS</option>
                <option value="EDU-TECH">EDU-TECH</option>
                <option value="ISP">ISP</option>
                <option value="CNRG">CNRG</option>
                <option value="SCORE">SCORE</option>
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
<div class="card" style="width: 100%; margin: auto">

    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
        <div class="table-responsive">
        @if(isset($staffdata) && !$staffdata->isEmpty())
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead style="background-color: #86B5B3; color: black;">
                        <tr>
                            <th><center>STAFF NAME</center></th>
                            <th><center>EXPERT GROUP</center></th>
                            <th><center>ACTION</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($staffdata as $data)
                        <tr>
                            <td><center>{{ $data->name }}</center></td>
                            <td><center>{{ $data->course_group }}</center></td>
                            <td>
                                <center>
                                <a class="btn btn-primary" href="{{ route('displaySupervisorApplicationRecord', $data->id) }}" style="border-radius: 10px; border: none; width: 50%; color: white; font-size: 15px; background-color: #145956;">
                                    <b>VIEW</b>
                                </a>
                                </center>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead style="background-color: #86B5B3; color: black;">
                        <tr>
                            <th><center>STAFF NAME</center></th>
                            <th><center>EXPERT GROUP</center></th>
                            <th><center>ACTION</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="3">
                                <center>
                                    <h5 style="color: red"><i class="material-icons" style="color: red">warning</i> No Data</h5>
                                </center>
                            </td>
                        </tr>
                    </tbody>
            </table>
        </div>
        @endif
        </div>
    </div>
</div>
<br>
<script src="{{ asset('frontend') }}/js/jquery.dataTables.js"></script>

@endsection