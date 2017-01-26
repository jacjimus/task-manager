
@extends('layout')

@section('title', 'Task Categories')

@section('content')
    <div class="page-content">
<div class="page-subheading page-subheading-md">
    <ol class="breadcrumb">
        <li><a href="javascript:;">Dashboard</a></li>
        <li><a href="javascript:;">Tasks</a></li>
        <li class="active"><a href="javascript:;">Task Categories</a></li>
    </ol>
</div>
<div class="page-heading page-heading-md">

    <h2>Task Categories</h2>
</div>

<div class="container-fluid-md">
    <div class="row">
    <div class="panel panel-default">
       <div class="flash-message">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))

            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
            @endforeach
        </div> <!-- end .flash-message -->
        <div class="panel-body" ng-app="app">
            <div  ng-controller="taskcategoryController">

            <!-- Table-to-load-the-data Part -->
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Category Name</th>
                        <th>Created by</th>
                        <th>Date created</th>
                        <th><button id="btn-add" class="btn btn-primary btn-xs" ng-click="toggle('add', 0)">Add New Category</button></th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="cat in categories">
                        <td><% cat.name %></td>
                        <td><% cat.user.first_name %>&nbsp;<% cat.user.last_name %></td>
                        <td><% cat.created_at %></td>
                        <td>
                            <button class="btn btn-default btn-xs btn-detail" ng-click="toggle('edit', cat.id)">Edit</button>
                            <button class="btn btn-danger btn-xs btn-delete" ng-click="confirmDelete(cat.id)">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- End of Table-to-load-the-data Part -->
            <!-- Modal (Pop up when detail button clicked) -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="myModalLabel"><%form_title%></h4>
                        </div>
                        <div class="modal-body">
                            <form name="frmCategories" class="form-horizontal" novalidate="">

                                <div class="form-group error">
                                    <label for="name" class="col-sm-3 control-label">Task Category</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="name" name="name" placeholder="Task category name" value="<%name%>" 
                                        ng-model="cat.name" ng-required="true">
                                        <span class="alert-danger" 
                                        ng-show="frmCategories.name.$invalid && frmCategories.name.$touched">Task Category Name field is required</span>
                                    </div>
                                </div>
                             

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="btn-save" ng-click="save(modalstate, id)" ng-disabled="frmCategories.$invalid">Save changes</button>
                        </div>
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
<script type="text/javascript" src="<?= asset('angular/controllers/taskcategory.js') ?>"></script>
