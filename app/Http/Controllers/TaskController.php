<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Task;
use App\Project;
use DB; 


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::paginate(20);
        return view('Task.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $task = new Task();
       $projects = Project::all();
      return view('Task.create',compact('task','projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $task = $this->validate(request(), [
          'name' => 'required',
          'project_id'  => 'required'
        ]);
        Task::create($task);

        return back()->with('success', 'Task has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
               $projects = Project::all();
         $task = Task::find($id);
        return view('Task.create',compact('task','id','projects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
                $task = Task::find($id);
        $this->validate(request(), [
          'name' => 'required',
          'project_id' => 'required',

        ]);
        $task->name = $request->get('name');
        $task->project_id = $request->get('project_id');
         $task->status = $request->get('status');
        if($task->status == 1 ) {
        $task->end_date = date('Y-m-d');
        }
        $task->save();
        return redirect('tasks')->with('success','Project has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();
        return redirect('tasks')->with('success','Task has been  deleted');
    }
    

}
