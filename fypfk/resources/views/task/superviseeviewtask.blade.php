@extends('layouts.sideNav')
@extends('layouts.partials.taskcss')
@section('content')

<h3 style="color: black; padding-left: 10px; padding-top: 10px"><b>SUPERVISEE TASK</b></h3>

<a href="{{ route('taskListSupervisee') }}" style="color: black">
    <i class="material-icons" style="color: black; font-size: 20px">keyboard_arrow_left</i> <b>BACK</b>
</a>
<br><br>

<center><h5 style="color: black">{{$studentName->name}}</h5></center>

<div class="container-fluid pt-3">
    <div class="row flex-row flex-sm-nowrap py-3">
        <!-- todo -->
        <div class="col-sm-6 col-md-4 col-xl-4">
            <div class="card" style="background-color: #86B5B3; color: black">
                <div class="card-body">
                    <a class="rounded-circle float-right" href="{{ route('createSuperviseeTask', $studentName->id) }}" style="color: black">
                        <b><i class="material-icons">add_circle_outline</i> Add Task</b>
                    </a>
                    <h6 class="card-title text-uppercase text-truncate py-2" style="color: white">To Do</h6>
                    @foreach($todo as $datatodo)
                    <div class="items border-light">
                        <div class="card draggable shadow-sm" id="cd1" draggable="true" ondragstart="drag(event)">
                            <div class="card-body p-2" style="background-color: white; border-radius: 10px">
                                <div class="card-title">
                                    <label><b>{{$datatodo->titleTask}}</b></label>
                                </div>
                                <p>
                                    <table>
                                        <tr>
                                            <td>Assignor:</td>
                                            <td>{{$datatodo->assignor}}</td>
                                        </tr>
                                        <tr>
                                            <td>Priority:</td>
                                            <td>{{$datatodo->priority}}</td>
                                        </tr>
                                        <tr>
                                            <td>Status:</td>
                                            <td>{{$datatodo->status}}</td>
                                        </tr>
                                        <tr>
                                            <td>Due:</td>
                                            <td>{{$datatodo->dueDate}}</td>
                                        </tr>
                                    </table>
                                </p>
                                <a class="btn btn-sm" href="{{ route('viewTaskSupervisee', $datatodo->taskID) }}" style="background-color: #145956; color: white">View</a>
                            </div>
                        </div>
                        <div class="dropzone rounded" ondrop="drop(event)" ondragover="allowDrop(event)" ondragleave="clearDrop(event)"> &nbsp; </div>
                        
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- in progress -->
        <div class="col-sm-6 col-md-4 col-xl-4">
            <div class="card" style="background-color: #86B5B3; color: black;">
                <div class="card-body">
                    <a class="rounded-circle float-right" href="{{ route('createSuperviseeTask', $studentName->id ) }}" style="color: black">
                        <b><i class="material-icons">add_circle_outline</i> Add Task</b>
                    </a>
                    <h6 class="card-title text-uppercase text-truncate py-2" style="color: white">In-progess</h6>
                    @foreach($doing as $datadoing)
                    <div class="items border-light">
                        <div class="card draggable shadow-sm" id="cd1" draggable="true" ondragstart="drag(event)">
                            <div class="card-body p-2" style="background-color: white; border-radius: 10px">
                                <div class="card-title">
                                    <label><b>{{$datadoing->titleTask}}</b></label>
                                </div>
                                <p>
                                    <table>
                                        <tr>
                                            <td>Assignor:</td>
                                            <td>{{$datadoing->assignor}}</td>
                                        </tr>
                                        <tr>
                                            <td>Priority:</td>
                                            <td>{{$datadoing->priority}}</td>
                                        </tr>
                                        <tr>
                                            <td>Status:</td>
                                            <td>{{$datadoing->status}}</td>
                                        </tr>
                                        <tr>
                                            <td>Due:</td>
                                            <td>{{$datadoing->dueDate}}</td>
                                        </tr>
                                    </table>
                                </p>
                                <a class="btn btn-sm" href="{{ route('viewTaskSupervisee', $datadoing->taskID) }}" style="background-color: #145956; color: white">View</a>
                            </div>
                        </div>
                        <div class="dropzone rounded" ondrop="drop(event)" ondragover="allowDrop(event)" ondragleave="clearDrop(event)"> &nbsp; </div>
                        
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- done -->
        <div class="col-sm-6 col-md-4 col-xl-4">
            <div class="card" style="background-color: #86B5B3; color: black;">
                <div class="card-body">
                    <a class="rounded-circle float-right" href="{{ route('createSuperviseeTask', $studentName->id ) }}" style="color: black">
                        <b><i class="material-icons">add_circle_outline</i> Add Task</b>
                    </a>
                    <h6 class="card-title text-uppercase text-truncate py-2" style="color: white">Done</h6>
                    @foreach($done as $datadone)
                    <div class="items border-light">
                        <div class="card draggable shadow-sm" id="cd1" draggable="true" ondragstart="drag(event)">
                            <div class="card-body p-2" style="background-color: white; border-radius: 10px">
                                <div class="card-title">
                                    <label><b>{{$datadone->titleTask}}</b></label>
                                </div>
                                <p>
                                    <table>
                                        <tr>
                                            <td>Assignor:</td>
                                            <td>{{$datadone->assignor}}</td>
                                        </tr>
                                        <tr>
                                            <td>Priority:</td>
                                            <td>{{$datadone->priority}}</td>
                                        </tr>
                                        <tr>
                                            <td>Status:</td>
                                            <td>{{$datadone->status}}</td>
                                        </tr>
                                        <tr>
                                            <td>Due:</td>
                                            <td>{{$datadone->dueDate}}</td>
                                        </tr>
                                    </table>
                                </p>
                                <a class="btn btn-sm" href="{{ route('viewTaskSupervisee', $datadone->taskID) }}" style="background-color: #145956; color: white">View</a>
                            </div>
                        </div>
                        <div class="dropzone rounded" ondrop="drop(event)" ondragover="allowDrop(event)" ondragleave="clearDrop(event)"> &nbsp; </div>
                        
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
<script>
const drag = (event) => 
{
  event.dataTransfer.setData("text/plain", event.target.id);
}

const allowDrop = (ev) => 
{
  ev.preventDefault();
  if (hasClass(ev.target,"dropzone")) {
    addClass(ev.target,"droppable");
  }
}

const clearDrop = (ev) => 
{
    removeClass(ev.target,"droppable");
}

const drop = (event) => 
{
  event.preventDefault();
  const data = event.dataTransfer.getData("text/plain");
  const element = document.querySelector(`#${data}`);
  try 
  {
    // remove the spacer content from dropzone
    event.target.removeChild(event.target.firstChild);
    // add the draggable content
    event.target.appendChild(element);
    // remove the dropzone parent
    unwrap(event.target);
  } 
  catch (error) 
  {
    console.warn("can't move the item to the same place")
  }

  updateDropzones();
}

const updateDropzones = () => 
{
    /* after dropping, refresh the drop target areas
      so there is a dropzone after each item
      using jQuery here for simplicity */
    
    var dz = $('<div class="dropzone rounded" ondrop="drop(event)" ondragover="allowDrop(event)" ondragleave="clearDrop(event)"> &nbsp; </div>');
    
    // delete old dropzones
    $('.dropzone').remove();

    // insert new dropdzone after each item   
    dz.insertAfter('.card.draggable');
    
    // insert new dropzone in any empty swimlanes
    $(".items:not(:has(.card.draggable))").append(dz);
};

// helpers
function hasClass(target, className) 
{
    return new RegExp('(\\s|^)' + className + '(\\s|$)').test(target.className);
}

function addClass(ele,cls) 
{
  if (!hasClass(ele,cls)) ele.className += " "+cls;
}

function removeClass(ele,cls) 
{
  if (hasClass(ele,cls)) 
  {
    var reg = new RegExp('(\\s|^)'+cls+'(\\s|$)');
    ele.className=ele.className.replace(reg,' ');
  }
}

function unwrap(node) 
{
    node.replaceWith(...node.childNodes);
}
</script>