
@extends('layout')

@section('title', 'Dashboard')

@section('content')
    @can('isHOD')
    <div class="page-content">
<div class="page-subheading page-subheading-md">
    <ol class="breadcrumb">
        <li><a href="javascript:;">Dashboard</a></li>
        <li><a href="javascript:;">Tables</a></li>
        <li class="active"><a href="javascript:;">Data Tables</a></li>
    </ol>
</div>
<div class="page-heading page-heading-md">

    <h2>Employees</h2>
</div>

<div class="container-fluid-md">
    <div class="row">
    <div class="panel panel-default">
       
        <div class="panel-body" ng-app="employeeRecords">
            <div  ng-controller="employeesController">

            <!-- Table-to-load-the-data Part -->
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Role</th>
                        <th>Date created</th>
                        <th><button id="btn-add" class="btn btn-primary btn-xs" ng-click="toggle('add', 0)">Add New Employee</button></th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="employee in employees">
                        <td><% employee.first_name %>&nbsp;<% employee.last_name %></td>
                        <td><% employee.email %></td>
                        <td><% employee.department.name %></td>
                        <td><% employee.role.name %></td>
                        <td><% employee.created_at %></td>
                        <td>
                            <button class="btn btn-default btn-xs btn-detail" ng-click="toggle('edit', employee.id)">Edit</button>
                            <button class="btn btn-danger btn-xs btn-delete" ng-click="confirmDelete(employee.id)">Delete</button>
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
                            <form name="frmEmployees" class="form-horizontal" novalidate="">

                                <div class="form-group error">
                                    <label for="first_name" class="col-sm-3 control-label">First Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="first_name" name="first_name" placeholder="First name" value="<%first_name%>" 
                                        ng-model="employee.first_name" ng-required="true">
                                        <span class="help-inline" 
                                        ng-show="frmEmployees.first_name.$invalid && frmEmployees.first_name.$touched">First Name field is required</span>
                                    </div>
                                </div>
                                <div class="form-group error">
                                    <label for="last_name" class="col-sm-3 control-label">Last Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="last_name" name="last_name" placeholder="Last name" value="<%last_name %>" 
                                        ng-model="employee.last_name" ng-required="true">
                                        <span class="help-inline" 
                                        ng-show="frmEmployees.last_name.$invalid && frmEmployees.last_name.$touched">Last Name field is required</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email" class="col-sm-3 control-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" value="<%email%>" 
                                        ng-model="employee.email" ng-required="true">
                                        <span class="help-inline" 
                                        ng-show="frmEmployees.email.$invalid && frmEmployees.email.$touched">Valid Email field is required</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="dept" class="col-sm-3 control-label">Department</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="dept" name="dept" ng-model="employee.dept" ng-required="true"
                                                ng-init="employee.dept = dept[0]" 
                                                ng-options="dept.name for dept in departments track by dept.id">
                                            <option value="">Select department</option>
                                        </select>
                                    <span class="help-inline" 
                                        ng-show="frmEmployees.dept.$invalid && frmEmployees.dept.$touched">Department field is required</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="role_id" class="col-sm-3 control-label">Employee Role</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="dept" name="role_id" ng-model="employee.role_id" ng-required="true"
                                                ng-init="employee.dept = dept[0]" 
                                                ng-options="role.name for role in roles track by role.id">
                                            <option value="">Select role</option>
                                        </select>
                                    <span class="help-inline" 
                                        ng-show="frmEmployees.role_id.$invalid && frmEmployees.role_id.$touched">Role field is required</span>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="btn-save" ng-click="save(modalstate, id)" ng-disabled="frmEmployees.$invalid">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    </div>
  </div>
    @endcan
@endsection
<!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>

<script src="<?= asset('js/jquery.min.js') ?>"></script>
<script src="<?= asset('js/bootstrap.min.js') ?>"></script>       
<!-- AngularJS Application Scripts -->
<script type="text/javascript" src="<?= asset('angular/app.js') ?>"></script>
<script type="text/javascript" src="<?= asset('angular/controllers/employees.js') ?>"></script>
