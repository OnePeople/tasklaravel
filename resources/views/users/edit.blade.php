@extends('layouts.main')
@section('head')
<title> @lang('user.editcreate.header')</title>
@endsection
@section('content')

<div>
  <div class="object-header">
    <h1> @lang('user.editcreate.header')</h1>
  </div>
  <div class="object-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
    {{ Form::model($user,$formParams) }}
     
        <div class="form-group">
          <label for="name">@lang('user.editcreate.name')</label>
          {{ Form::text('name', null, ['class'=>'form-control']) }}
        </div>
      <div class="form-group">
        <label for="price">@lang('user.editcreate.email')</label>
        {{ Form::email('email',null, ['class'=>'form-control']) }}
      </div>
      <div class="form-group">
        <label for="price">@lang('user.editcreate.password')</label>
        {{ Form::password('password', ['class'=>'form-control']) }}
      </div>
      <button type="submit" class="btn btn-primary">@lang('user.save')</button>
    
      {{ Form::close() }}
  </div>
</div>
@endsection