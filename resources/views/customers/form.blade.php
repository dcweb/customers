@extends("dcms::template/layout")

@section("content")

    <div class="main-header">
      <h1>Users</h1>
      <ol class="breadcrumb">
        <li><a href="{!! URL::to('admin/customers') !!}"><i class="fa fa-user"></i> Users</a></li>
@if(isset($user))
        <li class="active">Edit</li>
@else
        <li class="active">Create</li>
@endif
      </ol>
    </div>

    <div class="main-content">
    	<div class="row">
				<div class="col-md-12">
					<div class="main-content-block">

@if(isset($user))
	<h2>Edit User</h2>

{!! Form::model($user, array('route' => array('admin.customers.update', $user->id), 'method' => 'PUT')) !!}
@else
	<h2>Create User</h2>

{!! Form::open(array('url' => 'admin/customers')) !!}
@endif

@if($errors->any())
  <div class="alert alert-danger">{!! Html::ul($errors->all()) !!}</div>
@endif


	<div class="form-group">
		{!! Form::label('firstname', 'Firstname') !!}
		{!! Form::text('firstname', null, array('class' => 'form-control')) !!}
	</div>

	<div class="form-group">
		{!! Form::label('lastname', 'Lastname') !!}
		{!! Form::text('lastname', null, array('class' => 'form-control')) !!}
	</div>

	<div class="form-group">
		{!! Form::label('email', 'Email') !!}
		{!! Form::text('email', null, array('class' => 'form-control')) !!}
	</div>


	{!! Form::submit('Save', array('class' => 'btn btn-primary')) !!}
  <a href="{!! URL::previous() !!}" class="btn btn-default">Cancel</a>

{!! Form::close() !!}

	      	</div>
      	</div>
      </div>
    </div>

@stop
