@extends('layouts.sideNav')

@section('content')

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>EVALUATION INFORMATION</b></h3>
<div class="card">
    
    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tr>
                        <th style="background-color: #86B5B3; color: black;"><center>Number</center></th>
                        <td>12</td>
                        <th style="background-color: #86B5B3; color: black;"><center>Date</center></th>
                        <td>01/02/2023</td>
                    </tr>
                    <tr>
                        <th style="background-color: #86B5B3; color: black;"><center>Time</center></th>
                        <td>11:00 AM - 12:00 PM</td>
                        <th style="background-color: #86B5B3; color: black;"><center>Location</center></th>
                        <td>BZ-03-076</td>
                    </tr>
                    <tr>
                        <th style="background-color: #86B5B3; color: black;"><center>Evaluators 1</center></th>
                        <td>
                            DR. JAMALUDIN BIN SALLIM
                        </td>
                        <th style="background-color: #86B5B3; color: black;"><center>Evaluators 2</center></th>
                        <td>
                            PM. DR. NORAZIAH BINTI AHMAD
                        </td>
                    </tr>
                    <tr>
                        <th style="background-color: #86B5B3; color: black;"><center>Marks Evaluators 1</center></th>
                        <td>
                            20.0
                        </td>
                        <th style="background-color: #86B5B3; color: black;"><center>Marks Evaluators 2</center></th>
                        <td>
                            25.0
                        </td>
                    </tr>
                    <tr>
                        <th style="background-color: #86B5B3; color: black;"><center>Total Marks</center></th>
                        <td colspan="3">
                            25.0
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<br>
<script src="{{ asset('frontend') }}/js/jquery.dataTables.js"></script>
<Script>

</script>
@endsection