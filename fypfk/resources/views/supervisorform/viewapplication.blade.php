@extends('layouts.sideNav')

@section('content')

@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>SUPERVISOR APPLICATION</b></h3>

<div class="card" style="width: 80%; margin: auto">

    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                <!-- FOR STAFF TO VIEW RECORD APPOINTMENT LIST START -->
                <table class="table table-bordered" id="dataTable" style="width: 100%; margin: auto" cellspacing="0">
                @foreach($applydata as $key=>$applydata)
                <form method="post" action="{{ route('updateApplicationAgree', $applydata->id) }}">
                    @csrf
                    @method('PUT')
                    <thead style="background-color: #86B5B3; color: black;">
                        <tr>
                            <th colspan="2" style="background-color: #145956; color: white"><center>SECTION A: STUDENT DETAILS</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($studData as $key=>$studData)
                        <tr>
                            <td style="text-align: center; color: black"><label>Name</label></td>
                            <td>
                                <label>{{$studData->name}}</label>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Student ID</label></td>
                            <td>
                                <label>{{$studData->matric}}</label>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Phone Number</label></td>
                            <td>
                                <label>{{$studData->numPhone}}</label>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Email</label></td>
                            <td>
                                <label>{{$studData->email}}</label>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <thead style="background-color: #86B5B3; color: black;">
                        <tr>
                            <th colspan="2" style="background-color: #145956; color: white"><center>SECTION B: PROJECT DETAILS</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align: center; color: black"><label>Semester</label></td>
                            <td>
                                <label>{{$applydata->semester}}</label>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Supervisor Name</label></td>
                            <td>
                                <label>{{$applydata->name}}</label>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Proposed Title</label></td>
                            <td>
                                <label>{{$applydata->proposedTitle}}</label>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Background Problem</label></td>
                            <td>
                                <label>{{$applydata->problemStatement}}</label>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black">
                                <label>Objective</label>
                            </td>
                            <td>
                                <label>{{$applydata->objective}}</label>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black">
                                <label>Scope</label> <br>
                            </td>
                            <td>
                                <label>{{$applydata->scope}}</label>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Project Domain</label></td>
                            <td>
                                <label>{{$applydata->domain}}</label>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black" colspan="2">
                                <label>I declare that the idea of this project is from</label>
                                <br>
                                <label>{{$applydata->declaration}}</label>
                            </td>
                        </tr>
                    </tbody>
                    <thead style="background-color: #86B5B3; color: black;">
                        <tr>
                            <th colspan="2" style="background-color: #145956; color: white"><center>SECTION C: LECTURER DECLARATION</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align: center; color: black"><label>Date Approval</label></td>
                            <td>
                            <input type="date" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="dateApproved" id="dateApproved" value="">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label class="form-check-label" for="radio1">I hereby agree to supervise the aforementioned student for the Undergraduate Project with the stated title details.</label>    
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <center>
                                    <button type="submit" class="btn btn-primary" style="background-color: #145956; border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px">
                                        <b>AGREE</b>
                                    </button>
                                    <a class="btn btn-danger" href="{{ route('updateApplicationDisagree', $applydata->id) }}" style="border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px">
                                        <b>DISAGREE</b>
                                    </a>
                                    <a class="btn" href="{{ route('applicationList') }}" style="border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px; background-color: #86B5B3">
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
@endsection