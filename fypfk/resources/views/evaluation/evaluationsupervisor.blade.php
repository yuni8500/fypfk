@extends('layouts.sideNav')

@section('content')

<!-- to display the alert message if the record has been deleted -->

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>EVALUATION INFORMATION</b></h3>
<div class="card">
    
    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead style="background-color: #86B5B3; color: black;">
                        <tr>
                            <th colspan="6"><center>PTA 1</center></th>
                        </tr>
                        <tr>
                            <th><center>NUM</center></th>
                            <th><center>STUDENT NAME</center></th>
                            <th><center>DATE</center></th>
                            <th><center>TIME</center></th>
                            <th><center>LOCATION</center></th>
                            <th><center>ACTION</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><center><label>10</label></center></td>
                            <td><center><label>NUR IZZ IMANINA BINTI ISMAIL</label></center></td>
                            <td><center><label>15/06/2023</label></center></td>
                            <td><center><label>8:00 AM</label></center></td>
                            <td><center><label>BZ-02-67</label></center></td>
                            <td>
                                <center>
                                    <a class="btn btn-primary" href="{{ route('evaluationGraded') }}" style="border-radius: 10px; border: none; width: 70%; color: white; font-size: 15px; background-color: #145956;">
                                        <b>GRADED</b>
                                    </a>
                                </center>
                            </td>
                        </tr>
                    </tbody>
                    
                    <thead style="background-color: #86B5B3; color: black;">
                        <tr>
                            <th colspan="6"><center>PTA 2</center></th>
                        </tr>
                        <tr>
                            <th><center>NUM</center></th>
                            <th><center>STUDENT NAME</center></th>
                            <th><center>DATE</center></th>
                            <th><center>TIME</center></th>
                            <th><center>LOCATION</center></th>
                            <th><center>ACTION</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><center><label>20</label></center></td>
                            <td><center><label>NUR AISYAH NADHIRAH BINTI JAMARULAMIR</label></center></td>
                            <td><center><label>12/06/2023</label></center></td>
                            <td><center><label>8:00 AM</label></center></td>
                            <td><center><label>ASTAKA</label></center></td>
                            <td>
                                <center>
                                    <a class="btn btn-primary" href="{{ route('evaluationGraded') }}" style="border-radius: 10px; border: none; width: 70%; color: white; font-size: 15px; background-color: #145956;">
                                        <b>GRADED</b>
                                    </a>
                                </center>
                            </td>
                        </tr>
                    </tbody>

                    <thead style="background-color: #86B5B3; color: black;">
                        <tr>
                            <th colspan="6"><center>PSM 1</center></th>
                        </tr>
                        <tr>
                            <th><center>NUM</center></th>
                            <th><center>STUDENT NAME</center></th>
                            <th><center>DATE</center></th>
                            <th><center>TIME</center></th>
                            <th><center>LOCATION</center></th>
                            <th><center>ACTION</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><center><label>45</label></center></td>
                            <td><center><label>NUR IZYAN BINTI ABDUL HAMID</label></center></td>
                            <td><center><label>18/06/2023</label></center></td>
                            <td><center><label>8:00 AM</label></center></td>
                            <td><center><label>BZ-02-100</label></center></td>
                            <td>
                                <center>
                                    <a class="btn btn-primary" href="{{ route('evaluationGraded') }}" style="border-radius: 10px; border: none; width: 70%; color: white; font-size: 15px; background-color: #145956;">
                                        <b>GRADED</b>
                                    </a>
                                </center>
                            </td>
                        </tr>
                    </tbody>

                    <thead style="background-color: #86B5B3; color: black;">
                        <tr>
                            <th colspan="6"><center>PSM 2</center></th>
                        </tr>
                        <tr>
                            <th><center>NUM</center></th>
                            <th><center>STUDENT NAME</center></th>
                            <th><center>DATE</center></th>
                            <th><center>TIME</center></th>
                            <th><center>LOCATION</center></th>
                            <th><center>ACTION</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><center><label>50</label></center></td>
                            <td><center><label>MUHAMMAD AYDAN BIN JUKHAIRI</label></center></td>
                            <td><center><label>13/06/2023</label></center></td>
                            <td><center><label>8:00 AM</label></center></td>
                            <td><center><label>ASTAKA</label></center></td>
                            <td>
                                <center>
                                    <a class="btn btn-primary" href="{{ route('evaluationGraded') }}" style="border-radius: 10px; border: none; width: 70%; color: white; font-size: 15px; background-color: #145956;">
                                        <b>GRADED</b>
                                    </a>
                                </center>
                            </td>
                        </tr>
                    </tbody>
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