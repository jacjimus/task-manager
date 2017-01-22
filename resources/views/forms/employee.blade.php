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

    <h2> Create Employee</h2>
</div>

<div class="container-fluid-md">
    <form class="form-horizontal form-bordered" role="form" action="{{url('/save')}}" method="POST">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><code >*</code> <span class="text-muted" >shows madatory fields</span></h4>

                <div class="panel-options">
                    <a href="#" data-rel="collapse"><i class="fa fa-fw fa-minus"></i></a>
                    <a href="#" data-rel="reload"><i class="fa fa-fw fa-refresh"></i></a>
                    <a href="#" data-rel="close"><i class="fa fa-fw fa-times"></i></a>
                </div>
            </div>
            <div class="panel-body">
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li class="list-unstyled">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="row">
                {!! session('employee') !!}
                  {{ csrf_field() }}
                <div class="form-group">
                  
                    <label class="control-label col-sm-3">Email Address<code >*</code></label>

                    <div class="controls col-sm-6">
                        <input name="email" type="email" value="{!! old('email') !!}" class="form-control" placeholder="Enter email">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3">First Name<code >*</code></label>

                    <div class="controls col-sm-6">
                        <input name="first_name" value="{!! old('first_name') !!}" type="text" class="form-control" placeholder="Enter First name">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Last Name<code >*</code></label>

                    <div class="controls col-sm-6">
                        <input name="last_name" value="{!! old('last_name') !!}" type="text" class="form-control" placeholder="Enter Last name">
                    </div>
                </div>

                

                <div class="form-group">
                    <label class="control-label col-sm-3">Department</label>

                    <div class="controls col-sm-6">
                        <select name="dept" class="form-control">
                            <option value="">Select Department</option>
                                        @foreach($departments as $item)
                                        <option value="{{ $item->id }}" @if (old('dept') == $item->id) selected="selected" @endif >{{ $item->name }}</option>
                                        @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Employee role<code>*</code></label>

                    <div class="controls col-sm-6">
                        <select name="role_id" class="form-control">
                            <option value="">Select Role</option>
                                        @foreach($roles as $role)
                                        <option value="{{ $role->id }}" @if (old('role_id') == $role->id) selected="selected" @endif>{{ $role->name }}</option>
                                        @endforeach
                        </select>
                    </div>
                </div>
                  <div class=" container-fluid panel-footer">
                        <div class="col-md-offset-8">
                            <a  href="{{url('/employees')}}" class="btn btn-default" tabindex="2"><i class="fa fa-times">&nbsp;</i>Cancel</a>&nbsp;&nbsp;
                            <button class="btn btn-primary" type="submit"><i class="fa fa-save" tabindex="1">&nbsp;</i>Save</button>
                        </div>
                  </div>
               </div>
            </div>
        </div>
    </form>
  </div>
    @endcan
@endsection
