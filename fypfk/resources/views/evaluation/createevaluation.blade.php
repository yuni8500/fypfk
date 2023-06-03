@extends('layouts.sideNav')

@section('content')

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>CREATE EVALUATION</b></h3>

<a href="{{ route('evaluationAdmin') }}" style="color: black">
    <i class="material-icons" style="color: black; font-size: 20px">keyboard_arrow_left</i> <b>BACK</b>
</a>

<table>
    <form action="{{ route('superviseeListData') }}" method="POST">
    @csrf
    <tr>
        <td>
            <select name="staffName" id="staffName" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control">
                <option value="">Please select expert group</option>
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