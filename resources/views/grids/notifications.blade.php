
@extends('layout')

@section('title', 'Dashboard')

@section('content')
    
    <div class="page-content" ng-app='app' ng-controller="tasksController">
<div class="page-subheading page-subheading-md">
    <ol class="breadcrumb">
        <li><a href="javascript:;">Dashboard</a></li>
        <li><a href="javascript:;">Tasks Manager</a></li>
        <li class="active"><a href="javascript:;">My ongoing Tasks</a></li>
    </ol>
</div>
<div class="page-heading page-heading-md">
    <div class="row">
    <div class="col-md-8">
    <h2 >Task: {{$task->description}} </h2>
    </div>
    <div class="col-md-2">
        <a href="{{url('/dashboard')}}" class="text-primary-dark"><i class="fa fa-caret-left">&nbsp;</i>Back to task listing</a> 
    </div>
    <div class="col-md-2 text-right"></div>
</div>
</div>

<div class="container-fluid-md" >
    <div >
    <div class="row">
    <div class="">
        <div class="flash-message">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))

            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
            @endforeach
        </div> <!-- end .flash-message -->
        <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="panel panel-lg panel-light mail-thread">
                
                <div class="panel-body padding-md-vertical mail-subject thin">
                    <i class="m-star starred"></i>
                    Created by: {{$task->user->first_name}}&nbsp;{{$task->user->last_name}}
                    <span class="label label-info">Date created</span>{{$task->created_at}}
                    <i class="fa fa-certificate 
                        <?php if($task->priority == "Low"):$class='text-primary';elseif($task->priority == "Normal"):$class='text-warning';else:$class='text-danger';endif;echo $class;?> "></i>Priority {{$task->priority}}
                </div>
                @foreach($comments As $comm):
                <div class="panel-body padding-md-vertical">
                    <div class="mail-message">
                        <img class="mail-sender-image img-circle pull-left" src="demo/images/avatars/8.jpg">
                        <div class="mail-meta">
                            <span class="mail-date pull-right">
                                {{$comm->created_at}}
                                <i class="m-star"></i>
                            </span>
                            <h4 class="text-primary">{{$comm->user->first_name}}&nbsp;{{$comm->user->last_name}}</h4>
                            <small class="text-muted">{{$comm->user->email}}</small>
                        </div>
                        <div class="mail-body">
                            <div class="col-md-7"><p>{{$comm->comment}}</p></div>
                            <div class="col-md-5"><a href="{{$comm->attachment}}" target="_blank"><img src="{{$comm->attachment}}" class="img-thumbnail" height="100" width="200"/></a></div>
                        </div>
                    </div>
                </div>
                @endforeach;
                
                <div class="panel-body padding-md-vertical">
                    <div class="mail-message">
                        <img class="mail-sender-image img-circle pull-left hidden-xs" src="demo/images/avatars/2.jpg">
                        <div class="mail-body">
                            <textarea class="form-control" placeholder="Click here to comment..." style="resize:vertical;"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            </div>
        <div class="row">
        
        
    </div>
    </div>
    </div>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="myModalLabel"><%form_title%></h4>
                        </div>
                        
                        <div class="modal-body">
                            <form name="frmTasks" class="form-horizontal" novalidate="">
                                <div ng-show="task.id != null"> 
                                  <div class="form-group">
                                    <label for="status" class="col-sm-3 control-label">Task status</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="status" name="status" ng-model="task.status" 
                                            <option value="">--Select--</option>
                                            <option value="New" >New</option>
                                            <option value="On-going">On-going</option>
                                            <option value="Complete">complete</option>
                                            <option value="Dew">Dew</option>
                                         </select>
                                    <span class="alert-danger" 
                                        ng-show="frmTasks.status.$invalid && frmTasks.status.$touched">Status field is required</span>
                                    </div>
                                   </div>
                                    <div class="form-group error" ng-if="task.status == 'On-going'">
                                    <label for="comment" class="col-sm-3 control-label">Add comments</label>
                                    <div class="col-sm-9">
                                        <textarea  class="form-control autogrow has-error" id="comment" rows='4' name="comment" placeholder="comment here!" 
                                                   ng-model="task.comment" ></textarea>
                                        <span class="alert-danger" 
                                        </div>
                                </div>
                                </div>
                                </div>
                             
                                <div ng-show="task.id == null"> 
                                    <div class="form-group error">
                                    <label for="description" class="col-sm-3 control-label">Task Description</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="description" name="description" placeholder="Task description" value="<%description%>" 
                                        ng-model="task.description" ng-required="true">
                                        <span class="alert-danger" 
                                        ng-show="frmTasks.description.$invalid && frmTasks.description.$touched">description field is required</span>
                                    </div>
                                    </div>
                                    <div class="form-group">
                                    <label for="category_id" class="col-sm-3 control-label">Task category</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="category_id" name="category_id" ng-model="task.category_id" ng-required="true"
                                                ng-options="cat.id as cat.name for cat in categories">
                                            <option value="">Select category</option>
                                        </select>
                                    <span class="alert-danger" 
                                        ng-show="frmTasks.category_id.$invalid && frmTasks.category_id.$touched">category field is required</span>
                                    </div>
                                    </div>
                                    
                                    <div class="form-group">
                                    <label for="assignee" class="col-sm-3 control-label">Assignee</label>
                                     <div class="col-sm-9">
                                        <select class="form-control" id="category_id" name="category_id" ng-model="task.assignee" ng-required="true"
                                                ng-options="user.id as user.fullname for user in users">
                                            <option value="">Select Assignee</option>
                                        </select>
                                    <span class="alert-danger" 
                                        ng-show="frmTasks.assignee.$invalid && frmTasks.assignee.$touched">Assignee field is required</span>
                                    </div>
                                    </div>
                                    <div class="form-group">
                                    <label for="due_date" class="col-sm-3 control-label">Due date</label>
                                    <div class="col-sm-9 date">
                                        <input type="text" data-rel="datepicker" class="form-control has-error date" id="due_date" name="due_date" placeholder="format yyyy-mm-dd hh:mm:ss" value="<%due_date%>" 
                                        ng-model="task.due_date" ng-required="true">
                                        <span class="alert-danger" 
                                        ng-show="frmTasks.due_date.$invalid && frmTasks.due_date.$touched">due date field is required</span>
                                    </div>
                                    </div>
                                    <div class="form-group">
                                    <label for="status" class="col-sm-3 control-label">Set task Priority status</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="priority" name="priority" ng-model="task.priority" ng-required="true"
                                            <option value="">--Select--</option>
                                            <option value="Low">Low</option>
                                            <option value="Normal">Normal</option>
                                            <option value="High">High</option>
                                            </select>
                                    <span class="alert-danger" 
                                        ng-show="frmTasks.priority.$invalid && frmTasks.priority.$touched">priority field is required</span>
                                    </div>
                                   </div>
                                    <div class="form-group">
                                    <label for="notif_users" class="col-sm-3 control-label">Users to be notified</label>
                                     <div class="col-sm-9">
                                        <select class="form-control" id="notif_users" name="notif_users" ng-model="task.notif_users" multiple
                                                ng-options="user.id as user.fullname for user in users">
                                            <option value="">Select User</option>
                                        </select>
                                    <span class="alert-danger" 
                                        ng-show="frmTasks.notif_users.$invalid && frmTasks.notif_users.$touched">users field is required</span>
                                    </div>
                                    </div>
                                    <div class="form-group">
                                    <label for="notif_depts" class="col-sm-3 control-label">Dept to be notified</label>
                                     <div class="col-sm-9">
                                        <select class="form-control" id="notif_depts" name="notif_depts" ng-model="task.notif_depts" multiple
                                                ng-options="dept.id as dept.name for dept in departments">
                                            <option value="">Select dept</option>
                                        </select>
                                    </div>
                                    </div>
                                </div>
                               
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="btn-save" ng-click="save(modalstate, id)" ng-disabled="frmTasks.$invalid">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
    </div>
  </div>
</div>  
</div>
@endsection

<!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
      
<!-- AngularJS Application Scripts -->
<script type="text/javascript" src="<?= asset('angular/app.js') ?>"></script>
<script type="text/javascript" src="<?= asset('angular/controllers/tasks.js') ?>"></script>
