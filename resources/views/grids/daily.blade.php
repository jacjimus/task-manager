
@extends('layout')

@section('title', 'Daily Reports')

@section('content')

    <div class="page-content">
<div class="page-subheading page-subheading-md">
    <ol class="breadcrumb">
        <li><a href="javascript:;">Dashboard</a></li>
        <li><a href="javascript:;">Reports</a></li>
        <li class="active"><a href="javascript:;">Daily reports</a></li>
    </ol>
</div>
<div class="page-heading page-heading-md">

    <h2>Daily task reports</h2>
</div>

<div class="container-fluid-md">
    <div class="row">
    <div class="panel panel-default">
        
        <div class="panel-body">
        {!! $grid !!} </div>
    </div>
    </div>
  </div>
@endsection
