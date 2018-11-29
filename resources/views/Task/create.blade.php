<!-- create.blade.php -->

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Add Project</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
  </head>
  <body>
    <div class="container">
      @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div><br />
      @endif
      @if (\Session::has('success'))
      <div class="alert alert-success">
          <p>{{ \Session::get('success') }}</p>
      </div><br />
      @endif
        @if(isset($task->id))
        <form method="post" action="{{action('TaskController@update', $id)}}">
        <input name="_method" type="hidden" value="PATCH">
        @else 
      <form method="post" action="{{url('tasks')}}">
        @endif

        {{csrf_field()}}
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name" value="{{$task->name}}">
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="name">Project:</label>
        @if(isset($task->id))
                      <select class="form-control"  name="project_id" >
         @foreach($projects as $project)
<option value="{{$project->id}}" @if( $task->project_id == $project->id)
    selected @endif >{{$project->name}}</option>
             @endforeach 
              </select>
            </div>
          </div>
                 <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="name">Status:</label> 
                                <select class="form-control"  name="status" >
<option value="0" @if( $task->status == 0)
    selected @endif >In Progress</option>
<option value="1" @if( $task->status == 1)
    selected @endif >Ended</option>

              </select>
            </div>
          </div>
@else
              
            
        <select class="form-control"  name="project_id" >
         @foreach($projects as $project)
<option value="{{$project->id}}">{{$project->name}}</option>
             @endforeach 
              </select>
            </div>
          </div>
@endif
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <button type="submit" class="btn btn-success" style="margin-left:38px">Save</button>
          </div>
        </div>
      </form>
    </div>
  </body>
</html>