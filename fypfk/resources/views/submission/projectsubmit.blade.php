@extends('layouts.sideNav')

@section('content')

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>PROJECT SUBMISSION</b></h3>

@if( auth()->user()->category== "Student")
@if($submissionData)
    @foreach($submission as $data)
    <div class="card">  
        <div class="card-body">
            <table>
                <tr>
                    <td>
                        @if (($data->title) == 'PTA 2 Final Submission' || ($data->title) == 'PSM 2 Final Submission')
                        <a href="{{ route('viewFinalSubmission', $data->id) }}" style="color: black">
                            <h5>{{$data->title}}</h5>
                            <label>{{ date('l, d/m/Y', strtotime($data->dueDate)) }}, {{$data->dueTime}}</label>
                        </a>
                        @else
                        <a href="{{ route('viewSubmission', $data->id) }}" style="color: black">
                            <h5>{{$data->title}}</h5>
                            <label>{{ date('l, d/m/Y', strtotime($data->dueDate)) }}, {{$data->dueTime}}</label>
                        </a>
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <br>
    @endforeach
@elseif(! $submissionData)
<div class="card">  
        <div class="card-body">
            <center>
                <h5 style="color: red"><i class="material-icons" style="color: red">priority_high</i> No Submission <i class="material-icons" style="color: red">priority_high</i></h5>
            </center>
        </div>
    </div>
@endif
@endif

@if( auth()->user()->category== "Staff")
@if($submissionData)
    @foreach($submission as $data)
    <div class="card">  
        <div class="card-body">
            <table>
                <tr>
                    <td>
                        <a href="{{ route('viewSubmission', $data->id) }}" style="color: black">
                            <h5>{{$data->title}}</h5>
                            <label>{{ date('l, d/m/Y', strtotime($data->dueDate)) }}, {{$data->dueTime}}</label>
                        </a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <br>
    @endforeach
@elseif(! $submissionData)
<div class="card">  
        <div class="card-body">
            <center>
                <h5 style="color: red"><i class="material-icons" style="color: red">priority_high</i> No Submission <i class="material-icons" style="color: red">priority_high</i></h5>
            </center>
        </div>
    </div>
@endif
@endif

@if( auth()->user()->category== "Admin")

<a class="btn btn-primary" href="{{ route('createSubmission') }}" style="border-radius: 10px; border: none; width: 18%; color: white; font-size: 15px; background-color: #145956; margin-left: 910px; margin-bottom:15px">
    <i class="material-icons" style="color: white">create_new_folder</i> <b>CREATE SUBMISSION</b>
</a>
<br>
@if($submissionData)
    @foreach($submission as $data)
    <div class="card">  
        <div class="card-body">
            <table>
                <tr>
                    <td style="padding-left: 970px">
                        <a href="{{ route('editSubmission', $data->id) }}" style="font-size: 25px;">
                            <i class="material-icons" style="color: #86B5B3">edit</i>
                        </a>
                        @if($data->title == 'PTA 2 Final Submission' || $data->title == 'PSM 2 Final Submission')
                        
                        @else
                        <a style="font-size: 25px;" data-toggle="modal" data-target="#deleteNoti">
                            <i class="material-icons" style="color: red">delete</i>
                        </a>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="{{ route('viewSubmission', $data->id) }}" style="color: black">
                            <h5>{{$data->title}}</h5>
                            <label>{{ date('l, d/m/Y', strtotime($data->dueDate)) }}, {{$data->dueTime}}</label>
                        </a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <br>
    <!--delete noti-->
<div class="modal fade" id="deleteNoti" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Warning Notification</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure want to proceed delete the submission?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <a type="button" class="btn btn-primary" href="{{ route('deleteSubmission', $data->id) }}">Confirm</a>
      </div>
    </div>
  </div>
</div>
    @endforeach
@elseif(! $submissionData)
<div class="card">  
        <div class="card-body">
            <center>
                <h5 style="color: red"><i class="material-icons" style="color: red">warning</i> No Submission <i class="material-icons" style="color: red">warning</i></h5>
            </center>
        </div>
    </div>
@endif
@endif
<br>
<script src="{{ asset('frontend') }}/js/jquery.dataTables.js"></script>
<Script>

</script>
@endsection