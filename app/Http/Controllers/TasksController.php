<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tasks;
use App\Schedules;
use Illuminate\Support\Facades\DB;
use Auth;
use App\User;
use App\Notifications\TaskNotifications;
use App\Notifications\CommentsNotifications;
use App\Task_view;
use Illuminate\Support\Facades\Notification;
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
    
    public function ongoing()
    {
          return view('grids.myongoingtasks');
    }
    public function my_dept()
    {
          return \App\Departments::find(Auth::user()->dept)->name;
    }
    public function tasksdata($id = null)
    {
     if ($id == null) :
            /* 
              * Access for my tasks
              *  -  Should be able to view all tasks assigned to self
              */
            return Task_view::orderBy('created_at', 'desc')
                 ->where('assignee' , Auth::user()->id)
                 ->where(function ($query) {
                        $query->where('status' , Tasks::STATUS_NEW)
                              ->orWhere('status' , Tasks::STATUS_ON_GOING);
                    })
                 ->get();
            elseif($id == 1): 
            /* 
              * Access for my department tasks
              *  -  Should be able to view all tasks assigned to my department whether
              * public or private
              */
            return Task_view::orderBy('created_at', 'desc')
                 ->where('assignee_department_id' , Auth::user()->dept)
                 ->where('assignee' , '!=', Auth::user()->id) // Exclude my tasks
                 ->where(function ($query) {
                        $query->where('status' , Tasks::STATUS_NEW)
                              ->orWhere('status' , Tasks::STATUS_ON_GOING);
                    })
                 ->get();
            elseif($id == 2): 
            /* 
              * Access for public access tasks
              *  -  Should be able to view all tasks assigned to my department whether
              * public or private
              */
            return Task_view::orderBy('created_at', 'desc')
                 ->where('assignee' , '!=', Auth::user()->id) // Exclude my tasks
                 //->where('assignee_department_id' , '!=', Auth::user()->dept) // exclude all tasks for my department
                 ->where('access_level' , Tasks::PUBLIC_ACCESS)
                 ->where(function ($query) {
                        $query->where('status' , Tasks::STATUS_NEW)
                              ->orWhere('status' , Tasks::STATUS_ON_GOING);
                    })
                 ->get();
        endif;
    }
    
    public function comments($id = null)
    {
     return \App\TaskComments::orderBy('created_at', 'desc')
                 ->where('task_id' , $id)
                 ->get();
         
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
        $task = new Tasks;
        $task->description = $request->input('description');
        $task->category_id = $request->input('category_id');
        $task->status = Tasks::STATUS_NEW;
        $task->assignee = $request->input('assignee');
        $task->due_date = $request->input('due_date');
        $task->created_by = Auth::user()->id;
        $task->notif_users_status = 0;
        $task->notif_dept_status = 0;
        $task->attachment = $request->input('attachment'); 
        $task->created_by = Auth::user()->id;
        $task->priority = $request->input('priority');
        $task->notif_users = serialize($request->input('notif_users'));
        $task->notif_depts = serialize($request->input('notif_depts'));
       if($task->save())
           $this->sendTaskCreationNotification (User::findMany($request->input('notif_users')), $task);
         $request->session()->flash('alert-success', 'Task  was successful created and notification send!');
  
    }
    
    /*
     * Send task creation notification
     */
public function sendTaskCreationNotification($users , $task)
{
           Notification::send($users, new TaskNotifications($task));
}
    /*
     * Send task comments notification
     */
public function sendTaskCommentNotification($users , $task)
{
           Notification::send($users, new CommentsNotifications($task));
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
    
    /*
     * view task(s) details
     */
    public function task($id = null , $notif = null) {
        if($notif <> null):
          $user = Auth::user();
            $notification = $user->notifications()->where('id',$notif)->first();
        if ($notification)
        {
            $notification->markAsRead();
            
        }  
        endif;
            
       $task = Tasks::find($id);
       $comments = \App\TaskComments::orderBy('created_at', 'DESC')->with('user')->where('task_id', $task->id)->get();
        return view('grids.notifications' , compact('task', 'comments'));
    }

    public function close(Request $request, $id) {
        $task = Tasks::find($id);

        $task->status = Tasks::STATUS_COMPLETE;
        $task->save();
        $request->session()->flash('alert-success', 'Task was successful closed!');
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
        $task->category_id = $request->input('category_id');   
        if($task->save() && $request->input('comment') <> ""):
          $comment = new \App\TaskComments;
            if($request->input('attachment') <> "")
               $comment->attachment = $request->input('attachment');  
                $comment->comment = $request->input('comment');
                $comment->task_id = $id;
                $comment->created_by = Auth::user()->id;
            if($comment->save()):
                $followers = \App\TaskFollowers::select('user_id')->where('task_id' , $id)->get();
                 $this->sendTaskCommentNotification (User::findMany($followers), $task);
            endif;
        endif;

        $request->session()->flash('alert-success', 'Task comment was successful saved!');
    }
    
    /*
     * crete a task folow
     */
    public function check_if_user_follow(Request $request, $id) {
        if(\App\TaskFollowers::where('user_id', '=', Auth::User()->id)->where('task_id', '=', $id)->count() > 0)
                return true;
            else
                return false;
        }
    /*
     * crete a task folow
     */
    public function follow(Request $request, $id) {
        $follow = new \App\TaskFollowers;
        $follow->user_id = Auth::User()->id;
        $follow->task_id = $id;
        if(\App\TaskFollowers::where('user_id', '=', $follow->user_id)->where('task_id', '=', $follow->task_id)->count() == 0){
            $follow->save();
            $request->session()->flash('alert-success', 'You have been added to the list of task followers successfully');
            }
            else
            $request->session()->flash('alert-warning', 'You already exist in the list of task followers');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, $id) {
        $categ = Tasks::find($id);

        $categ->delete();

        $request->session()->flash('alert-success', 'Task was successful deleted!');
    }
} 

