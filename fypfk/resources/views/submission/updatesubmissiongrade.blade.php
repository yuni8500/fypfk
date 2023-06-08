@extends('layouts.sideNav')

@section('content')

<!-- to display the alert message if the record has been deleted -->
@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>SUBMISSION GRADED</b></h3>
<div class="card">
    
    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <form method="post" action="{{ route('updateGradedSubmission', $student->superviseesubmissionID )}}">
                    @csrf
                    @method('PUT')
                    <tbody>
                        <tr>
                            <td><label>Student Name</label></td>
                            <td>
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="name" id="name" value="{{$student->name}}" required readonly>
                            </td>
                            <td><label>Student ID</label></td>
                            <td>
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="matric" id="matric" value="{{$student->matric}}" required readonly>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Graded File</label></td>
                            <td colspan="3">
                                <input type="url" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="fileEvaluate" id="fileEvaluate" value="{{$student->linkAttachment}}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Marks</label></td>
                            <td colspan="3">
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 30%;" class="form-control" name="marks" id="marks" value="{{$student->marks}}" required>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <center>
                                    <button type="submit" class="btn btn-primary" style="background-color: #145956; border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px">
                                        <b>UPDATE</b>
                                    </button>
                                    <a class="btn btn-danger" href="{{ route('viewSubmission', $submissionData->id) }}" style="border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px">
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