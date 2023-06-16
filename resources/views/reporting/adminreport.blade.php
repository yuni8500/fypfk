@extends('layouts.sideNav')

@section('content')

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>PROJECT REPORT</b></h3>

<table>
    <form action="{{ route('superviseeList') }}" method="POST">
    @csrf
    <tr>
        <td>
            <select name="staffName" id="staffName" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control">
                <option value="">Please select staff name</option>
                @foreach($staff as $data)
                    <option value="{{ $data->id }}">{{ $data->name }}</option>
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
<script src="{{ asset('frontend') }}/js/jquery.dataTables.js"></script>

@endsection