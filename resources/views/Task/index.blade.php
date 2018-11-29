<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Index Page</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
  </head>
  <body>
    <div class="container">
    <br />
    @if (\Session::has('success'))
      <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
      </div><br />
     @endif
        <a href="{{action('TaskController@create')}}" class="btn btn-warning">Add</a>
    <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Project</th>
         <th>Status</th>

        <th colspan="3">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($tasks as $task)
      <tr>
        <td>{{$task->id}}</td>
        <td>{{$task->name}}</td>
        <td>{{$task->project->name}}</td>
          @if($task->status == 1)
                  <td>Ended</td>
          @else
                            <td>In Progress</td>
          @endif

          

        
        <td>
          <a href="{{action('TaskController@edit', $task->id)}}" class="btn btn-warning">Edit</a>
        <td>
          <form action="{{action('TaskController@destroy', $task->id)}}" method="post">
            {{csrf_field()}}
            <input name="_method" type="hidden" value="DELETE">
            <button class="btn btn-danger" type="submit">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
        {!! $tasks->render()!!}
  </div>
  </body>
</html>