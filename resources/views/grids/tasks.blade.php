
@extends('layout')

@section('title', 'Dashboard')

@section('content')
    
    <div class="page-content">
<div class="page-subheading page-subheading-md">
    <ol class="breadcrumb">
        <li><a href="javascript:;">Dashboard</a></li>
        <li><a href="javascript:;">Tasks Manager</a></li>
        <li class="active"><a href="javascript:;">Tasks</a></li>
    </ol>
</div>
<div class="page-heading page-heading-md">
    <div class="row">
    <div class="col-md-6">
    <h2 >Tasks</h2>
    </div>
    <div class="col-md-6 text-right"><button id="btn-add" class="btn btn-success btn-sm" ng-click="toggle('add', 0)"><i class="fa fa-tasks">&nbsp;</i>Create task</button></div>
</div>
</div>

<div class="container-fluid-md" ng-app='app'>
    <div ng-controller="tasksController">
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
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">New Tasks <code>[Assigned to Me]</code></h4>

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
                                <th width='20%'>Description</th>
                                <th>Category</th>
                                <th>Creator</th>
                                <th>Access level</th>
                                <th>Create date</th>
                                <th>Priority</th>
                       </tr>
                        
                        <tbody style="font-size: 10px;">
                            <tr ng-repeat="mytask in mytasks">
                                <td><% mytask.due_date %></td>
                                <td><% mytask.description %></td>
                                <td><% mytask.category.name %></td>
                                <td><% mytask.user.first_name %>&nbsp;<% mytask.user.last_name %></td>
                                <td><% mytask.access_level %></td>
                                <td><% mytask.created_at %></td>
                                <td><% mytask.priority %></td>
                                <td><button class="btn btn-success btn-xs btn-detail" ng-click="toggle('view', mytask.id)">View</button>
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
        <div class="col-md-6">
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
                                <th>Desc</th>
                                <th>Create date</th>
                                <th>Priority</th>
                                <th>Username</th>
                            </tr>
                       
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endcan
        <div class="col-md-6">
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
                                <th>Desc</th>
                                <th>Create date</th>
                                <th>Priority</th>
                                <th>Username</th>
                            </tr>
                       
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
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
                                <div class="form-group">
                                    <label for="status" class="col-sm-3 control-label">Task status</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="status" name="status" ng-model="mytask.status" ng-required="true"
                                            <option value="">--Select--</option>
                                            <option value="New">New</option>
                                            <option value="On-going">On-going</option>
                                            <option value="Complete">complete</option>
                                            <option value="Dew">Dew</option>
                                         </select>
                                    <span class="alert-danger" 
                                        ng-show="frmTasks.status.$invalid && frmTasks.status.$touched">Status field is required</span>
                                    </div>
                                </div>
                                <div class="form-group error">
                                    <label for="comment" class="col-sm-3 control-label">Add comments</label>
                                    <div class="col-sm-9">
                                        <textarea  class="form-control autogrow has-error" id="comment" rows='4' name="comment" placeholder="comment here!" 
                                                   ng-model="mytask.comment" ></textarea>
                                        <span class="alert-danger" 
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
  
@endsection

<!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
      
<!-- AngularJS Application Scripts -->
<script type="text/javascript" src="<?= asset('angular/app.js') ?>"></script>
<script type="text/javascript" src="<?= asset('angular/controllers/tasks.js') ?>"></script>
