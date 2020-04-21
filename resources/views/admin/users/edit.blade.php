@extends('layouts.admin')

@section('content')

<h1>Edit User</h1>

<div class="row">

<div class="col-sm-3">

<img src="{{$user->photo ? $user->photo->file : 'https://place-hold.it/300x500'}}" alt="" class="img-responsive img-rounded">

</div>


<div class="col-sm-9">


{!! Form::model($user, ['method'=>'PATCH', 'action'=> ['AdminUsersController@update', $user->id], 'files'=>true]) !!}

<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class'=>'form-control']) !!}

</div>

<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class'=>'form-control']) !!}

</div>

<div class="form-group">
    {!! Form::label('role_id', 'Role:') !!}
    {!! Form::select('role_id', $roles , null, ['class'=>'form-control']) !!}

</div>

<div class="form-group">
    {!! Form::label('is_active', 'Status:') !!}
    {!! Form::select('is_active', array(1 => 'Active', 0 => 'Not Active'), null, ['class'=>'form-control']) !!}

</div>

<div class="form-group">
    {!! Form::label('photo_id', 'Upload Photo:') !!}
    {!! Form::file('photo_id', null, ['class'=>'form-control']) !!} 

</div>

<div class="form-group">
    {!! Form::label('password', 'Password:') !!}
    {!! Form::password('password', ['class'=>'form-control']) !!}

</div>

{{-- {{ Form::select('size', ['L' => 'Large', 'S' => 'Small'], null, ['placeholder' => 'Pick a size...'], ['class'=>'form-control'])}} --}}

<div class="form-group">
    {!! Form::submit('Create User', ['class'=>'btn btn-primary']) !!}
</div>


{!! Form::close() !!}

</div>
</div>

<div class="row">

@include('includes.form_error')

</div>
    
@endsection

