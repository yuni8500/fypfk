@extends('layouts.sideNav')
@section('content')

<!-- Page Header -->
<!--
<div class="page-header row no-gutters pb-4">
    <div class="col-12 col-sm-4 text-center text-sm-left mb-0 d-flex">
        <h1 class="page-title ml-3">Student Overview</h1>
    </div>
</div>-->

<div class="row">
    <img src="{{ asset('frontend') }}/images/banner.png" width="1137px" height="250px" style="display: block; padding-bottom: 20px;">
    <table>
        <tr>
            <td>
                <h3 style="color: black; padding-left: 5px;"><b>ANNOUNCEMENT BOARD</b></h3>
            </td>
            <td>
                <a href="{{ route('createAnnouncement') }}" style="font-size: 25px;">
                    <i class="material-icons" style="color: #145956">add_circle</i>
                </a>
            </td>
        </tr>
    </table>
    <hr>

    @foreach($announcementData as $data)
    <div class="container" style="margin-bottom: 20px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="background-color: #86B5B3">

                <table style="color: black; margin-left: 20px">
                    <tr>
                        <td>
                            <div class="card-header" style="background-color: #86B5B3"><h5 style="color: black;"><b>Week {{$data->week}}</b></h5></div>
                        </td>
                        <td>
                            <a href="{{ route('viewAnnouncement', $data->id) }}" style="font-size: 25px; margin-left:500px">
                                <i class="material-icons" style="color: white">edit</i>
                            </a>
                            <a href="{{ route('deleteAnnouncement', $data->id) }}" style="font-size: 25px;">
                                <i class="material-icons" style="color: red">delete</i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label><b>{{$data->title}}</b></label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label>Date: {{$data->date}}</label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label>Time: {{$data->time}}</label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label>{{$data->information}}</label>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    </div>
    @endforeach
</div>

@endsection