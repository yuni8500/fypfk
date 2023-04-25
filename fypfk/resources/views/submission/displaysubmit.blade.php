@extends('layouts.sideNav')

@section('content')

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>PSM 2 Submission for First Evaluation [30%]</b></h3>

<div class="card" style="width: 100%; margin: auto">

    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" style="width: 100%; margin: auto" cellspacing="0">
                <form method="post" action="">
                    @csrf
                    <tr>
                        <th style="background-color: #145956; color: white"><center>Submission Status</center></th>
                        <td><label>No attempt</label></td>
                    </tr>
                    <tr>
                        <th style="background-color: #145956; color: white"><center>Grading Status</center></th>
                        <td><label>No graded</label></td>
                    </tr>
                    <tr>
                        <th style="background-color: #145956; color: white"><center>Due Date</center></th>
                        <td><label>Friday, 1/5/2023, 11:59 PM</label></td>
                    </tr>
                    <tr>
                        <th style="background-color: #145956; color: white"><center>Last Modified</center></th>
                        <td><label>No modified</label></td>
                    </tr>
                    <tr>
                        <th style="background-color: #145956; color: white"><center>File Submissions</center></th>
                        <td>
                            <input type="file" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="filesubmit" id="filesubmit" multiple>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <center>
                                <button type="submit" class="btn btn-primary" style="background-color: #145956; border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px">
                                    <b>SUBMIT</b>
                                </button>
                                <a class="btn btn-danger" href="{{ route('submission') }}" style="border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px">
                                    <b>CANCEL</b>
                                </a>
                            </center>
                        </td>
                    </tr>
                </form>
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