@extends('layouts.sideNav')

@section('content')

<!-- to display the alert message if the record has been deleted -->

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>PROJECT REPORT</b></h3>


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
                                    <label style="font-size: 50px">10</label>
                                </center>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="card">
                            <div class="card-body">
                                <center>
                                    <h5 style="color: black"><b>Total Overdue</b></h5>
                                    <label style="font-size: 50px">0</label>
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

<br>

@endsection

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Status', 'Total'],
          ['On Track',     11],
          ['Off Track',      5],
          ['Risk',  2]
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
          ['High',     5],
          ['Medium',      10],
          ['Low',  4]
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
          ['Task Complete', 'Hours per Day'],
          ['Completed',     11],
          ['In Complete',      5]
        ]);

        var options = {
          title: 'Total Task Completion',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('taskComplete'));
        chart.draw(data, options);
      }
    </script>