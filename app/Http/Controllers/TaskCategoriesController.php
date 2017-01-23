<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TaskCategories;
use Illuminate\Support\Facades\DB;
use Auth;

class TaskCategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function Index()
    {
          return view('grids.task_categories');
    }
    
    public function data($id = null)
    {
     if ($id == null) {
            return TaskCategories::orderBy('name', 'asc')->where('dept_id' , Auth::user()->dept)->with('user')->get();
        } else {
            return $this->show($id);
        }
    }
     /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {
        $categ = new TaskCategories;
        $categ->name = $request->input('name');
        $categ->dept_id = Auth::user()->dept;
        $categ->created_by = Auth::user()->id;
        $categ->save();

         $request->session()->flash('alert-success', 'Task category was successful created!');
  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        return TaskCategories::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id) {
        $categ = TaskCategories::find($id);

        $categ->name = $request->input('name');
        $categ->dept_id = Auth::user()->dept;
        $categ->created_by = Auth::user()->id;
        $categ->save();

        $request->session()->flash('alert-success', 'Task category was successful updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, $id) {
        $categ = TaskCategories::find($id);

        $categ->delete();

        $request->session()->flash('alert-success', 'Task category was successful deleted!');
    }
} 

