@extends('layouts.sideNav')

@section('content')

@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>MY TASK</b></h3>

<div class="card" style="margin: auto">

    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                <!-- FOR STAFF TO VIEW RECORD APPOINTMENT LIST START -->
                <table class="table table-bordered" id="dataTable" style="width: 100%; margin: auto" cellspacing="0">
                @foreach($taskview as $data)
                <form method="post" action="{{ route('updateTask', $data->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <thead style="color: black;">
                        <tr>
                            <th colspan="4">
                                <center>
                                    <select name="process" id="process" style="background-color: #86B5B3; border-radius: 10px; width: 20%;" class="form-control" value="{{$data->progress}}">
                                        <option value="To Do">TO DO</option>
                                        <option value="Doing">DOING</option>
                                        <option value="Done">DONE</option>
                                    </select>
                                </center>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align: center; color: black"><label>Task Title</label></td>
                            <td>
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="taskTitle" id="taskTitle" value="{{$data->titleTask}}">
                            </td>
                            <td style="text-align: center; color: black"><label>Assignor</label></td>
                            <td>
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="assignor" id="assignor" value="{{$data->assignor}}">
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Due Date</label></td>
                            <td>
                                <input type="date" style="background-color: #86B5B3; border-radius: 10px;" class="form-control" name="dueDate" id="dueDate" value="{{$data->dueDate}}">
                            </td>
                            <td style="text-align: center; color: black"><label>Priority</label></td>
                            <td>
                                <select name="priority" id="priority" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" value="{{$data->priority}}">
                                    <option value="Low">Low</option>
                                    <option value="Medium">Medium</option>
                                    <option value="High">High</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Status</label></td>
                            <td>
                                <select name="status" id="status" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" value="{{$data->status}}">
                                    <option value="On Track">On Track</option>
                                    <option value="Off Track">Off Track</option>
                                    <option value="Risk">Risk</option>
                                </select>
                            </td>
                            <td style="text-align: center; color: black"><label>Task Details</label></td>
                            <td>
                                <textarea class="form-control" name="taskDetails" id="taskDetails" rows="2" style="background-color: #86B5B3; border-radius: 10px; width: 100%;">{{$data->taskDetails}}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Attachment</label></td>
                            <td colspan="3">
                                <input type="file" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="attachment" id="attachment" accept="application/pdf" onchange="loadFile(this)">
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
                                <textarea class="form-control" name="comment" id="comment" rows="4" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" readonly>{{$data->comment}}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Supervisor Attachment</label></td>
                            <td colspan="3">
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
                                    <a class="btn" href="{{ route('task') }}" style="border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px; background-color: #86B5B3">
                                        <b>BACK</b>
                                    </a>
                                    <a class="btn btn-danger" style="border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px" data-toggle="modal" data-target="#exampleModalCenter">
                                        <b>DELETE</b>
                                    </a>
                                </center>
                            </td>
                        </tr>
                    </tbody>
                </form>
                <!-- Modal Delete -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Warning Notification</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure want to proceed delete?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
        <a type="button" href="{{ route('deleteTask', $data->id) }}" class="btn btn-primary">CONFIRM</a>
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

