<?php

namespace App\Http\Controllers;
use App\Project;
use Illuminate\Http\Request;
use DB;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::paginate(20);
        return view('Project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $project = new Project();
        return view('Project.create',compact('project'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $project = $this->validate(request(), [
          'name' => 'required',
        ]);
        $project['user_id'] = auth()->user()->id;
        Project::create($project);

        return back()->with('success', 'Project has been added');
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
        $project = Project::find($id);
        return view('Project.create',compact('project','id'));
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
        $project = Project::find($id);
        $this->validate(request(), [
          'name' => 'required',
        ]);
        $project->name = $request->get('name');
        $project->save();
        return redirect('projects')->with('success','Project has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);
        $project->delete();
        return redirect('projects')->with('success','Project has been  deleted');
    }
    
     public function precentage($id) {
     $all = DB::table('tasks')->where('project_id' ,$id)->count();
     $ended = DB::table('tasks')->where('project_id' ,$id)->where('status' , 1)->count();
         if($all > 0 ) {
    $result = $ended * 100 / $all ;
                  return dd($result);

         }
         else {
                               return ('there is no tasks');

         }
    }
}
