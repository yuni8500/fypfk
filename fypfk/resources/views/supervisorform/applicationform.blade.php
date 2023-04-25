@extends('layouts.sideNav')

@section('content')

@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>SUPERVISOR APPLICATION</b></h3>
@if($idexist)
<div class="card" style="width: 100%; margin: auto">

    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                <!-- FOR STAFF TO VIEW RECORD APPOINTMENT LIST START -->
                <table class="table table-bordered" id="dataTable" style="width: 100%; margin: auto" cellspacing="0">
                    @csrf
                    <thead style="background-color: #86B5B3; color: black;">
                        <tr>
                            <th><center><b>SUPERVISOR NAME</b></center></th>
                            <th><center><b>PROPOSED TITLE</b></center></th>
                            <th><center><b>STATUS APPLICATION</b></center></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($getdata as $key=>$data)
                        <tr>
                            <td><center><label>{{$data->name}}</label></center></td>
                            <td><center><label>{{$data->proposedTitle}}</label></center></td>
                            <td><center><label>{{$data->statusApplied}}</label></center></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@elseif(! $idexist)
<div class="card" style="width: 80%; margin: auto">

    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                <!-- FOR STAFF TO VIEW RECORD APPOINTMENT LIST START -->
                <table class="table table-bordered" id="dataTable" style="width: 100%; margin: auto" cellspacing="0">
                <form method="post" action="{{ route('insertApplication') }}">
                    @csrf
                    <thead style="background-color: #86B5B3; color: black;">
                        <tr>
                            <th colspan="2" style="background-color: #145956; color: white"><center>SECTION A: STUDENT DETAILS</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($getstudData as $studData)
                        <tr>
                            <td style="text-align: center; color: black"><label>Name</label></td>
                            <td>
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="name" id="name" value="{{$studData->name}}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Student ID</label></td>
                            <td>
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 40%;" class="form-control" name="matric" id="matric" value="{{$studData->matric}}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Phone Number</label></td>
                            <td>
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 40%;" class="form-control" name="phoneNum" id="phoneNum" value="{{$studData->numPhone}}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Email</label></td>
                            <td>
                                <input type="email" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="email" id="email" value="{{$studData->email}}" readonly>
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
                            <td style="text-align: center; color: black"><label>Supervisor Name</label></td>
                            <td>
                                <select name="supervisorName" id="supervisorName" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control">
                                    <option value="" disabled>Please select staff name</option>
                                    @foreach($supervisorlist as $data)
                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Proposed Title</label></td>
                            <td>
                                <textarea class="form-control" name="title" id="title" rows="2" style="background-color: #86B5B3; border-radius: 10px; width: 100%;"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Background Problem</label></td>
                            <td>
                                <textarea class="form-control" name="problem" id="problem" rows="3" style="background-color: #86B5B3; border-radius: 10px; width: 100%;"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Project Domain</label></td>
                            <td>
                                <textarea class="form-control" name="domain" id="domain" rows="2" style="background-color: #86B5B3; border-radius: 10px; width: 100%;"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black" colspan="2">
                                <label>I declare that the idea of this project is from</label>
                                <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="radio1" id="radio1" value="Lecturer">
                                    <label class="form-check-label" for="radio1">Lecturer</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="radio1" id="radio1" value="Student">
                                    <label class="form-check-label" for="radio1">Student</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <center>
                                    <button type="submit" class="btn btn-primary" style="background-color: #145956; border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px">
                                        <b>SUBMIT</b>
                                    </button>
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
@endif
<br>
@endsection