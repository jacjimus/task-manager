
@extends('layout')

@section('title', 'Dashboard')

@section('content')

<div class="page-content" ng-app='app' ng-controller="tasksController">
    <div class="page-subheading page-subheading-md">
        <ol class="breadcrumb">
            <li><a href="javascript:;">Dashboard</a></li>
              </ol>
    </div>
    <div class="page-heading page-heading-md">
        <div class="row">
            <div class="col-md-8">
                <h2 >Tasks</h2>
            </div>
            <div class="col-md-2">
                <a href="#" class="text-primary-dark"><i class="fa fa-tasks">&nbsp;</i>Completed tasks</a> 
            </div>
            <div class="col-md-2 text-right"><button id="btn-add" class="btn btn-success btn-sm" ng-click="toggle('add', 0)"><i class="fa fa-plus-square">&nbsp;</i>Create task</button></div>
        </div>
    </div>

    <div class="container-fluid-md" >

        <div class="flash-message">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))

            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
            @endforeach
        </div> <!-- end .flash-message -->
        <div class="row">
           
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">My New / Ongoing Tasks <code>[Assigned to Me]</code></h4>

                        <p>Tasks listing in order of <code>priority</code> and <code>due date</code></p>

                        <div class="panel-options">
                            <a href="#" data-rel="collapse"><i class="fa fa-fw fa-minus"></i></a>
                            <a href="#" data-rel="reload"><i class="fa fa-fw fa-refresh"></i></a>
                            <a href="#" data-rel="close"><i class="fa fa-fw fa-times"></i></a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-condensed">
                            <tr style="font-size: 11px;">
                                <th>Due date</th>
                                <th>Create date</th>
                                <th width='20%'>Description</th>
                                <th>Category</th>
                                <th>Creator</th>
                                <th>Access level</th>
                                <th>Priority</th>
                            </tr>

                            <tbody style="font-size: 10px;">
                                <tr ng-repeat="mytask in mytasks">
                                    <td><% mytask.due_date %></td>
                                    <td><% mytask.created_at %></td>
                                    <td><% mytask.description %></td>
                                    <td><% mytask.category %></td>
                                    <td><% mytask.creator_name %></td>
                                    <td><% mytask.access_level %></td>
                                    <td><% mytask.priority %></td>
                                    <td style="font-size: 13px;">
                                        <a href="#" title="Add task comments" ng-click="toggle('view', mytask.id)"><i class="fa fa-comment text-success"></i>&nbsp;
                                            <a href="#"  title="Task history" ng-click="toggle('history', mytask.id)"><i class="fa fa-list-ol text-primary"></i>&nbsp;
                                             <a href="#" title="Close task" ng-click="toggle('close', mytask.id)"><i class="fa fa-bell text-danger"></i>&nbsp;
                                                </a>
                                                </td>
                                                </tr>

                                                </tbody>
                                                </table>
                                                </div>
                                                </div>
                                                </div>
                                                </div>
                                                <div class="row">
                                                    @can('isHOD')

                                                    <div class="col-md-12">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title">Department <code>[<%my_department%>]</code> Tasks</h4>
                                                                <p>All tasks in Department that I head

                                                                <div class="panel-options">
                                                                    <a href="#" data-rel="collapse"><i class="fa fa-fw fa-minus"></i></a>
                                                                    <a href="#" data-rel="reload"><i class="fa fa-fw fa-refresh"></i></a>
                                                                    <a href="#" data-rel="close"><i class="fa fa-fw fa-times"></i></a>
                                                                </div>
                                                            </div>
                                                            <div class="panel-body">
                                                                <table class="table table-striped">
                                                                    <tr style="font-size: 11px;">
                                                                        <th>Due date</th>
                                                                        <th>Create date</th>                                
                                                                        <th width='20%'>Description</th>
                                                                        <th>Category</th>
                                                                        <th>Creator</th>
                                                                        <th>Assignee</th>
                                                                        <th>Access level</th>
                                                                        <th>Status</th>
                                                                        <th>Priority</th>
                                                                        <th></th>
                                                                    </tr>

                                                                    <tbody style="font-size: 10px;">
                                                                        <tr ng-repeat="depttask in depttasks">
                                                                            <td><% depttask.due_date %></td>
                                                                            <td><% depttask.created_at %></td>
                                                                            <td><% depttask.description %></td>
                                                                            <td><% depttask.category %></td>
                                                                            <td><% depttask.creator_name %></td>
                                                                            <td><% depttask.assignee_name %></td>
                                                                            <td><% depttask.access_level %></td>
                                                                            <td><% depttask.status %></td>
                                                                            <td><% depttask.priority %></td>
                                                                            <td style="font-size: 13px;">
                                                                                <a href="#" title="Follow task" ng-click="toggle('follow', depttask.id)"><i class="fa fa-fast-forward text-success"></i>&nbsp;
                                                                                    <a href="#" title="Task history" ng-click="toggle('history', depttask.id)"><i class="fa fa-list-ol text-primary"></i>&nbsp;
                                                                                    </a>
                                                                            </td>
                                                                        </tr>

                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endcan
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title">Other Public Tasks</h4>
                                                                <p>All tasks in Other Department that are Public

                                                                <div class="panel-options">
                                                                    <a href="#" data-rel="collapse"><i class="fa fa-fw fa-minus"></i></a>
                                                                    <a href="#" data-rel="reload"><i class="fa fa-fw fa-refresh"></i></a>
                                                                    <a href="#" data-rel="close"><i class="fa fa-fw fa-times"></i></a>
                                                                </div>
                                                            </div>
                                                            <div class="panel-body">
                                                                <table class="table table-striped">
                                                                    <tr style="font-size: 11px;">
                                                                        <th>Due date</th>
                                                                        <th>Create date</th>
                                                                        <th width='20%'>Description</th>
                                                                        <th>Category</th>
                                                                        <th>Creator</th>
                                                                        <th>Assignee</th>
                                                                        <th>Status</th>
                                                                        <th>Priority</th>
                                                                        <th></th>
                                                                    </tr>

                                                                    <tbody style="font-size: 10px;">
                                                                        <tr ng-repeat="publictask in publictasks">
                                                                            <td><% publictask.due_date %></td>
                                                                            <td><% publictask.created_at %></td>
                                                                            <td><% publictask.description %></td>
                                                                            <td><% publictask.category %></td>
                                                                            <td><% publictask.creator_name%></td>
                                                                            <td><% publictask.assignee_name %></td>
                                                                            <td><% publictask.status %></td>
                                                                            <td><% publictask.priority %></td>
                                                                            <td style="font-size: 13px;">
                                                                                <a href="#" title="Follow task" ng-click="toggle('follow', publictask.id)"><i class="fa fa-fast-forward text-success"></i>&nbsp;
                                                                                    <a href="#" title="Task history" ng-click="toggle('history', publictask.id)"><i class="fa fa-list-ol text-primary"></i>&nbsp;
                                                                                    </a>
                                                                            </td>
                                                                        </tr>

                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="toggle('refresh' , 0)"><span aria-hidden="true">×</span></button>
                                                                <h4 class="modal-title" id="myModalLabel"><%form_title%></h4>
                                                            </div>

                                                            <div class="modal-body">
                                                                <form name="frmTasks" class="form-horizontal" novalidate="" enctype="multipart/form-data" method="post">
 
                                                                        <div class="form-group" ng-if="task.id != null">
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

                                                                            </div>
                                                                        </div>
                                                                    
                                                                   <div class="form-group" ng-show="(task.category_id ==1 && task.id != null) || task.id == null">
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
                                                                    <div class="col-sm-9 input-group date">
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
                                                                        <select class="form-control form-chosen" id="notif_depts" name="notif_depts" ng-model="task.notif_depts" multiple
                                                                                ng-options="dept.id as dept.name for dept in departments">
                                                                            <option value="">Select dept</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group error">
                                                                        <label for="attachment" class="col-sm-3 control-label">Attach file:</label>
                                                                        <div class="col-sm-9">
                                                                            <input type="file" fileread="task.attachment" class="form-control has-error" id="attachment" name="attachment">
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

                                                <div class="modal fade" id="comments" tabindex="-1" role="dialog" aria-labelledby="commentsLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="toggle('refresh' , 0)"><span aria-hidden="true">×</span></button>
                                                                <h4 class="modal-title" id="commentsLabel"><%form_title%></h4>
                                                            </div>

                                                            <div class="modal-body">
                                                                <table class="table table-issues">
                                                                    <thead >
                                                                    <th width="30%">Date</th>
                                                                    <th>comment</th>
                                                                    <th>File</th>
                                                                    </thead>
                                                                    <tbody style="font-size: 10px;">
                                                                        <tr ng-repeat="com in comments">
                                                                            <td><%com.created_at%></td> 
                                                                            <td><%com.comment%></td> 
                                                                            <td><div ng-show="com.attachment != null"><a href="<%com.attachment%>" target="_blank"><img ng-src='<%com.attachment%>' height="50" width="50" class="img-thumbnail text-primary"/></a></div></td> 
                                                                        </tr>
                                                                    </tbody>
                                                                    </thead>
                                                                </table>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
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
