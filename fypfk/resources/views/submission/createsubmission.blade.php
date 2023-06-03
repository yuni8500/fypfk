@extends('layouts.sideNav')

@section('content')

<!-- to display the alert message if the record has been deleted -->
@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>CREATE SUBMISSION</b></h3>
<div class="card">
    
    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <form method="post" action="{{ route('insertSubmission') }}">
                    @csrf
                    <tbody>
                        <tr>
                            <td><label>Course</label></td>
                            <td colspan="3">
                                <select name="course" id="course" style="background-color: #86B5B3; border-radius: 10px; width: 30%;" class="form-control" required>
                                    <option value="">Please choose course</option>
                                    <option value="PTA 1">PTA 1</option>
                                    <option value="PTA 2">PTA 2</option>
                                    <option value="PSM 1">PSM 1</option>
                                    <option value="PSM 2">PSM 2</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Title</label></td>
                            <td colspan="3">
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="title" id="title" value="" required>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Due Date</label></td>
                            <td>
                                <input type="date" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="dueDate" id="dueDate" value="" required>
                            </td>
                            <td><label>Due Time</label></td>
                            <td>
                                <input type="time" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="dueTime" id="dueTime" value="" required>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Link Attachment</label></td>
                            <td colspan="3">
                                <input type="url" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="attachment" id="attachment" value="">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
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
                    </tbody>
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