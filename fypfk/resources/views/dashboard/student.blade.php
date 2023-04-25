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

    <h3 style="color: black; padding-left: 5px;"><b>ANNOUNCEMENT BOARD</b></h3>
    <hr style="border: 1px solid black">

    <div class="container" style="margin-bottom: 20px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="background-color: #86B5B3">
                <div class="card-header" style="background-color: #86B5B3"><h5 style="color: black;"><b>{{ __('Week 4') }}</b></h5></div>

                <table style="color: black; margin-left: 20px">
                    <tr>
                        <td colspan="2">
                            <label><b>PSM 1 & PTA 1 Colloquium</b></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Date:</label>
                        </td>
                        <td>
                            <label>9 NOVEMBER 2022</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Time:</label>
                        </td>
                        <td>
                            <label>4:00PM - 5:00PM</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Platform:</label>
                        </td>
                        <td>
                            <label>Microsoft Teams</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Link:</label>
                        </td>
                        <td>
                            <label>CLICK HERE</label>
                        </td>
                    </tr>
                </table>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

@endsection