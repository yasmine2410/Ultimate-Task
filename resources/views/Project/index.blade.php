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
        <a href="{{action('ProjectController@create')}}" class="btn btn-warning">Add</a>
    <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>User</th>
        <th colspan="4">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($projects as $project)
      <tr>
        <td>{{$project->id}}</td>
        <td>{{$project->name}}</td>
        <td>{{$project->user->name}}</td>
        
    <td><a href="{{action('ProjectController@precentage', $project->id)}}" class="btn btn-warning">Precentage</a></td>
        <td><a href="{{action('ProjectController@edit', $project->id)}}" class="btn btn-warning">Edit</a></td>
        <td>
          <form action="{{action('ProjectController@destroy', $project->id)}}" method="post">
            {{csrf_field()}}
            <input name="_method" type="hidden" value="DELETE">
            <button class="btn btn-danger" type="submit">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
        {!! $projects->render() !!}
  </div>
  </body>
</html>