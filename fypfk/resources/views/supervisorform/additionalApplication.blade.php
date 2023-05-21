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
                <form method="post" action="{{ route('updateApplicationDisagree', $idApply->applyID) }}">
                    @csrf
                    @method('POST')
                    <thead style="background-color: #86B5B3; color: black;">
                        <tr>
                            <th colspan="2" style="background-color: #145956; color: white"><center>SECTION D: LECTURER REJECTION DECLARATION</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align: center; color: black"><label>Reason</label></td>
                            <td>
                            <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="reason" id="reason">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <center>
                                    <button type="submit" class="btn btn-primary" style="background-color: #145956; border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px">
                                        <b>SUBMIT</b>
                                    </button>
                                    <a class="btn btn-danger" href="{{ route('viewApplication', $idApply->userID) }}" style="border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px">
                                        <b>BACK</b>
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
@endsection