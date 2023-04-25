@extends('layouts.sideNav')
@section('content')

<!-- Page Header -->
<!--
<div class="page-header row no-gutters pb-4">
    <div class="col-12 col-sm-4 text-center text-sm-left mb-0 d-flex">
        <h1 class="page-title ml-3">Student Overview</h1>
    </div>
</div>-->

<!-- to display message box proposal has been updated -->
@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif

<div class="row">

    <h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>PROFILE</b></h3>
    <br><br>
    <hr style="border: 1px solid black">

    <div class="container" style="margin-bottom: 20px;">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card" style="background-color: white">
                <table style="color: black;">
                <form method="post" action="{{ route('updateProfile', Auth::user()->id ) }}">
                    @csrf
                    @method('PUT')
                    <tr>
                        <td style="padding-left: 30px">
                        <br>
                            <label>Name:</label>
                        </td>
                        <td style="padding-left: 30px">
                        <br>
                            <label>Student ID:</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 70%; margin-left: 30px" class="form-control" name="name" id="name" value="{{$user->name}}" required>
                        </td>
                        <td>
                            <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 70%; margin-left: 30px" class="form-control" name="matric" id="matric" value="{{$user->matric}}" required>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-left: 30px">
                            <label>Email:</label>
                        </td>
                        <td style="padding-left: 30px">
                            <label>Number Phone:</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="email" style="background-color: #86B5B3; border-radius: 10px; width: 70%; margin-left: 30px" class="form-control" name="email" id="email" value="{{$user->email}}" required>
                        </td>
                        <td>
                            <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 70%; margin-left: 30px" class="form-control" name="numPhone" id="numPhone" value="{{$user->numPhone}}" required>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-left: 30px;" colspan="2">
                            <label>Course:</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <select name="course" id="course" style="background-color: #86B5B3; border-radius: 10px; width: 70%; margin-left: 30px" class="form-control" required>
                                <option value="" disabled>Please select course</option>
                                <option value="PTA 1">PTA 1</option>
                                <option value="PTA 2">PTA 2</option>
                                <option value="PSM 1">PSM 1</option>
                                <option value="PSM 2">PSM 2</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <br>
                        <center>
                            <button type="submit" class="btn btn-primary" style="background-color: #145956; border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px">
                                <b>UPDATE</b>
                            </button>
                            <a class="btn btn-danger" href="{{ route('dashboard') }}" style="border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px">
                                    <b>CANCEL</b>
                            </a>
                        </center>
                        <br>
                        </td>
                    </tr>
                </form>
                </table>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

@endsection