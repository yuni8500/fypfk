@extends('layouts.sideNav')

@section('content')

<!-- to display the alert message if the record has been deleted -->

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>PROJECT REPORT - {{$studData->name}}</b></h3>

@if( auth()->user()->category== "Staff")
<div class="overflow-auto" style="overflow:auto;">
    <div class="table-responsive">
        <table class="table" id="dataTable" width="100%" cellspacing="0">
            <tbody>
                <tr>
                    <td>
                        <div class="card">
                            <div class="card-body">
                                <center>
                                    <h5 style="color: black"><b>Total Task</b></h5>
                                    <label style="font-size: 50px">{{ $countTask }}</label>
                                </center>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="card">
                            <div class="card-body">
                                <center>
                                    <h5 style="color: black"><b>Total Project Submission</b></h5>
                                    <label style="font-size: 50px">{{ $totalSubmit }} / {{ $totalSubmission }}</label>
                                </center>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="card">
                            <div class="card-body">
                                <div id="totalstatus" style="width: 900px; height: 300px;"></div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="card">
                            <div class="card-body">
                                <div id="totalpriority" style="width: 900px; height: 300px;"></div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="card">
                            <div class="card-body">
                                <div id="taskComplete" style="width: 900px; height: 300px;"></div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endif
@if( auth()->user()->category== "Admin")
<a href="{{ route('reportingAdmin') }}" style="color: black">
    <i class="material-icons" style="color: black; font-size: 20px">keyboard_arrow_left</i> <b>BACK</b>
</a>
<br><br>
<div class="overflow-auto" style="overflow:auto;">
    <div class="table-responsive">
        <table class="table" id="dataTable" width="100%" cellspacing="0">
            <tbody>
                <tr>
                    <td>
                        <div class="card">
                            <div class="card-body">
                                <center>
                                    <h5 style="color: black"><b>Total Task</b></h5>
                                    <label style="font-size: 50px">{{ $countTask }}</label>
                                </center>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="card">
                            <div class="card-body">
                                <center>
                                    <h5 style="color: black"><b>Total Project Submission</b></h5>
                                    <label style="font-size: 50px">{{ $totalSubmit }} / {{ $totalSubmission }}</label>
                                </center>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="card">
                            <div class="card-body">
                                <div id="totalstatus" style="width: 900px; height: 300px;"></div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="card">
                            <div class="card-body">
                                <div id="totalpriority" style="width: 900px; height: 300px;"></div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="card">
                            <div class="card-body">
                                <div id="taskComplete" style="width: 900px; height: 300px;"></div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endif
<br>

@endsection

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Status', 'Total'],
          ['On Track',     {{ $countOntrack ? $countOntrack->count : 0 }} ],
          ['Off Track',    {{ $countOfftrack ? $countOfftrack->count : 0 }} ],
          ['Risk',  {{ $countRisk ? $countRisk->count : 0 }} ]
        ]);

        var options = {
          title: 'Total Status'
        };

        var chart = new google.visualization.PieChart(document.getElementById('totalstatus'));

        chart.draw(data, options);
      }
</script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Priority', 'Total'],
          ['High',     {{ $countHigh ? $countHigh->count : 0 }} ],
          ['Medium',   {{ $countMedium ? $countMedium->count : 0 }} ],
          ['Low', {{ $countLow ? $countLow->count : 0 }}]
        ]);

        var options = {
          title: 'Total Priority'
        };

        var chart = new google.visualization.PieChart(document.getElementById('totalpriority'));

        chart.draw(data, options);
      }
</script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task Complete', 'Total'],
          ['Completed',     {{ $countComplete ? $countComplete->count : 0 }} ],
          ['In Complete',   {{ $countIncomplete ? $countIncomplete->count : 0 }} ]
        ]);

        var options = {
          title: 'Total Task Completion',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('taskComplete'));
        chart.draw(data, options);
      }
    </script>