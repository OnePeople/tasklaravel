@extends('layouts.main')
@section('head')
<title>{{$user->theme}}</title>
@endsection
@section('content')

<div>
  <div class="object-header">
    <h1>  @lang('user.show.header')</h1>
  </div>
  <div class="object-body">

        <div class="form-group">
          <label for="name"> @lang('user.show.name')</label>
          <h3>{{$user->name}}</h3>
          
        </div>
        <div class="form-group">
          <label for="price"> @lang('user.show.email')</label>
          
          <div>{{$user->email}}</div>
        </div> 

        <div class="form-group">
          <label > @lang('user.show.created_at')</label>
          <div>{{$user->created_at}}</div>
        </div> 
  </div>
</div>
@endsection