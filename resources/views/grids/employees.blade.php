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
        <div class="right"><a href="{{url('/create-emp')}}" class="btn btn-success"><i class="fa fa-user">&nbsp;</i>Add employee</a></div>
        <div class="panel-body">
            <table id="table-basic" class="table table-striped">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @php ($i = 1)
                    @foreach($employees as $emp)
                      
                                    <tr class=" @if( @$i % 2 == 0 ) {{'odd'}} @else {{'even'}} @endif gradeX ">
                                        <td>{{ $emp->name }}</td>
                                        <td>{{ $emp->email }}</td>
                                        <td>{!!$emp->dept !!}</td>
                                        <td>{{ $emp->role_id }}</td>
                                        <td>{{ $emp->created_at }}</td>
                                        <td><a href="{{url('/edit-emp/' .Crypt::encrypt($emp->id)) }}" class="blue" title="Edit employee" ><i class="fa fa-edit blue"></i></a>&nbsp;&nbsp;
                                            <a href="{{url('/del-emp/' . Crypt::encrypt($emp->id)) }}" class="red"  title="Delete employee"><i class="fa fa-trash-o red"></i></a></td>
                                    </tr>
                                    @php ($i++)
                                    @endforeach
                    
                </tbody>
                <tfoot>
                    <tr>
                        <th>Email</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
            {{ $employees->links() }}
        </div>
    </div>
    </div>
  </div>
    @endcan
@endsection
