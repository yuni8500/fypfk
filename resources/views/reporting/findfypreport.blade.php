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
<br>

@endsection