@extends('layouts.sideNav')

@section('content')

@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>SUPERVISEE TASK</b></h3>

<div class="card" style="margin: auto">

    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                <!-- FOR STAFF TO VIEW RECORD APPOINTMENT LIST START -->
                <table class="table table-bordered" id="dataTable" style="width: 100%; margin: auto" cellspacing="0">
                @foreach($taskview as $data)
                <form method="post" action="{{ route('updateTaskSupervisee', $data->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <thead style="color: black;">
                        <tr>
                            <th colspan="4">
                                <center>
                                    <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 20%;" class="form-control" name="progress" id="progress" value="{{$data->progress}}" readonly>
                                </center>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align: center; color: black"><label>Task Title</label></td>
                            <td>
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="taskTitle" id="taskTitle" value="{{$data->titleTask}}" readonly>
                            </td>
                            <td style="text-align: center; color: black"><label>Assignor</label></td>
                            <td>
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="assignor" id="assignor" value="{{$data->assignor}}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Due Date</label></td>
                            <td>
                                <input type="date" style="background-color: #86B5B3; border-radius: 10px;" class="form-control" name="dueDate" id="dueDate" value="{{$data->dueDate}}" readonly>
                            </td>
                            <td style="text-align: center; color: black"><label>Priority</label></td>
                            <td>
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="priority" id="priority" value="{{$data->priority}}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Status</label></td>
                            <td>
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="status" id="status" value="{{$data->status}}" readonly>
                            </td>
                            <td style="text-align: center; color: black"><label>Task Details</label></td>
                            <td>
                                <textarea class="form-control" name="taskDetails" id="taskDetails" rows="2" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" readonly>{{$data->taskDetails}}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Attachment</label></td>
                            <td colspan="3">
                                <!-- to preview the file from the input type in div -->
                                <!--<div id="dvPreview" style="width: 455px; height: 405px; border-style: dashed"></div> -->
                                @if($fileexist)
                                
                                @elseif(! $fileexist)
                                <div>
                                    <iframe src="/assets/{{$data->attachment}}" width="500" height="400"></iframe>
                                </div>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Comment</label></td>
                            <td colspan="3">
                                <textarea class="form-control" name="comment" id="comment" rows="4" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" required>{{$data->comment}}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Supervisor Attachment</label></td>
                            <td colspan="3">
                                <input type="file" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="supervisorAttachment" id="supervisorAttachment" accept="application/pdf" onchange="loadFile(this)">
                                <!-- to preview the file from the input type in div -->
                                <!--<div id="dvPreview" style="width: 455px; height: 405px; border-style: dashed"></div> -->
                                @if($superviseefileexist)
                                
                                @elseif(! $superviseefileexist)
                                <div>
                                    <iframe src="/assets/{{$data->supervisorAttachment}}" width="500" height="400"></iframe>
                                </div>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <center>
                                    <button type="submit" class="btn btn-primary" style="background-color: #145956; border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px">
                                        <b>UPDATE</b>
                                    </button>
                                    <a class="btn" style="border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px; background-color: #86B5B3" data-toggle="modal" data-target="#backNoti">
                                        <b>BACK</b>
                                    </a>
                                    <a class="btn btn-danger" style="border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px" data-toggle="modal" data-target="#deleteNoti">
                                        <b>DELETE</b>
                                    </a>
                                </center>
                            </td>
                        </tr>
                    </tbody>
                </form>
<!--back noti-->
<div class="modal fade" id="backNoti" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Warning Notification</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure want to back?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <a type="button" class="btn btn-primary" href="{{ route('taskSuperviseeView', $data->superviseeID) }}">Confirm</a>
      </div>
    </div>
  </div>
</div>
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
        Are you sure want to proceed delete a task?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <a type="button" class="btn btn-primary" href="{{ route('deleteSuperviseeTask', $data->id) }}">Confirm</a>
      </div>
    </div>
  </div>
</div>
                @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
<br>
@endsection

<!-- to preview the chosen file from computer -->
<script type="text/javascript" src='https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.3.min.js'></script>
<script type="text/javascript" src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/js/bootstrap.min.js'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">
    $(function() {
        $("#attachment").change(function() {
            $("#dvPreview").html("");

            $("#dvPreview").show();
            $("#dvPreview").append("<iframe />");
            $("iframe").css({
                "height": "400px",
                "width": "450px"
            });
            var reader = new FileReader();
            reader.onload = function(e) {
                $("#dvPreview iframe").attr("src", e.target.result);
            }
            reader.readAsDataURL($(this)[0].files[0]);
        });
    });
</script>