@extends('layouts.sideNav')

@section('content')

<!-- to display the alert message if the record has been deleted -->

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>FINAL YEAR PROJECT REPORT</b></h3>

<a class="btn btn-primary" href="{{ route('reportingAdmin') }}" style="border-radius: 10px; border: none; width: 23%; color: white; font-size: 15px; background-color: #145956; margin-left: 859px; margin-bottom:15px">
    <i class="material-icons" style="color: white">data_usage</i> <b>SUPERVISEE PROJECT REPORT</b>
</a>

<table>
    <form action="{{ route('fypReportAdmin') }}" method="POST">
    @csrf
    <tr>
        <td>
            <select name="semester" id="semester" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control">
                <option value="">Please select semester</option>
                @foreach($semester as $data)
                    <option value="{{ $data->semester }}">{{ $data->semester }}</option>
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
<div class="overflow-auto" style="overflow:auto;">
    <div class="table-responsive">
        <table class="table" id="dataTable" width="100%" cellspacing="0">
            <tbody>
                <tr>
                    <td>
                        <div class="card" style="background-color: #86B5B3; color: black">
                            <div class="card-body">
                                <center>
                                    <table>
                                        <tr>
                                            <td style="vertical-align: none; border-top: none">
                                                <i class="material-icons" style="font-size: 100px; padding-right: 50px; color: #145956">people</i>
                                            </td>
                                            <td style="vertical-align: none; border-top: none">
                                                <center>
                                                    <h5 style="color: black"><b>PTA 1</b></h5>
                                                    <label style="font-size: 50px">{{ $countPTA1 }}</label>
                                                </center>
                                            </td>
                                        </tr>
                                    </table>
                                </center>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="card" style="background-color: #145956; color: white">
                            <div class="card-body">
                                <center>
                                    <table>
                                        <tr>
                                            <td style="vertical-align: none; border-top: none">
                                                <i class="material-icons" style="font-size: 100px; padding-right: 50px; color: #86B5B3">people</i>
                                            </td>
                                            <td style="vertical-align: none; border-top: none">
                                            <center>
                                                <h5 style="color: white"><b>PTA 2</b></h5>
                                                <label style="font-size: 50px">{{ $countPTA2 }}</label>
                                            </center>
                                            </td>
                                        </tr>
                                    </table>
                                </center>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="card" style="background-color: #145956; color: white">
                            <div class="card-body">
                                <center>
                                    <table>
                                        <tr>
                                            <td style="vertical-align: none; border-top: none">
                                                <i class="material-icons" style="font-size: 100px; padding-right: 50px; color: #86B5B3">people</i>
                                            </td>
                                            <td style="vertical-align: none; border-top: none">
                                            <center>
                                                <h5 style="color: white"><b>PSM 1</b></h5>
                                                <label style="font-size: 50px">{{ $countPSM1 }}</label>
                                            </center>
                                            </td>
                                        </tr>
                                    </table>
                                </center>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="card" style="background-color: #86B5B3; color: black">
                            <div class="card-body">
                                <center>
                                    <table>
                                        <tr>
                                            <td style="vertical-align: none; border-top: none">
                                                <i class="material-icons" style="font-size: 100px; padding-right: 50px; color: #145956">people</i>
                                            </td>
                                            <td style="vertical-align: none; border-top: none">
                                            <center>
                                                <h5 style="color: black"><b>PSM 2</b></h5>
                                                <label style="font-size: 50px">{{ $countPSM2 }}</label>
                                            </center>
                                            </td>
                                        </tr>
                                    </table>
                                </center>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<br>

@endsection