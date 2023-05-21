@extends('layouts.sideNav')

@section('content')

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>PROJECT SUBMISSION</b></h3>

@if( auth()->user()->category== "Student")
<div class="card">  
    <div class="card-body">
        <a href="{{ route('viewSubmission') }}" style="color: black">
            <h5>PSM 2 Submission for First Evaluation [30%]</h5>
            <label>Due date: Friday, 1/5/2023, 11:59 PM</label>
        </a>
    </div>
</div>
<br>
<div class="card">  
    <div class="card-body">
        <a href="{{ route('viewSubmission') }}" style="color: black">
            <h5>PSM 2 Submission for Evaluators Evaluation [40%]</h5>
            <label>Due date: Monday, 10/7/2023, 11:59 PM</label>
        </a>
    </div>
</div>
<br>
<div class="card">  
    <div class="card-body">
        <a href="{{ route('viewSubmission') }}" style="color: black">
            <h5>PSM 2 Submission for Second Evaluation [30%]</h5>
            <label>Due date: Friday, 14/7/2023, 11:59 PM</label>
        </a>
    </div>
</div>
<br>
<div class="card">  
    <div class="card-body">
        <a href="{{ route('viewFinalSubmission') }}" style="color: black">
            <h5>PSM 2 Final Submission</h5>
            <label>Due date: Friday, 16/7/2023, 11:59 PM</label>
        </a>
    </div>
</div>
@endif

@if( auth()->user()->category== "Staff")
<div class="card">  
    <div class="card-body">
        <a href="{{ route('viewSubmission') }}" style="color: black">
            <h5>PSM 2 Submission for First Evaluation [30%]</h5>
            <label>Due date: Friday, 1/5/2023, 11:59 PM</label>
        </a>
    </div>
</div>
<br>
<div class="card">  
    <div class="card-body">
        <a href="{{ route('viewSubmission') }}" style="color: black">
            <h5>PSM 2 Submission for Evaluators Evaluation [40%]</h5>
            <label>Due date: Monday, 10/7/2023, 11:59 PM</label>
        </a>
    </div>
</div>
<br>
<div class="card">  
    <div class="card-body">
        <a href="{{ route('viewSubmission') }}" style="color: black">
            <h5>PSM 2 Submission for Second Evaluation [30%]</h5>
            <label>Due date: Friday, 14/7/2023, 11:59 PM</label>
        </a>
    </div>
</div>
@endif
<br>
<script src="{{ asset('frontend') }}/js/jquery.dataTables.js"></script>
<Script>

</script>
@endsection