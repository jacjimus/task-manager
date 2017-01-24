<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tasks;
use Illuminate\Support\Facades\DB;
use Auth;

class TasksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function Index()
    {
          return view('grids.tasks');
    }
    public function my_dept()
    {
          return \App\Departments::find(Auth::user()->dept)->name;
    }
    public function mydata($id = null)
    {
     if ($id == null) {
            /* 
              * Access for my tasks
              *  -  Should be able to view all tasks assigned to self
              */
            return Tasks::orderBy('created_on', 'desc')
                    ->with('category', 'user')
                 ->where('assignee' , Auth::user()->id)
                 ->where('status' , Tasks::STATUS_NEW)
                 ->get();
         } else {
            return $this->show($id);
        }
    }
    public function data($id = null)
    {
     if ($id == null) {
         if(Auth::user()->role_id == 3):
             /* Manager access level
              * Access for other user
              *  -  Should be able to view all taks created by self
              *  -  All others within the department heading whether private or public
              *  -  All public tasks from other departments
              */
            return Tasks::orderBy('created_on', 'desc')
                 ->where('dept_id' , Auth::user()->dept)
                 ->orWhere(function($query)
            {
             $query->where('access_level', Tasks::PUBLIC_ACCESS)
                   ->where('dept_id', '<>', Auth::user()->dept);
            })
                 ->get();
         else: 
             /* Access for other user
              * Should be able to view all taks created by
              *  - self 
              *  - All others with public access
              */
         
             return Tasks::orderBy('created_on', 'desc')
                 ->where('created_by' , Auth::user()->id)
                 ->orWhere(function($query)
            {
             $query->where('access_level', Tasks::PUBLIC_ACCESS)
                      ->where('created_by', '<>', Auth::user()->id);
            })
                 ->with('category')->get();
        
         endif;
           // return Tasks::orderBy('name', 'asc')->where('dept_id' , Auth::user()->dept)->with('user')->get();
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
        $categ = new Tasks;
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
        return Tasks::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id) {
        $task = Tasks::find($id);
        $task->status = $request->input('status');   
        if($task->save() && $request->input('comment') <> ""):
            $comment = new \App\TaskComments;
            $comment->comment = $request->input('comment');
            $comment->task_id = $id;
            $comment->created_by = Auth::user()->id;
            $comment->save();
        endif;

        $request->session()->flash('alert-success', 'Task comment was successful saved!');
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

