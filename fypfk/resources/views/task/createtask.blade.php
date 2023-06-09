@extends('layouts.sideNav')

@section('content')

@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>CREATE TASK</b></h3>

<div class="card" style="margin: auto">

    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                <!-- FOR STAFF TO VIEW RECORD APPOINTMENT LIST START -->
                <table class="table table-bordered" id="dataTable" style="width: 100%; margin: auto" cellspacing="0">
                <form method="post" action="{{ route('insertTask') }}">
                    @csrf
                    <thead style="color: black;">
                        <tr>
                            <th colspan="4">
                                <center>
                                    <select name="process" id="process" style="background-color: #86B5B3; border-radius: 10px; width: 20%;" class="form-control">
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
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="taskTitle" id="taskTitle" value="">
                            </td>
                            <td style="text-align: center; color: black"><label>Assignor</label></td>
                            <td>
                                @foreach($getstudData as $studData)
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="assignor" id="assignor" value="{{$studData->name}}" readonly>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Due Date</label></td>
                            <td>
                                <input type="date" style="background-color: #86B5B3; border-radius: 10px;" class="form-control" name="dueDate" id="dueDate" value="">
                            </td>
                            <td style="text-align: center; color: black"><label>Priority</label></td>
                            <td>
                                <select name="priority" id="priority" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control">
                                    <option value="Low">Low</option>
                                    <option value="Medium">Medium</option>
                                    <option value="High">High</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Status</label></td>
                            <td>
                                <select name="status" id="status" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control">
                                    <option value="On Track">On Track</option>
                                    <option value="Off Track">Off Track</option>
                                    <option value="Risk">Risk</option>
                                </select>
                            </td>
                            <td style="text-align: center; color: black"><label>Task Details</label></td>
                            <td>
                                <textarea class="form-control" name="taskDetails" id="taskDetails" rows="2" style="background-color: #86B5B3; border-radius: 10px; width: 100%;"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <center>
                                    <button type="submit" class="btn btn-primary" style="background-color: #145956; border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px">
                                        <b>SUBMIT</b>
                                    </button>
                                    <a class="btn btn-danger" style="border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px" data-toggle="modal" data-target="#backNoti">
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
        Are you sure want to cancel create task?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <a type="button" class="btn btn-primary" href="{{ route('task') }}">Confirm</a>
      </div>
    </div>
  </div>
</div>
@endsection