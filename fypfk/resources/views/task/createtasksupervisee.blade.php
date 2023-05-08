@extends('layouts.sideNav')

@section('content')

@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>CREATE SUPERVISEE TASK</b></h3>

<div class="card" style="margin: auto">

    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                <!-- FOR STAFF TO VIEW RECORD APPOINTMENT LIST START -->
                <table class="table table-bordered" id="dataTable" style="width: 100%; margin: auto" cellspacing="0">
                <form method="post" action="{{ route('insertSuperviseeTask', $userdata->superviseeID) }}">
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
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="assignor" id="assignor" value="{{$userdata->supervisorName}}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: black"><label>Student Name</label></td>
                            <td>
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="studName" id="studName" value="{{$userdata->superviseeName}}" readonly>
                                <input type="hidden" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="studID" id="studID" value="{{$userdata->superviseeID}}">
                            </td>
                            <td style="text-align: center; color: black"><label>Student ID</label></td>
                            <td>
                                <input type="text" style="background-color: #86B5B3; border-radius: 10px; width: 100%;" class="form-control" name="studMatric" id="studMatric" value="{{$userdata->superviseeMatric}}" readonly>
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
                                    <a class="btn btn-danger" href="{{ route('taskSuperviseeView', $userdata->superviseeID) }}" style="border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px">
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
@endsection